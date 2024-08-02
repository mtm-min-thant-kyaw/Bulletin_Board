@extends('layouts.app')
@include('layouts.common.header')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto border border-dark py-3 ">
            <div class="bg-success rounded-top">
                <h4>Create Post</h4>
            </div>
            <div class="bg-light">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <h4 for="title">Title</h4>
                    <input type="text" name="title" value="{{ $data['title'] }}" class="form-control">
                    @error('title')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <h4 for="body">Description</h4>
                    <textarea name="body" id="" rows="15" class="form-control">{{ $data['body'] }}</textarea>
                    @error('body')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <button type="submit" class="btn btn-success">Confirm</button>
                    <a href="{{ route('post.postlist') }}" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
