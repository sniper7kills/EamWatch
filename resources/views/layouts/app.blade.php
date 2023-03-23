<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7269331059057339"
     crossorigin="anonymous"></script>

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
<body class="hold-transition sidebar-mini dark sidebar-collapse layout-fixed">

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
<!-- Matomo -->
<script>
    var _paq = window._paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(["setCookieDomain", "*.www.eam.watch"]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u="https://tracking.sniper7kills.com/";
      _paq.push(['setTrackerUrl', u+'matomo.php']);
      _paq.push(['setSiteId', '3']);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><p><img src="https://tracking.sniper7kills.com/matomo.php?idsite=3&amp;rec=1" style="border:0;" alt="" /></p></noscript>
  <!-- End Matomo Code -->
</body>

</html>
