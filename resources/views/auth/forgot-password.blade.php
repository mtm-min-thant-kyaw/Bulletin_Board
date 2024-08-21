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
            <h3 class="">Forgot Password?</h3>
        </div>
        <div class="col-6 offset-3 border border-success p-3">
            @if (session('success'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-msg">
                        <i class="fa-solid fa-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-msg">
                        <i class="fa-solid fa-check"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <label for="">Email</label>
                <input type="email" name="email" value="" class="form-control"
                    placeholder="Enter your email to reset your password">
                @error('email')
                    <small class="alert text-danger">{{ $message }}</small><br>
                @enderror
                <button type="submit" class="btn btn-success mt-2">Reset Password</button>
            </form>
        </div>

    </div>
</body>

</html>
