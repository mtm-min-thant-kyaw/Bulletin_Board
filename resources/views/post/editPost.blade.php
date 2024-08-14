@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6  bg-success">
            <h4 class="text-white">Edit Post</h4>
        </div>
        <div class="bg-light col-6 offset-3 border border-success p-3">
            <form action="{{ route('post.preview', $post->id) }}" method="POST" id="editPostForm">
                @csrf
                <div class="mb-3 row">
                    <input type="text" name="id" value="{{ $post->id }}" hidden>
                    <label for="title" class="col-sm-2 text-end">Title @error('title')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" id="title">
                        @error('title')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 text-end">Description @error('description')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" id="description">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="form-check-label col-sm-2 text-end">Status</label>
                    <div class="form-check form-switch col-sm-10">
                        <input type="hidden" name="status" value="{{ $post->status }}">
                        <input type="checkbox" class="form-check-input" id="switch"
                            @if ($post->status == 1) checked @endif>
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="btn btn-success offset-2 col-2 me-1">Edit</button>
                    <button type="button" class="btn btn-primary col-2" id="resetButton">Clear</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var resetButton = document.getElementById('resetButton');
            resetButton.addEventListener('click', function() {
                document.getElementById('title').value = "";
                document.getElementById('description').value = "";
            });

            var toggle = document.getElementById('switch');
            var hiddenInput = document.querySelector('input[name="status"]');

            toggle.addEventListener('change', function() {
                hiddenInput.value = this.checked ? 1 : 0;
            });
        });
    </script>
@endsection
