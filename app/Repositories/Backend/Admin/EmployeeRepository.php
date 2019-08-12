<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Employee::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Employee
     */
    public function create(array $data) : Employee
    {
        // Make sure it doesn't already exist
        if ($this->employeeExists($data['document'])) {
            Session::flash('error','Ya existe un empleado con el documento '.$data['document']);
            throw new GeneralException('Ya existe un empleado con el documento '.$data['document']);
        }
        return DB::transaction(function () use ($data) {
            $employee = parent::create($data);

            if ($employee) {
                return $employee;
            }
            Session::flash('error','Error al crear empleado. Intente nuevamente');
            throw new GeneralException('Error al crear empleado. Intente nuevamente');
        });
    }

    /**
     * @param Employee  $employee
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
        if ($employee->document !== strtolower($data['document'])) {
            if ($this->employeeExists($data['document'])) {
                Session::flash('error','Ya existe un empleado con el documento '.$data['document']);
                throw new GeneralException('Ya existe un empleado con el documento '.$data['document']);
            }
        }

        return DB::transaction(function () use ($employee, $data) {
            if ($employee->update($data)) {
                return $employee;
            }
            Session::flash('error','Error al actualizar empleado. Intente nuevamente');
            throw new GeneralException('Error al actualizar empleado. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function employeeExists($document) : bool
    {
        return $this->model
            ->where('document', strtolower($document))
            ->count() > 0;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */

    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
//            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort);
        //->paginate($paged);
    }

    /**
     * @param Employee $employee
     *
     * @throws GeneralException
     * @return Employee
     */
    public function restore(Employee $employee) : Employee
    {
        if ($employee->deleted_at === null) {
            Session::flash('error','El empleado no esta eliminado');
            throw new GeneralException('El empleado no esta eliminado');
        }
        if ($employee->restore()) {
            return $employee;
        }
        Session::flash('error','Error al restaurar empleado. Intente nuevamente');
        throw new GeneralException('Error al restaurar empleado. Intente nuevamente');
    }
}
