@extends('admin.dashboard')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ __('Positions') }}</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Add position') }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="alert alert-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <div class="row d-flex justify-content-end">
                                <div class="col-sm-4">
                                    <a class="btn btn-block btn-outline-secondary" href="{{ route('positions.index') }}">Cancel</a>
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
