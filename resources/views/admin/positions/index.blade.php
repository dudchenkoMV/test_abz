@extends('admin.dashboard')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ __('Positions') }}</h1>
            </div>
            @if(Route::is('positions.index'))
                <div class="col-sm-6">
                    <a class="btn btn-secondary float-sm-right" href="{{ route('positions.create') }}">{{ __('Add position') }}</a>
                </div>
            @endif
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4>{{ __('Position list') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div id="positions_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="positions-table" class="table table-striped table-hover dataTable dtr-inline" aria-describedby="positions-info">
                                <thead>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="employees" rowspan="1" colspan="1">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="employees" rowspan="1" colspan="1">Last update</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="employees" rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($positions as $position)
                                    @include('admin.positions.parts.table', $position)
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div id="positions-info" class="dataTables_info"  role="status" aria-live="polite"></div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div id="positions-paginate" class="dataTables_paginate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.positions.modals.delete')
@endsection
