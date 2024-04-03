<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons.css') }}">
    <script src="{{ asset('vendor/bootstrap.bundle.min.js') }}"></script>
</head>

<body>

    @auth('web')
        @include('layout.header')
    @endauth

    <div class="bg-light">
        @yield('content')
    </div>

    @auth('web')
        @include('layout.footer')
    @endauth

</body>

</html>
