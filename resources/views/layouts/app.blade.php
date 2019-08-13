<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
    <title>BuildTools - @yield('title')</title>
    <link rel="canonical" href="{{ url(Request::url()) }}" />
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <style>
        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
        .help-block {
        color: #FF0000;
        }
    </style>
</head>
<body>
    @include('includes.header')

    <main role="main" class="container">
        @yield('content')
    </main>
    @include('includes.footer')
    @yield('foot')
</body>
</html>
