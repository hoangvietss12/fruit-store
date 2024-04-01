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
                    <h2 class="page-title">{{ $product->name }}</h2>
                </div>

                <div class="page-content">
                    <p>Danh mục sản phẩm: <span>{{ $product->category->name }}</span></p>
                    <p>Nhà cung cấp: <span>{{ $product->vendor->name }}</span></p>
                    <p>Số lượng: <span>{{ $product->quantity }}{{ $product->unit }}</span></p>
                    <p>Đơn giá: <span>{{ number_format($product->price) }}đ</span></p>
                    <p>Giảm giá: <span>{{ $product->discount }}</span></p>
                    <p>Trạng thái: <span>{{ $product->status }}</span></p>
                    <p>Ảnh sản phẩm:</p>
                    <div class="page-images">
                        @foreach($product->images as $imageUrl)
                            <img src={{$imageUrl}} alt="{{ $product->name }}">
                        @endforeach
                    </div>
                    <p>Mô tả sản phẩm:</p>
                    <p><span>{{ $product->description }}</span></p>
                </div>

                <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
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
