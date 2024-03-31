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
                <h3 class="page-title"> Sửa sản phẩm </h3>
              </div>
              <div class="row">

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.update', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="product_name" name="name" placeholder="Tên sản phẩm..." value="{{$data->name}}">
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm:</label>
                                <select class="js-example-basic-single" name="category" style="width:100%">
                                    <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_unit">Đơn vị tính:</label>
                                <input type="text" class="form-control" id="product_unit" name="unit" placeholder="Đơn vị tính" value="{{$data->unit}}">
                            </div>
                            <div class="form-group">
                                <label for="product_quantity">Số lượng:</label>
                                <input type="text" class="form-control" id="product_quantity" name="quantity" placeholder="Số lượng" value="{{$data->quantity}}">
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá:</label>
                                <input type="text" class="form-control" id="product_price" name="price" placeholder="Giá" value="{{$data->price}}">
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Giảm giá:</label>
                                <input type="text" class="form-control" id="product_discount" name="discount" placeholder="Giảm giá" value="{{$data->discount}}">
                            </div>
                            <div class="form-group">
                                <label for="product_description">Mô tả sản phẩm:</label>
                                <textarea class="form-control" id="product_description" rows="4" name="description" placeholder="Mô tả về sản phẩm..." value="{{$data->description}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_images">Ảnh sản phẩm: </label>
                                <div class="input-group col-xs-12">
                                    <input type="file" name="images[]" id ="product_images" multiple="multiple">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                        </form>
                        <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
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
