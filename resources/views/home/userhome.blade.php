@extends('layouts.home')

@section('title', 'Trang chủ Fruit-ya')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <!-- slider section -->
    @include('home.components.slider')
    <!-- end slider section -->

    <!-- offer section -->
    @include('home.components.offer')
    <!-- end offer section -->

    <!-- product section -->
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Trái cây của chúng tôi
                </h2>
                <p>
                    Sức khỏe và hạnh phúc bắt đầu từ những quả trái cây tươi ngon - Chọn mua trái cây của chúng tôi để mang
                    lại sức khỏe cho bạn.
                </p>
            </div>
            <div class="row" id="product-container">

                @foreach($data as $product)
                <div class="col-sm-6 col-lg-4 product-item">
                    <div class="box">
                        <div class="img-box">
                            @if($product->discount > 0)
                                <span class="sale-label">Sale {{ $product->discount*100 }}%</span>
                            @endif
                            <a href=""><img src="{{$product->images[0]}}" alt="{{$product->name}}"></a>
                            <div class="product-overlay">
                                <form action="{{ route('cart.store', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button class="add-to-cart-button">+ Thêm</button>
                                </form>
                            </div>
                        </div>
                        <div class="detail-box">
                            <span class="rating">
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <a href="">
                                {{$product->name}}
                            </a>
                            <div class="price_box">
                                @if($product->discount > 0)
                                    <p class="price">
                                        {{number_format($product->price - ($product->price * $product->discount))}} <span>đ</span>
                                    </p>
                                    <p class="price price_old">
                                        {{number_format($product->price)}} <span>đ</span>
                                    </p>
                                @else
                                    <p class="price">
                                        {{number_format($product->price)}} <span>đ</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="btn-box">
                <a id="load-more-btn">Xem thêm</a>
            </div>
        </div>
    </section>

    <!-- end product section -->

    <!-- about section -->
    @include('home.components.about')
    <!-- end about section -->

    <!-- blog section -->
    <section class="blog_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Blog mới nhất
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/b1.jpg" alt="">
                            <h4 class="blog_date">
                                29 <br>
                                June
                            </h4>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Look even slightly believable. If you are
                            </h5>
                            <p>
                                alteration in some form, by injected humour, or randomised words which don't look even
                                slightly believable.
                            </p>
                            <a href="">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/b2.jpg" alt="">
                            <h4 class="blog_date">
                                28 <br>
                                June
                            </h4>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Anything embarrassing hidden in the middle
                            </h5>
                            <p>
                                alteration in some form, by injected humour, or randomised words which don't look even
                                slightly believable.
                            </p>
                            <a href="">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog section -->

    <!-- client section -->
    @include('home.components.testimonials')
    <!-- end client section -->
@stop

@section('script')
    <script>
        var loadMoreProductsUrl = "{{ route('load.more.products') }}";
    </script>
@stop
