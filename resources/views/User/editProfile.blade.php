@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="col-8 bg-success rounded-top  mx-auto">
            <h3 class="text-white">Profile Edit</h3>
        </div>
        <div class="col-8 bg-light mx-auto border border-success">
            <div class="row">
                <div class="offset-3 col-6">
                    <form action="{{ route('user.update', $user->id) }}" method="Post" enctype="multipart/form-data" id="myForm">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Name</span>
                            <div class="col-sm-6">
                                <input type="text" name="name" value="{{ $user->name}}"
                                    class="form-control">
                                @error('name')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="email" class="col-sm-6">Email</span>
                            <div class="col-sm-6">
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="form-control">
                                @error('email')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <span for="type" class="col-sm-6"
                                @if ($user->type == 1) hidden @endif>Type</span>
                            <div class="col-sm-6">
                                <select name="type" class="form-select" @if ($user->type == 1) hidden @endif>
                                    <option value="0" @if ($user->type == 0) selected @endif>Admin</option>
                                    <option value="1" @if ($user->type == 1) selected @endif>User</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <span for="phone" class="col-sm-6">Phone</span>
                            <div class="col-sm-6">
                                <input type="text" name="phone" value="{{ $user->phone }}"
                                    class="form-control">
                                @error('phone')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Date of Birth</span>
                            <div class="col-sm-6">
                                <input type="date" name="dob" value="{{ $user->dob }}" class="form-control">
                                @error('dob')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <span for="address" class="col-sm-6">Address</span>
                            <div class="col-sm-6">
                                <input type="text" name="address" value="{{ $user->address}}"
                                    class="form-control">
                                @error('address')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Old Profile</span>
                            <div class="col-sm-6">

                                @if ($user->profile)
                                    <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Photo"
                                        class="img-fluid rounded-circle">
                                @else
                                    <img src="{{ asset('images/default_photo.png') }}" alt="Profile Photo"
                                        class="img-fluid rounded-circle"><br>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <span for="dob" class="col-sm-6">Choose New Profile</span>
                            <div class="col-sm-6">
                                <input type="file" name="newprofile" value="{{ $user->profile }}" class="form-control">
                                @error('newprofile')
                                    <small class="alert text-danger">{{ $message }}</small><br>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-primary" onclick="resetFunction();">Clear</button>
                            <a href="" class="text-decoration-none">Change Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function resetFunction() {
                document.getElementById("myForm").reset();
            }
        </script>
    @endsection

