<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AdminLTE') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    @if (app()->environment('local'))
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif

</head>
<body class="hold-transition sidebar-mini dark sidebar-collapse">

<!-- wrapper -->
<div class="wrapper" id="app">
    <!-- Navbar -->
    @include('layouts.partials.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')
    <!-- /.Main Sidebar Container -->

    @yield('content')

    <!-- Control Sidebar -->
    @include('layouts.partials.controlbar')
    <!-- /.control-sidebar -->

    <!-- Admin Footer -->
    @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->

<!-- Scripts -->
@if (app()->environment('local'))
    <script src="{{ mix('js/app.js') }}"></script>
@else
    <script src="{{ asset('js/app.js') }}" defer></script>
@endif
</body>

</html>
