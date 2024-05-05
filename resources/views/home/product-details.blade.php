@extends('layouts.home')

@section('title', $title)

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Liên hệ</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <a href="{{ route("store.index") }}">Shop</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

      <!-- contact section -->
  <section class="contact_section layout_padding2-top layout_padding-bottom">
    <div class="container">

        <section class="product-section1">
            <div class="row">
                <div class="product-detail-left product-images col-xs-12 col-sm-12 col-md-8 mx-auto col-lg-5 ">
                @if(count($product->images) > 1)
                    <!-- Carousel wrapper -->
                    <div id="carouselExampleIndicators" data-mdb-carousel-init class="carousel slide carousel-fade" data-mdb-ride="carousel">
                        <!-- Slides -->
                        <div class="carousel-inner mb-5">
                            @foreach($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 1 ? 'active' : ''}}">
                                <img src="{{ $image }}" class="d-block w-100" alt="{{ $title }} ({{$index+1}})" />
                            </div>
                            @endforeach
                        </div>
                        <!-- Slides -->

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
                            data-mdb-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
                            data-mdb-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <!-- Controls -->

                        <!-- Thumbnails -->
                        <div class="carousel-indicators" style="margin-bottom: -20px;">
                            @foreach($product->images as $index => $image)
                                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="{{$index}}"
                                class="{{ $index === 1 ? 'active' : ''}}"
                                aria-current="true" aria-label="Slide {{$index+1}}" style="width: 100px;">
                                    <img class="d-block w-100"
                                        src="{{ $image }}" class="img-fluid" />
                                </button>
                            @endforeach
                        </div>
                        <!-- Thumbnails -->
                    </div>
                    <!-- Carousel wrapper -->
                @else
                    <img src="{{ $product->images[0] }}" class="d-block w-100" alt="{{ $title }}" />
                @endif
				</div>
                <div class="product-details col-xs-12 col-sm-12 col-lg-7">
                    <form action="{{ route('cart.store', ['id' => $product->id]) }}" method="get">
                        @csrf
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <h6 class="product-category my-3"><span class="fw-bold">Danh mục:</span> {{ $product->category->name }}</h6>

                        @if($product->status === "Còn hàng")
                            <div class="price-box w-75">
                                @if($product->discount > 0.0)
                                    <h4 class="product-price text-danger">{{number_format($product->price - ($product->price * $product->discount))}}<span>đ</span></h4>
                                    <h6 class="product-price d-inline-block">{{number_format($product->price)}}đ</h6> <h6 class="d-inline-block">(-{{ $product->discount*100 }}%)</h6>
                                @else
                                    <h4 class="product-price text-danger">{{number_format($product->price)}}<span>đ</span></h4>
                                @endif
                            </div>
                            <h6 class="product-quantity my-3"><span class="fw-bold">Số lượng còn lại:</span> {{ $product->quantity }}{{ $product->unit }}</h6>
                            <div class="form-group">
                                <label for="" class="fw-bold">Số lượng:</label>
                                <div class="product-input">
                                    <button class="btn-minus">-</button>
                                    <input type="text" value="1" name="product_quantity" data-max="{{ $product->quantity }}">
                                    <button class="btn-plus">+</button>
                                </div>
                            </div>
                            <button class="btn btn-add-cart" type="submit">Thêm vào giỏ</button>
                        @else
                            <div class="price-box w-75">
                                <h4 class="product-price text-danger">
                                    Tạm hết hàng
                                </h4>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </section>

        <section class="product-section2">
            <h3>Mô tả sản phẩm</h3>
            <div class="product-quantity mt-3">
                {{ $product->description }}
            </div>
        </section>


        <section class="product-section3 product_section mt-4">
            <h3 class="text-center">Các sản phẩm khác</h3>
            <div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
            <div class="carousel-inner w-100">
                @foreach($random_products as $index => $item)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} item-{{$index}}">
                    <div class="box mt-0">
                        <div class="img-box">
                            @if($item->discount > 0)
                                <span class="sale-label">Sale {{ $item->discount*100 }}%</span>
                            @endif
                            <img src="{{$item->images[0]}}" alt="{{$item->name}}">

                            @if($product->status === "Còn hàng")
                                <div class="product-overlay">
                                    <a class="add-to-cart-button" href="{{ route('cart.store', ['id' => $product->id]) }}">+ Thêm</a>
                                </div>
                            @endif
                        </div>
                        <div class="detail-box">
                            <span class="rating">
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <a href="{{ route('store.product', ['id' => $item->id]) }}">
                                {{$item->name}}
                            </a>
                            <div class="price_box">
                                @if($item->status === "Còn hàng")
                                    @if($item->discount > 0)
                                        <p class="price">
                                            {{number_format($item->price - ($item->price * $item->discount))}} <span>đ</span>
                                        </p>
                                        <p class="price price_old">
                                            {{number_format($item->price)}} <span>đ</span>
                                        </p>
                                    @else
                                        <p class="price">
                                            {{number_format($item->price)}} <span>đ</span>
                                        </p>
                                    @endif
                                @else
                                    <p class="price price_out">
                                        Tạm hết hàng
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    </div>
  </section>
  <!-- end contact section -->
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

<script>
    var maxQuantity = "{{ $product->quantity }}"
    // handle carousel
    $('#myCarousel.carousel .carousel-item').each(function () {
        var minPerSlide = 4;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) {
            next=next.next();
            if (!next.length) {
                next=$(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });
</script>
@stop
