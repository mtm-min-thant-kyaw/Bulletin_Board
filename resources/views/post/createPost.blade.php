@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 rounded-top bg-success">
            <h3 class="text-white">Create Post</h3>
        </div>
        <div class="offset-3 col-6 border border-success">
            @if (session('fail'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <form action="{{ route('create') }}" method="POST" id="createUserForm">
                @csrf
                <div class="my-3 row">
                    <label for="title" class="col-sm-4 col-form-label">Title @error('title')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="my-3 row">
                    <label for="description" class="col-sm-4 col-form-label">Description @error('title')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        @error('description')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="my-3 row">
                    <div class="offset-4 col-sm-8">
                        <input type="submit" class="btn btn-success" value="Create">
                        <button type="reset" class="btn btn-primary">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
