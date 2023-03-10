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
                    <h2 class="card-title">{{ __('Add employee') }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="photo">
                                @error('photo')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Photo') }}
                            </label>
                            <div class="row">
                                <div class="col-md-5">
                                    <button id="photo_button" class="btn btn-outline-secondary btn-block" type="button">{{ __('Browse') }}</button>
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
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}">
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
                            <input class="form-control @error('phone') is-invalid @enderror"
                                   type="text"
                                   id="phone"
                                   name="phone"
                                   data-inputmask="'mask': '+380 (99) 999 99 99'"
                                   data-mask
                                   inputmode="text"
                                   placeholder="+380 (XX) XXX XX XX"
                                   value="{{ old('phone') }}"
                            >
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
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
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
                            <select class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
                                @foreach($positions as $position)
                                    <option @if(old('position_id') == $position->id) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
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
                            <input id="salary" class="form-control @error('salary') is-invalid @enderror" type="text" id="salary" name="salary" value="{{ old('salary') }}">
                            @error('salary')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="employment_at">
                                @error('employment_at')
                                <i class="far fa-times-circle text-red"></i>
                                @enderror
                                {{ __('Date of employment') }}
                            </label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('employment_at') is-invalid @enderror" id="employment_at" name="employment_at" value="{{ old('employment_at') }}" data-target="#reservationdate" data-toggle="datetimepicker" placeholder="????.????.????">
                            </div>
                            @error('employment_at')
                            <div class="text-danger text-sm-left">{{ $message }}</div>
                            @enderror
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

@yield('mask-script')
