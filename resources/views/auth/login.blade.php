<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('includes.commons.style')
    @include('includes.commons.script')
    <title>Bulletin_Board_OJT</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="offset-3 col-md-6 bg-success mt-5 rounded-top text-white">
                <h3>Login</h3>
            </div>

            <div class="offset-3 col-md-6 border border-success">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-msg">
                        <i class="fa-solid fa-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="my-3 row">
                        <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="{{ old('email',$cachedEmail) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label text-end">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" value="{{ old('password',$cachedPassword) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <input type="checkbox" name="remember">Remember Me
                        <a href="" class="px-5 text-decoration-none">Forget Password?</a>
                    </div>
                    <div class="row">
                        <button class="btn btn-success col-10 offset-1" type="submit">Login</button>
                    </div>
                </form>
                <a href="{{ route('registerPage') }}" class="text-decoration-none  col-4 offset-2">Create an Account?<i
                        class="fa-solid fa-user-plus"></i></a>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap Js Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
