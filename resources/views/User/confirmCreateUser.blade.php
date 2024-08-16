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
                        <input type="text" class="form-control" value="{{ $data['name'] }}" disabled>
                        <input type="text" class="form-control" name="name" value="{{ $data['name'] }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" value="{{ $data['email'] }}" disabled>
                        <input type="email" class="form-control" name="email" value="{{ $data['email'] }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $data['password'] }}" disabled>
                        <input type="password" class="form-control" name="password" value="{{ $data['password'] }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $data['password_confirmation'] }}" disabled>
                        <input type="password" class="form-control" name="password_confirmation"
                            value="{{ $data['password_confirmation'] }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $data['phone'] }}" disabled>
                        <input type="text" class="form-control" name="phone" value="{{ $data['phone'] }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ $data['address'] }}" disabled>
                        <input type="text" class="form-control" name="address" value="{{ $data['address'] }}" hidden>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->type == 0)
                    <div class="mb-3 row">
                        <label for="dob" class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{ $data['type'] == 0 ? 'Admin' : 'User' }}" class="form-control"
                                disabled>
                            <input type="text" name="type" value="{{ $data['type'] }}" hidden>
                        </div>
                    </div>
                @endif
                <div class="mb-3 row">
                    <label for="dob" class="col-sm-4 col-form-label">Date of Birth</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" value="{{ $data['dob'] }}" disabled>
                        <input type="date" class="form-control" name="dob" value="{{ $data['dob'] }}" hidden>
                    </div>
                </div>
                <div class="row">
                    <label for="dob" class="col-sm-4 col-form-label">Profile</label>
                    <div class="col-sm-4">
                       @if(isset($data['profile']))
                       <img src="{{ asset('Storage/' . $data['profile']) }}" alt="Profile Photo">
                       <input type="text" name="profile" value="{{ $data['profile'] }}" hidden>
                       @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <button type="submit" class="btn btn-success offset-4 col-2">Register</button>
                    <button type="button" class="btn btn-primary col-2 ms-2" onclick="window.history.back();">Back</button>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
