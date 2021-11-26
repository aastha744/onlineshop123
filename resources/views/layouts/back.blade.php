<!doctype html>
<html lang="en">
<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Online Shop</title>
    <link rel="stylesheet" href="{{ url('public/css/back.css') }}">
</head>
<body>
    <div class="container-fluid">
        @yield('nav')

        @yield('content')

    </div>

    @include('back.templates.messages')

    <script src="{{ url('public/js/back.js') }}"></script>
</body>
</html>
