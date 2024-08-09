@extends('includes.commons.app')
@section('content')
    @include('includes.css.user.liststyle')
    <div class="row border border-success">
        <div class="col-lg-12 bg-success rounded-bottom">
            <h3 class="text-white">User List</h3>
        </div>
        <div class="col-12 form-group">
            <form action="{{ route('user.userlist') }}" method="GET" class="d-flex my-3">
                <h5>Name:</h5>
                <input type="text" name="name" class="form-control mx-2" value="{{old('name')}}">
                <h5>Email:</h5>
                <input type="email" name="email" class="form-control" value="{{old('email')}}">
                <h5>Form:</h5>
                <input type="date" id="start" name="startDate" value="" class="form-control mx-2">
                <h5>to:</h5>
                <input type="date" id="start" name="endDate" value="" class="form-control">
                <h5></h5>
                <input type="submit" value="Search" class="btn btn-success mx-2">
            </form>
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="table-responsive-xxl">
                <table class="table table-striped text-center">
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Name</th>
                        <th colspan="2">Email</th>
                        <th colspan="2">Created User</th>
                        <th>Type</th>
                        <th>Phone</th>
                        <th>Date Of Birth</th>
                        <th colspan="2">Address</th>
                        <th colspan="2">Created At</th>
                        <th colspan="2">Updated At</th>
                        @if (Auth::check() && Auth::user()->type != 1)
                            <th>Operation</th>
                        @endif
                    </tr>
                    @foreach ($users as $index => $user)
                        @include('layouts.modals.userDetailModal')
                        <tr class="table">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a class="text-decoration-none" href="" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $user->id }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td colspan="2">{{ $user->email }}</td>
                            <td colspan="2">{{ $user->name }}</td>
                            <td>
                                {{ $user->type == 0 ? 'Admin' : 'User' }}
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->dob->format('Y/m/d') }}</td>
                            <td colspan="2">{{ $user->address }}</td>
                            <td colspan="2">{{ $user->created_at }}</td>
                            <td colspan="2">{{ $user->updated_at }}</td>
                            @if (Auth::check() && Auth::user()->type != 1)
                                <td>
                                    <a class="text-decoration-none btn btn-danger" href="" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">
                                        Delete
                                    </a>
                                </td>
                            @endif
                        </tr>
                        @include('layouts.modals.userDeleteModal')
                    @endforeach
                </table>
            </div>
           <div class="margin-auto"> {{ $users->links() }}</div>
        </div>
    </div>
@endsection
