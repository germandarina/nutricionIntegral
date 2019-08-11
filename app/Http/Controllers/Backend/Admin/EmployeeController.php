<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Models\Auth\Role;
use App\Models\Traits\Relationship\EmployeeRelationship;
use App\Repositories\Backend\Admin\EmployeeRepository;
use App\Http\Requests\Backend\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Backend\Admin\Employee\ManageEmployeeRequest;
use App\Http\Requests\Backend\Admin\Employee\UpdateEmployeeRequest;
use JsValidator;
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
                    return view('backend.admin.employee.includes.datatable-buttons',compact('row'));
                })
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
        $validator = JsValidator::formRequest(StoreEmployeeRequest::class);
        return view('backend.admin.employee.create',compact('validator'));
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
        $validator = JsValidator::formRequest(UpdateEmployeeRequest::class);

        return view('backend.admin.employee.edit',compact('employee','validator'));
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
            $data = $this->employeeRepository->getDeletedPaginated(25, 'id', 'asc');

//            $data = $this->employeeRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.employee.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.employee.deleted');
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $deletedRole
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageRoleRequest $request, $id)
    {
        $employee = Employee::onlyTrashed()->find($id);
        $this->employeeRepository->restore($employee);
        Session::flash('success','Empleado restaurado');
        return redirect()->route('admin.employee.index');
    }
}
