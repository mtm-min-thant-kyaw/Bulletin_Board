@include('layouts.common.header')
@include('layouts.common.footer')
@extends('layouts.app')
@section('content')
    <div class="row border border-dark">
        <div class="col-12 bg-success rounded">
            <h3>User List</h3>
        </div>
        <div class=" offset-1 col-10 my-3">
            <form action="" class="d-flex">
                <h4>Name:</h4>
                <input type="text" class="form-control mx-2">
                <h4>Email:</h4>
                <input type="text" class="form-control">
                <h4>Form:</h4>
                <input type="date" id="start" name="startDate" value="" class="form-control mx-2">
                <h4>to:</h4>
                <input type="date" id="start" name="endDate" value="" class="form-control">
                <h4></h4>
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
            <table class="table table-striped text-center">
                <tr class="table-primary">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created User</th>
                    <th>Type</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Operation</th>
                </tr>
                @foreach ($users as $index => $user)
                    <tr class="table">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a class="text-decoration-none" href="" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $user->id }}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->createUser->name }}</td>
                        <td>
                            @if ($user->type == 1)
                                Admin
                            @else
                                User
                            @endif
                        </td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->dob}}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at}}</td>

                        <td>
                            @if (Auth::check() && Auth::user()->type == 1)
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                Delete
                            </a>
                            @endif
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#detailModal">
                                Detail
                            </a>
                        </td>


                    </tr>
                    @include('layouts.modals.userDetailModal')
                    @include('layouts.modals.userDeleteModal')
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
