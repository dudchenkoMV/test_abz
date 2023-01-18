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
                    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="photo">
                                @error('photo')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Photo') }}
                            </label>
                            @if($employee->photo)
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset($employee->photo) }}" alt="{{ __('Employee photo') }}" width="300" height="300">
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <button id="photo_button" class="btn btn-outline-secondary btn-block" type="button">{{ __('Upload photo') }}</button>
                                    <input id="photo_input" class="form-control-file" type="file" name="photo" hidden>
                                </div>
                                <div class="col-md-7">
                                    <span id="photo_caption" class="text-sm text-gray"></span>
                                </div>
                            </div>
                            @error('photo')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">
                                @error('name')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Name') }}
                            </label>
                            <input class="form-control @error('name') is-invalid  @enderror" type="text" id="name" name="name" value="{{ $employee->name }}">
                            @error('name')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                @error('phone')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Phone') }}
                            </label>
                            <input class="form-control @error('phone') is-invalid  @enderror"
                                   type="text"
                                   id="phone"
                                   name="phone"
                                   data-inputmask="'mask': '+380 (99) 999 99 99'"
                                   data-mask
                                   inputmode="text"
                                   placeholder="+380 (XX) XXX XX XX"
                                   value="{{ $employee->phone }}">
                            @error('phone')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                @error('email')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Email') }}
                            </label>
                            <input class="form-control @error('email') is-invalid  @enderror" type="email" id="email" name="email" value="{{ $employee->email }}">
                            @error('email')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position_id">
                                @error('position_id')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Position') }}
                            </label>
                            <select class="form-control @error('position_id') is-invalid  @enderror" name="position_id" id="position_id">
                                @foreach($positions as $position)
                                    <option @if($position == $employee->position) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="salary">
                                @error('salary')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Salary, $') }}
                            </label>
                            <input class="form-control @error('salary') is-invalid  @enderror" type="text" id="salary" name="salary" value="{{ $employee->salary }}">
                            @error('salary')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
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
                            <label for="employment_at">
                                @error('employment_at')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Date of employment') }}
                            </label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input class="form-control datetimepicker-input  @error('employment_at') is-invalid  @enderror" type="text" id="employment_at" name="employment_at" value="{{ \Illuminate\Support\Facades\Date::make($employee->employment_at)->format('dd.mm.yy') }}" data-target="#reservationdate" data-toggle="datetimepicker" placeholder="дд.мм.рр">
                            </div>
                            @error('employment_at')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
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
