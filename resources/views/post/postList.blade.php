@include('layouts.common.header')
@extends('layouts.app')
@section('content')

    <div class="row border border-dark">
        <div class="col-12 bg-success rounded">
            <h3>Post List</h3>
        </div>
        <div class=" offset-1 col-10 d-flex justify-content-between my-3">
            <form action="{{ route('post.postlist') }}" method="GET" class="form d-flex">
                Keyword::<input type="text" name="searchKey" class="form-control me-2" value="{{old('name')}}">
                <input type="submit" value="Search" class="btn btn-success">
            </form>
            <a href="{{ route('post.createPage') }}" class="btn btn-success">Create</a>
            <button class="btn btn-success">Upload</button>
            <button class="btn btn-success"> Download</button>
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
            <table class="table table-striped">
                <tr class="table-primary">
                    <th>Post Title</th>
                    <th>Post Description</th>
                    <th>Posted User</th>
                    <th>Posted Created</th>
                    <th>Operation</th>
                </tr>
                @foreach ($posts as $index => $post)

                    <tr class="table">
                        <td>
                            <!-- Button post Detail modal -->
                            <a class="text-decoration-none" href="" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $post->id }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td> {{ $post->body }}</td>
                        <td> {{ $post->user->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-info text-decoration-none">Edit</a>
                                <a class="text-decoration-none btn btn-danger" href="" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $post->id }}">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @include('layouts.modals.postDeleteModal')
                    @include('layouts.modals.postDetailModal')
                @endforeach

                @if (count($posts) == 0)
                <tr>
                    <td class="text-danger text-center" colspan="5"><h3>Nothing to show data!.</h3></td>
                </tr>
            @endif
            </table>
            {{$posts->links()}}
        </div>
    </div>
@endsection
