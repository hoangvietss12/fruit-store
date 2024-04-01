<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fruit-ya Admin</title>

    {{-- style css --}}
    @include('admin.assets.css')

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
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
              <div class="page-header">
                <h3 class="page-title"> Thêm nhà cung cấp </h3>
              </div>
              <div class="row">

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{route('vendor.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên nhà cung cấp:</label>
                                <input type="text" class="form-control" name="vendor_name" placeholder="Tên nhà cung cấp...">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="vendor_email" placeholder="Email...">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input type="text" class="form-control" name="vendor_phone" placeholder="Số điện thoại...">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input type="text" class="form-control" name="vendor_address" placeholder="Địa chỉ...">
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Thêm</button>
                        </form>
                        <a class="btn btn-primary mt-3" href="{{ route('vendor.index') }}">Quay lại</a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('admin.components.footer')
            <!-- partial -->
          </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- js --}}
    @include('admin.assets.js')

  </body>
</html>
