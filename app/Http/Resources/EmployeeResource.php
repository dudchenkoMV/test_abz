<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Intervention\Image\Facades\Image;
use function PHPUnit\Framework\isNull;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'DT_RowId' => 'row_' . $this->id,
            'DT_RowData' => [
                'pkey' => $this->id
            ],
            'preview' => '<img src="' . asset($this->preview) . '" class="rounded-circle" width="50" height="50">',
            'name' => $this->name,
            'position' => $this->position,
            'employment_at' => $this->employment_at,
            'phone' => $this->phone,
            'email' => $this->email,
            'salary' => $this->salary,
            'action' => '
                <a class="btn" href="' . route('employees.edit', $this) . '">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <button type="button"
                        id="employee_delete_button"
                        class="btn"
                        data-toggle="modal"
                        data-target="#employee_delete_modal"
                        data-href="' . route('employees.destroy', $this) . '"
                        data-name="' . $this->name . '"
                >
                    <i class="far fa-trash-alt"></i>
                </button>'
        ];
    }
}
