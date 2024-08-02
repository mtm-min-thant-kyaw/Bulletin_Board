@extends('layouts.app')
@include('layouts.common.header')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto border border-dark py-3">
            <div class="bg-success rounded-top ">
                <h4>Edit Post</h4>
            </div>
            <div class="bg-light">
                <form action="{{ route('post.editConfirmPage') }}" method="POST" id="editPostForm">
                    @csrf
                    <input type="text" name="id" value="{{ $post->id }}" hidden>
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                    @error('title')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <label for="" class="my-2">Description</label>
                    <input type="text" name="body" value="{{ $post->body }}" class="form-control">
                    @error('body')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <label for="">Status</label>
                    <input type="checkbox" name="status">
                    <div>
                        <button type="submit" class="btn btn-success my-2">Update</button>
                        <a href="{{ route('post.postlist') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
