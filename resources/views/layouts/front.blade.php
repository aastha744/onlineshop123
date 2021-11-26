<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Online Shop</title>

        <link rel="stylesheet" href="{{ url('public/css/front.css') }}">
    </head>
    <body>
        <div class="container-fluid">

            <div class="row min-vh-100">

                @include('front.templates.header')

                @yield('content')

                @include('front.templates.footer')
            </div>

        </div>
                @include('front.templates.messages')

        <script type="text/javascript" src="{{ url('public/js/front.js') }}"></script>
    </body>
</html>
