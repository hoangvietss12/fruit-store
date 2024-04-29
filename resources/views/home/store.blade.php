@extends('layouts.home')

@section('title', 'Cửa hàng Fruit-ya')

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
                        <h4>Cửa hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <a href="{{ route("store.index") }}">Shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="store__search mt-3">
        <form action="{{ route('store.search') }}" method="get" class="d-flex justify-content-center align-items-baseline">
            @csrf
            <div class="form-group" style="width: 30%;">
                <input type="text" class="form-control" name="product_name" placeholder="Nhập tên sản phẩm...">
            </div>
            <button class="btn btn-primary" style="border-radius: unset;">
                <i class="fa fa-search" aria-hidden="true"></i>
                Tìm kiếm
            </button>
        </form>
    </section>

    <!-- product section -->
    <section class="product_section layout_padding2-top layout_padding-bottom">
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

            <div class="form-container mt-5">
                <form id="filter-form" action="{{route('store.filter')}}" method="get" class="d-flex justify-content-between flex-row flex-wrap">
                    @csrf
                    <div class="form-group form-search-category">
                        <label>Danh mục sản phẩm:</label>
                        <select class="js-example-basic-single" name="product_category" style="width:100%">
                            <option value="" selected>Chọn danh mục sản phẩm</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-search-price">
                        <label>Đơn giá:</label>
                        <select class="js-example-basic-single" name="product_price" style="width:100%">
                            <option value="" selected>Chọn khoảng giá</option>
                            @foreach($range_price as $price)
                                    @if($price == '1000001-')
                                        <option value="{{$price}}">
                                            > {{ number_format((float) explode('-', $price)[0]) }}đ
                                        </option>
                                    @else
                                        <option value="{{$price}}">
                                            {{ number_format((float) explode('-', $price)[0]) }}đ - {{ number_format((float) explode('-', $price)[1]) }}đ
                                        </option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-search-discount">
                        <label>Giảm giá:</label>
                        <select class="js-example-basic-single" name="product_discount" style="width:100%">
                            <option value="true"> Có </option>
                            <option value="false" selected> Không </option>
                        </select>
                    </div>
                    <div class="form-group form-search-sort">
                        <label>Giá:</label>
                        <select class="js-example-basic-single" name="product_price_sort" style="width:100%">
                            <option value="asc" selected> Tăng dần </option>
                            <option value="desc"> Giảm dần </option>
                        </select>
                    </div>
                </form>
                <button class="btn btn-primary mr-2 d-block text-center" id="btn-product-filter">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    Lọc sản phẩm
                </button>
            </div>

            @if( $data->isEmpty() )
                <p style="font-size: 20px;" class="mt-5 text-center">Không có sản phẩm nào</p>
            @else
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
            @endif

            @if( $data->total() > 8 )
            {{ $data->links('components.pagination') }}
            @endif

        </div>
    </section>
    <!-- end product section -->
@stop
