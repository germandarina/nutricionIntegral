<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\EmployeeRepository;
use App\Http\Requests\Backend\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Backend\Admin\Employee\ManageEmployeeRequest;
use App\Http\Requests\Backend\Admin\Employee\UpdateEmployeeRequest;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Employee;

/**
 * Class EmployeeController.
 */
class EmployeeController extends Controller
{
    /**
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    /**
     * @param EmployeeRepository       $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param ManageEmployeeRequest $request
     *
     * @return mixed
     */
    public function index(ManageEmployeeRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->employeeRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="labels.backend.access.users.user_actions">
                              <a href='.route("admin.employee.edit",['id'=>$row->id]).' class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Modificar"></i></a>
                            </div>';
                })
                //                              <a href='.route("admin.employee.destroy",['id'=>$row->id]).' data-method="delete" data-trans-button-cancel="Cancelar" data-trans-button-confirm="Eliminar" data-trans-title="¿Está seguro?" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.employee.index');
    }

    /**
     * @param ManageEmployeeRequest $request
     *
     * @return mixed
     */
    public function create(ManageEmployeeRequest $request)
    {
        return view('backend.admin.employee.create');
    }

    /**
     * @param StoreEmployeeRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeRepository->create($request->all());
        return redirect()->route('admin.employee.index')->withFlashSuccess(__('alerts.backend.roles.created'));
    }

    /**
     * @param ManageEmployeeRequest $request
     * @param Employee              $employee
     *
     * @return mixed
     */
    public function edit(ManageEmployeeRequest $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.employee.index')->withFlashDanger('You can not edit the administrator role.');
        }

        return view('backend.admin.employee.edit',compact('employee'));
    }

    /**
     * @param UpdateEmployeeRequest $request
     * @param Employee              $employee
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeRepository->update($request->all(), $employee);

        return redirect()->route('admin.employee.index')->withFlashSuccess(__('alerts.backend.roles.updated'));
    }

    /**
     * @param ManageEmployeeRequest $request
     * @param Employee              $employee
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageEmployeeRequest $request, Employee $employee)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.employee.index')->withFlashDanger(__('exceptions.backend.access.roles.cant_delete_admin'));
        }

        $this->employeeRepository->deleteById($employee->id);

        return redirect()->route('admin.employee.index')->withFlashSuccess(__('alerts.backend.roles.deleted'));
    }

    public function getDeleted(ManageEmployeeRequest $request){
        if ($request->ajax()) {
            $data = $this->employeeRepository->orderBy('id')
                         ->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return $row->action_buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.employee.deleted');
    }
}
