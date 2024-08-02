@extends('layouts.app')
@include('layouts.common.header')
@section('content')

    <div class="row">
        <div class="col-6 mx-auto border border-dark py-3">
            <div class="bg-success rounded-top ">
                <h3>Create Post</h3>
            </div>
            <div class="bg-light">
                @if (session('fail'))
                        <div class="">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('fail') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                <form action="{{ route('create') }}" method="POST" id="createUserForm">
                    @csrf
                    <h4>Title</h4>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    @error('title')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <h4 class="my-2">Description</h4>
                    <input type="text" name="body" class="form-control" value="{{old('body')}}">
                    @error('title')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <div>
                        <input type="submit" class="btn btn-success" value="Create">
                        <a href="" class="btn btn-primary">Clear</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function resetForm() {
            document.getElementById("createUserForm").reset();
        }
    </script>
@endsection
