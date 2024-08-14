@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="col-6 offset-3 bg-success">
            <h4 class="text-white">Create Post</h4>
        </div>
        <div class="bg-light col-6 offset-3 border border-success p-3">
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 text-end">Title</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="title" value="{{$data['title']}}">
                        <input type="text" value="{{ $data['title'] }}" class="form-control" disabled>
                        @error('title')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 text-end">Description</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="description" value="{{$data['description']}}">
                        <input type="text" value="{{ $data['description'] }}" class="form-control"
                            disabled>
                        @error('title')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success">Confirm</button>
                        <button type="button" class="btn btn-primary" onclick="window.history.back();">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
