</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Bulletin Board OJT</title>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="offset-3 col-6 rounded-top bg-success">
                <h3 class="text-white">Sign Up</h3>
            </div>
            <div class="offset-3 col-6  border border-success ">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3 row">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @error('email')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password_confirmation">
                            @error('password_confirmation')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                        </div>
                    </div>
                    <input type="text" name="type" value="1" hidden>
                    <div class="mb-3 row">
                        <label for="dob" class="col-sm-4 col-form-label">Date of Birth</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Profile</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="profile">
                            @error('profile')
                                <small class="alert text-danger">{{ $message }}</small><br>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <button type="submit" class="btn btn-success offset-4 col-2">Register</button>
                        <button type="reset" class="btn btn-primary col-2 ms-2">Clear</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</body>
<!-- Bootstrap Js Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
