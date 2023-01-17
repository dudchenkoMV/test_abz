<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollectionResource;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmployeeDataTableContoller extends Controller
{
    public function __invoke(Request $request)
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
