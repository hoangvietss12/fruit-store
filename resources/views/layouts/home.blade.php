<!DOCTYPE html>
<html lang="vn">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title')</title>

  @include('home.assets.css')
</head>

<body>

  <!-- header section start -->
    @include('home.components.header')
  <!-- end header section -->

    @yield('content')

  <!-- footer section -->
  @include('home.components.footer')
  <!-- end footer section -->

  <!-- copyright section -->
  @include('home.components.copyright')
  <!-- copyright section -->

  @include('home.assets.js')

  @yield('script')
</body>

</html>
