@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 bg-success rounded-top shadow">
            <h3 class="text-white">Change Password</h3>
        </div>
        <div class="offset-3 col-6 border border-success p-3 shadow">
            <form action="{{ route('password.change') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label text-end">Current Password @error('password')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" value="">
                        @error('password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="newpassword" class="col-sm-4 col-form-label text-end">New Password Password
                        @error('new_password')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="new_password" value="">
                        @error('new_password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirmpassword" class="col-sm-4 col-form-label text-end">New Confirm Password Password
                        @error('new_confirm_password')
                            <span class="text-danger">*</span>
                        @enderror
                    </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="new_confirm_password" value="">
                        @error('new_confirm_password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="submit" class="btn btn-primary offset-4 col-3">Update Password</button>
                </div>

            </form>
        </div>
    </div>
@endsection
