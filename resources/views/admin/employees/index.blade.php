@extends('admin.dashboard')

@section('content-header')
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ __('Employees') }}</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-secondary float-sm-right" href="{{ route('employees.create') }}">{{ __('Add employee') }}</a>
            </div>
        </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4>{{ __('Employee list') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="employees_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="employees-table" class="table table-striped table-hover dataTable dtr-inline" aria-describedby="employees-info">
                                <thead>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Photo</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Position</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Date of employment</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Phone number</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="employees-table" rowspan="1" colspan="1">Salary</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="employees" rowspan="1" colspan="1">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div id="employees-info" class="dataTables_info"  role="status" aria-live="polite"></div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div id="employees-paginate" class="dataTables_paginate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.employees.modals.delete')
@endsection


