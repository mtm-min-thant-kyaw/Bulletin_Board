@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 rounded-top bg-success">
            <h3 class="text-white">Register</h3>
        </div>
        <div class="offset-3 col-6  border border-success bg-light">
            <form action="{{ route('user.confirmPage') }}" method="POST" id="createUserForm" enctype="multipart/form-data">
                @csrf
                <div class="my-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                        @error('address')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->type == 1)
                    <input type="hidden" name="type" value="1">
                @endauth
                @if (Auth::check() && Auth::user()->type == 0)
                    <div class="mb-3 row">
                        <label for="type" class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <select name="type" class="form-select">
                                <option value="1">User</option>
                                <option value="0">Admin</option>
                            </select>
                            @error('type')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="mb-3 row">
                    <label for="dob" class="col-sm-4 col-form-label">Date of Birth</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                        @error('dob')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Profile</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="profile">
                        @error('profile')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="btn btn-success offset-4 col-2">Register</button>
                    <button type="reset" class="btn btn-primary col-2 ms-2">Clear</button>
                </div>
        </form>
    </div>
</div>
@endsection
