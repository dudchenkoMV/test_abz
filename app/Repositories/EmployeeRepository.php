<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Position;
use App\Repositories\Contracts\EmployeeRepositoryContract;
use App\Services\ImageService;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Exception;

class EmployeeRepository implements EmployeeRepositoryContract
{
    public function all()
    {
        return Employee::with('position')->paginate(50);
    }

    public function find(Employee $employee)
    {
        return Employee::findOrFail($employee->id);
    }

    public function store($data)
    {
        $position = Position::findOrFail($data['position_id']);

        $image = $data['photo'] ?? '';

        $data = array_merge($data, [
            'photo' => ImageService::uploadImage($image),
            'preview' => ImageService::uploadPreview($image),
            'employment_at' => Date::make($data['employment_at']),
            'admin_created_id' => \Auth::id(),
            'admin_updated_id' => \Auth::id(),
        ]);

        $position->employees()->create($data);
    }

    public function update($data, Employee $employee)
    {
        $position = Position::findOrFail($employee->position_id);

        $data = array_merge($data, [
            'employment_at' => Date::make($data['employment_at']),
            'admin_updated_id' => \Auth::id(),
        ]);

        if (isset($data['photo'])) {
            ImageService::remove([$employee->photo, $employee->preview]);

            $data = array_merge($data, [
                'photo' => ImageService::uploadImage($data['photo']),
                'preview' => ImageService::uploadPreview($data['photo']),
            ]);
        }

        $position->employees()->update($data);
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }
}
