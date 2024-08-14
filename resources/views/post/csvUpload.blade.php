@extends('includes.commons.app')
@section('content')
    <div class="row">
        <div class="offset-3 col-6 rounded-top bg-success">
            <h3 class="text-white">Upload CSV File</h3>
        </div>
        <div class="offset-3 col-6 border border-success">
            @error('csv_file')
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @enderror
            @if (session('success'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <form action="{{ route('post.upload') }}" method="Post" enctype="multipart/form-data" id="csvForm">
                @csrf
                <div class="my-3 row">
                    <label for="csv" class="col-sm-4 col-form-label">CSV FIle</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control"name="csv_file" id="csv_file">
                    </div>
                </div>
                <div class="my-3 row">
                    <div class="offset-4 col-sm-8">
                        <input type="submit" class="btn btn-success" value="Upload">
                        <button type="reset" class="btn btn-primary" onclick="resetForm()">Clear</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function resetForm() {
            document.getElementById("csvForm").reset();
        }
    </script>
@endsection
