@extends('layouts.app')
@include('layouts.common.header')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto border border-dark py-3 ">
            <div class="bg-success rounded-top">
                <h4>Are you sure to update this post?</h4>
            </div>
            <div class="bg-light">
                <form action="{{route('post.store')}}" method="Post">
                    @csrf
                    <input type="text" name="id" value="{{$post['id']}}" hidden>
                    <input type="text" name="title" value="{{ $post['title'] }}" class="form-control">
                    @error('title')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <textarea name="body" rows="10" class="form-control">{{ $post['body'] }}</textarea>
                    @error('body')
                        <small class="alert text-danger">{{ $message }}</small><br>
                    @enderror
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled"
                            checked disabled>
                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Active</label>
                    </div>
                   <button type="submit" class="btn btn-success" my-2>Confirm</button>
                    <a href="{{route('post.edit',$post['id'])}}" class="btn btn-primary">Cancel</a>

                </form>
            </div>
        </div>
    </div>
@endsection
