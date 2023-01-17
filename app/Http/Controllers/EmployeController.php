<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeCollectionResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Position;
use App\Repositories\Contracts\EmployeeRepositoryContract;
use App\Repositories\EmployeeRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeController extends Controller
{
    protected EmployeeRepository $employeeRepository;
    public function __construct(EmployeeRepositoryContract $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();

        return view('admin.employees.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return Response
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->employeeRepository->store($request->validated());
            DB::commit();
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all();

        return view('admin.employees.edit', compact('employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();
        try {
            $this->employeeRepository->update($request->validated(), $employee);
            DB::commit();
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $this->employeeRepository->delete($employee);
            DB::commit();
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e->getMessage());
            return redirect()->back();
        }
    }
}
