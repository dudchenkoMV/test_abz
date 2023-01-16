@extends('admin.dashboard')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ __('Employees') }}</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Edit employee') }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="photo">{{ __('Photo') }}</label>
                            @if($employee->photo)
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('uploads/' . $employee->photo) }}" alt="{{ __('Employee photo') }}" width="300" height="300">
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <button id="photo_button" class="btn btn-outline-secondary btn-block" type="button">{{ __('Browse') }}</button>
                                    <input id="photo_input" class="form-control-file" type="file" id="photo" name="photo" hidden>
                                </div>
                            </div>
                            @error('photo')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $employee->name }}">
                            @error('name')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input class="form-control"
                                   type="text"
                                   id="phone"
                                   name="phone"
                                   data-inputmask="'mask': '+380 (99) 999 99 99'"
                                   data-mask
                                   inputmode="text"
                                   placeholder="+380 (XX) XXX XX XX"
                                   value="{{ $employee->phone }}">
                            @error('phone')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ $employee->email }}">
                            @error('email')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position_id">{{ __('Position') }}</label>
                            <select class="form-control" name="position_id" id="position_id">
                                @foreach($positions as $position)
                                    <option @if($position == $employee->position) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="salary">{{ __('Salary, $') }}</label>
                            <input class="form-control" type="text" id="salary" name="salary" value="{{ $employee->salary }}">
                            @error('salary')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--                <div class="form-group">--}}
                        {{--                    <label for="head">Head</label>--}}
                        {{--                    <input class="form-control" type="date" id="head" name="head" value="{{ old('head') }}">--}}
                        {{--                    @error('head')--}}
                        {{--                        <div class="alert alert-warning">{{ $message }}</div>--}}
                        {{--                    @enderror--}}
                        {{--                </div>--}}
                        <div class="form-group">
                            <label for="employment_at">{{ __('Date of employment') }}</label>
                            <input class="form-control" type="date" id="employment_at" name="employment_at" value="{{ $employee->employment_at }}">
                            @error('employment_at')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{ __('Created at: ') . $employee->created_at }}
                                </div>
                                <div class="col-sm-6 text-right">
                                    {{ __('Admin created id: ') . $employee->admin_created_id }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{ __('Updated at: ') . $employee->updated_at }}
                                </div>
                                <div class="col-sm-6 text-right">
                                    {{ __('Admin updated id: ') . $employee->admin_updated_id }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row d-flex justify-content-end">
                                <div class="col-sm-4">
                                    <a class="btn btn-block btn-outline-secondary" href="{{ route('employees.index') }}">Cancel</a>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-block btn-secondary" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')

@endsection
