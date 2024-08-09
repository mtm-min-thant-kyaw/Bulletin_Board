@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 rounded-top bg-success">
            <h3 class="text-white">Register Confirm</h3>
        </div>
        <div class="offset-3 col-6  border border-success ">
            <form action="{{ route('user.add') }}" method="POST" id="createUserForm" enctype="multipart/form-data">
                @csrf
                <div class="my-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" value="{{$data['name']}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" value="{{$data['email']}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" value="{{$data['password']}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirmation" value="{{$data['password_confirmation']}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" value="{{$data['phone']}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address" value="{{$data['address']}}">
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->type == 0)
                    <input type="text" name="type" value="{{$data['type']}}" hidden>
                @endif
                <div class="mb-3 row">
                    <label for="dob" class="col-sm-4 col-form-label">Date of Birth</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="dob" value="{{$data['dob']}}">
                    </div>
                </div>
                <div class="row">
                    <label for="dob" class="col-sm-4 col-form-label">Profile</label>
                    <div class="col-sm-4">
                       <img src="{{asset('Storage/'. $data['profile'])}}" alt="">
                    </div>
                </div>
                <input type="text" name="profile" value="{{$data['profile']}}" hidden>
                <div class="mb-3 row">
                    <button type="submit" class="btn btn-success offset-4 col-2">Register</button>
                    <button type="reset" class="btn btn-primary col-2 ms-2">Clear</button>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
