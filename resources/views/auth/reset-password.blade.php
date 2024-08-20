<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('includes.commons.style')
    @include('includes.commons.script')
    <title>Bulletin Board OJT</title>
</head>

<body>
    <div class="row">
        <div class="col-6 offset-3 bg-success">
            <h3 class="">Reset Password</h3>
        </div>
        <div class="col-6 offset-3 border border-success p-3">
            @if (session('error'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-msg">
                        <i class="fa-solid fa-check"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <form action="{{ route('password.reset') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row mb-3">
                    <label class="col-4 text-center">New Password</label>
                    <div class="col-8">
                        <input type="password" name="password" value="" class="form-control">
                        @error('password')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label class="col-4 text-center">Confirm Password</label>
                    <div class="col-8">
                        <input type="password" name="password_confirmation" value="" class="form-control">
                        @error('password_confirmation')
                            <small class="alert text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-success mt-2">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
