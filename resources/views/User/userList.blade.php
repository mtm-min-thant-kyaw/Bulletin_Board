@include('layouts.common.header')
@extends('layouts.app')
@section('content')
    <div class="row border border-dark">
        <div class="col-12 bg-success rounded">
            <h3>User List</h3>
        </div>
        <div class=" offset-1 col-10 my-3">
            <form action="" class="form d-flex">
                Name::<input type="text" class="form-control mx-2">
                Emial::<input type="text" class="form-control">
                From::<input type="date" id="start" name="startDate" value="" class="form-control mx-2">
                to::<input type="date" id="start" name="endDate" value="" class="form-control">
                <input type="submit" value="Search" class="btn btn-success mx-2">
            </form>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <tr class="table-primary">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created User</th>
                    <th>Type</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                    <th>Address</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Operation</th>
                </tr>
                @foreach ($users as $index => $user)
                    <tr class="table">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_user_id }}</td>
                        <td>
                            @if ($user->type == 1)
                                Admin
                            @else
                                User
                            @endif
                        </td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->dob }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary" href="" data-bs-toggle="modal"
                                    data-bs-target="#detailModal">
                                    Details
                                </a>
                                <a class="btn btn-danger" href="" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    Delete
                                </a>
                            </div>
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
