<!DOCTYPE html>
<html lang="vn">
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
                    <h2 class="page-title">Thông tin tài khoản <h2>
                </div>

                <div class="page-content">
                    <p>Tên tài khoản: <span>{{ $data->name }}</span></p>
                    <p>Email: <span>{{ $data->email }}</span></p>
                    <p>Số điện thoại: <span>{{ $data->phone }}</span></p>
                    <p>Địa chỉ: <span>{{ $data->address }}</span></p>
                    <p>Trạng thái: <span>{{ $data->status }}</span></p>
                    <p>Ảnh đại diện:</p>
                    <div class="page-images">
                        <img src="{{$data->profile_photo_path}}" alt="{{ $data->name }}">
                    </div>
                </div>

                <a class="btn btn-primary mt-3" href="{{ route('account.index') }}">Quay lại</a>
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
