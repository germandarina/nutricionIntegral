<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
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
        Session::flash('success','Empleado Creado');
        return redirect()->route('admin.employee.index');
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
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.employee.index');
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
        Session::flash('success','Empleado Actualizado');
        return redirect()->route('admin.employee.index');
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
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.employee.index');
        }

        $this->employeeRepository->deleteById($employee->id);
        Session::flash('success','Empelado Eliminado');
        return redirect()->route('admin.employee.index');
    }

    public function getDeleted(ManageEmployeeRequest $request){
        if ($request->ajax()) {
            $data = $this->employeeRepository->getDeletedPaginated(25, 'id', 'asc');
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
     * @param ManageEmployeeRequest $request
     * @param integer              $id
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function restore(ManageEmployeeRequest $request, $id)
    {
        $employee = Employee::onlyTrashed()->find($id);
        $this->employeeRepository->restore($employee);
        Session::flash('success','Empleado restaurado');
        return redirect()->route('admin.employee.index');
    }
}
