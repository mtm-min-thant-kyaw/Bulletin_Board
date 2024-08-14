@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 bg-success rounded-top">
            <h4 class="text-white">Are you sure to update this post?</h4>
        </div>
        <div class="bg-light offset-3 col-6 border border-success p-3">
            <form action="{{ route('post.update', $post->id) }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 text-end">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{ $updatedPost['title'] }}" class="form-control"
                            disabled>
                        <input type="hidden" name="title" value="{{ $updatedPost['title'] }}" class="form-control">
                        @error('title')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 text-end">Description</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="description" value="{{ $updatedPost['description'] }}">
                        <textarea type="text" class="form-control" disabled>{{ $updatedPost['description'] }}</textarea>
                        @error('description')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 text-end">
                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Status</label>
                    </div>
                    <div class="form-check form-switch col-sm-2">
                        <input type="hidden" name="status" value="{{ $updatedPost['status'] }}">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled"
                            @if ($updatedPost['status'] != 0) checked @endif disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="btn btn-success  offset-2 col-2 me-1">Confirm</button>
                    <button type="button" class="btn btn-secondary col-2" onclick="window.history.back();">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
