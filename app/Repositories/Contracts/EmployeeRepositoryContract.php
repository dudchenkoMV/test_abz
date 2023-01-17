<?php

namespace App\Repositories\Contracts;

use App\Models\Employee;

interface EmployeeRepositoryContract
{
    public function all();
    public function find(Employee $employee);
    public function store($data);
    public function update($data, Employee $employee);
    public function delete(Employee $employee);
}
