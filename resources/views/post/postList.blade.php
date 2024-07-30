@extends('layouts.app')
@section('content')
@include('layouts.modals.postDetailModal')
@include('layouts.modals.postDeleteModal')
    <div class="row border border-dark">
        <div class="col-12 bg-success rounded">
            <h3>Post List</h3>
        </div>
        <div class=" offset-1 col-10 d-flex justify-content-between my-3">
            <form action="" class="form d-flex">
                Keyword::<input type="" class="form-control me-2">
                <input type="submit" value="Search" class="btn btn-success">
            </form>

            <a href="{{ route('post.createPage') }}" class="btn btn-success">Create</a>
            <button class="btn btn-success">Upload</button>
            <button class="btn btn-success"> Download</button>

        </div>
        <div class="col-12">
            <table class="table table-striped">
                <tr class="table-primary">
                    <th>Post Title</th>
                    <th>Post Description</th>
                    <th>Posted User</th>
                    <th>Posted Created</th>
                    <th>Operation</th>
                </tr>
                <tr class="table">
                    <td>
                        <!-- Button post Detail modal -->
                        <a class="text-decoration-none" href="" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Details
                        </a>
                    </td>
                    <td>Description1</td>
                    <td>Min Thant Kyaw</td>
                    <td>2024/07/22</td>
                    <td>
                        <a href="" class="btn btn-info">Edit</a>
                        <a class="text-decoration-none btn btn-danger" href="" data-bs-toggle="modal"
                            data-bs-target="#delete">
                            Delete
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>


@endsection
