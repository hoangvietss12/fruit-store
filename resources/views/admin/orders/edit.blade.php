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
                <h3 class="page-title"> Đơn hàng #{{ $data->id }} </h3>
              </div>
              <div class="row">

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{route('order.update', ['id' => $data->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Sửa trạng thái:</label>
                                <select class="js-example-basic-single" name="order_type" style="width:100%">
                                    <option value="Đã xác nhận">Đã xác nhận</option>
                                    <option value="Chờ xác nhận">Chờ xác nhận</option>
                                </select>
                              </div>
                            <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                        </form>
                        <a class="btn btn-primary mt-3" href="{{ route('order.index') }}">Quay lại</a>
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
