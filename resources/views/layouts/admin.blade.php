
<!DOCTYPE html>
<html lang="vn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fruit-ya Admin</title>
    <!-- plugins:css -->
    @include('admin.assets.css')

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.components.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.components.navbar')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">

            @yield('content')

                <footer class="footer_section mt-5 text-center">
                    <div class="container">
                        <p>
                            &copy; <span id="displayYear"></span> All Rights Reserved By
                            <a href="{{ route('admin.index') }}">Fruit-ya 2024</a>
                        </p>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.assets.js')

    @yield('script')
  </body>
</html>
