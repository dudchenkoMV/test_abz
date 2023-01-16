<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeCollectionResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('position')->paginate(50);

        return view('admin.employees.index', compact('employees'));
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
        $admin = \Auth::user();

        $data = array_merge($request->validated(), [
            'admin_created_id' => $admin->id,
            'admin_updated_id' => $admin->id,
        ]);

        if (isset($data['photo'])) {
            $imageName = uniqid() . '.' . $data['photo']->getClientOriginalExtension();
            $dir = public_path('uploads/');
            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }
            Image::make($data['photo'])
                ->resize(300, 300)
                ->encode('jpg', 80)
                ->save($dir . $imageName);
            $dir = public_path('uploads/thumbnails/');
            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }
            Image::make($data['photo'])
                ->encode('jpg', 80)
                ->ellipse(80, 80, 40, 40)
                ->save($dir . $imageName);

            $data['photo'] = $imageName;
        }

        $data['employment_at'] = Date::make($data['employment_at']);

        $position = Position::findOrFail($data['position_id']);
        $position->employees()->create($data);

        return redirect()->route('employees.index');
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
        $data = array_merge($request->validated(), [
           'admin_created_at' => \Auth::user()->id,
        ]);

        $employee->update($data);

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function paginate(Request $request)
    {

        $start = $request->input('start');
        $length = $request->input('length');
        $columns = $request->input('columns');
        $orders = $request->input('order');
        $search = $request->input('search.value');

        /** @var Builder $builder */

        $builder = Employee::join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*')
            ->addSelect('positions.name as position')
            ->offset($start)
            ->limit($length);
        foreach ($orders as $order) {
            $builder = $builder->orderBy($columns[$order['column']]['name'], $order['dir']);
        }

        if ($search) {
            $builder = $builder
                ->where('employees.name', 'LIKE', "%{$search}%" )
                ->orWhere('positions.name', 'LIKE', "%{$search}%")
                ->orWhere('employees.phone', 'LIKE', "%{$search}%")
                ->orWhere('employees.email', 'LIKE', "%{$search}%")
                ->orWhere('employees.salary', 'LIKE', "%{$search}%");
        }

        $employees = $builder->get();

        return \response()->json(new EmployeeCollectionResource($employees));
    }
}
