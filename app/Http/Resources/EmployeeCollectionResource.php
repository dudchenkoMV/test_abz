<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = Employee::count();
        $filterCount = $count;

        if($request->input('search.value')) {
            $filterCount = $this->count();
        }

        return [
            'draw' => $request->get('draw'),
            'recordsTotal' => $count,
            'recordsFiltered' => $filterCount,
            'data' => EmployeeResource::collection($this->collection),
        ];
    }
}
