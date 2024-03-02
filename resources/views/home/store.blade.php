<!DOCTYPE html>
<html>

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

  <title>Fruit-ya</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />

  <!-- responsive style -->
  <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

</head>

<body>

  <!-- header section strats -->
    @include('home.components.header')
  <!-- end header section -->

  <!-- product section -->
  <section class="product_section layout_padding2-top layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Trái cây của chúng tôi
        </h2>
        <p>
            Sức khỏe và hạnh phúc bắt đầu từ những quả trái cây tươi ngon - Chọn mua trái cây của chúng tôi để mang lại sức khỏe cho bạn.
        </p>
      </div>

      <div class="product_filter">
        <div class="product_options">
            <div class="product_options-categories">
                <label for="category">Danh mục sản phẩm:</label>
                <select name="category" id="category" class="form-control">
                    <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
      </div>

      <div class="row" id="product-container">

        @foreach($data as $product)
            <div class="col-sm-6 col-lg-4 product-item">
                <div class="box">
                <div class="img-box">
                    <img src="{{$product->images[0]}}" alt="{{$product->name}}">
                </div>
                <div class="detail-box">
                    <span class="rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </span>
                    <a href="">
                        {{$product->name}}
                    </a>
                    <div class="price_box">
                    <h6 class="price_heading">
                        {{number_format($product->price)}} <span>đ</span>
                    </h6>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

      </div>
      {{ $data->links('components.pagination') }}
    </div>
  </section>

  <!-- end product section -->

  <!-- end info section -->

  <!-- footer section -->
  @include('home.components.footer')
  <!-- end footer section -->

  <!-- copyright section -->
  @include('home.components.copyright')
  <!-- copyright section -->

  <!-- jQery -->
  <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('home/js/bootstrap.js') }}"></script>
  <!-- custom js -->
  <script src="{{ asset('home/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>
