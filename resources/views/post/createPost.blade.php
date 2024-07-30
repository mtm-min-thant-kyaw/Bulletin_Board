@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto border border-dark py-3">
            <div class="bg-success rounded-top ">
                <h4>Create Post</h4>
            </div>
            <div class="bg-light">
                <form action="">
                    @csrf
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                    <label for="" class="my-2">Description</label>
                    <input type="text" name="description" class="form-control">
                    <div>
                        <a href="" class="btn btn-success">Create</a>
                        <input type="submit" value="Cancel" class="btn btn-secondary my-2">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
