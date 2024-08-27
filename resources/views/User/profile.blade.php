@extends('includes.commons.app')
@section('content')

    <div class="row">
        <div class="col-8 bg-success rounded-top  mx-auto">
            <h3 class="text-white">Profile</h3>
        </div>
        <div class="col-8 bg-light mx-auto border border-success py-3">
            <div class="row">
                <div class="col-4">
                    @if ($authUser->profile)
                        <img src="{{ asset('storage/' . $authUser->profile) }}" alt="Profile Picture"
                            class="img-fluid rounded-circle">
                    @else
                        <img src="{{ asset('images/default_photo.png') }}" alt="Profile Picture"
                            class="img-fluid rounded-circle"><br>
                    @endif
                </div>
                <div class="col-4">
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Name</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->name }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Type</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->type == 0 ? 'Admin' : 'User' }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Email</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->email }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Phone</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->phone }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Date of Birth</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->dob->format('Y/m/d') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <span for="dob" class="col-sm-6">Address</span>
                        <div class="col-sm-6">
                            <span>{{ $authUser->address }}</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('user.profileEdit',$authUser->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('user.userlist') }}" class="btn btn-success">Back</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

