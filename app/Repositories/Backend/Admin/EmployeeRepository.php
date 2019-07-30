<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

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
            throw new GeneralException('A employee already exists with the document '.e($data['document']));
        }
        return DB::transaction(function () use ($data) {
            $employee = parent::create($data);

            if ($employee) {
                return $employee;
            }

            throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
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
//        if ($role->isAdmin()) {
//            throw new GeneralException('You can not edit the administrator role.');
//        }

        // If the name is changing make sure it doesn't already exist
        if ($employee->document !== strtolower($data['document'])) {
            if ($this->employeeExists($data['document'])) {
                throw new GeneralException('A employee already exists with the document '.$data['document']);
            }
        }

//        if (! isset($data['permissions']) || ! \count($data['permissions'])) {
//            $data['permissions'] = [];
//        }

        //See if the role must contain a permission as per config
//        if (config('access.roles.role_must_contain_permission') && \count($data['permissions']) === 0) {
//            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
//        }

        return DB::transaction(function () use ($employee, $data) {
            if ($employee->update($data)) {
                //$employee->syncPermissions($data['permissions']);
                //event(new EmployeeUpdated($employee));
                return $employee;
            }

            throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
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
}
