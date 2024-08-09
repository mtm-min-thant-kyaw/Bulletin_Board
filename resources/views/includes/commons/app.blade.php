<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('includes.commons.style')
</head>

<body>
    @include('includes.commons.header')
    <div class="container">
        @yield('content')
    </div>
    @include('includes.commons.footer')
</body>
@include('includes.commons.script')

</html>
