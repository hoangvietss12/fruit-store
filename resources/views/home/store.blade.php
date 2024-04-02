@extends('layouts.home')

@section('title', 'Cửa hàng Fruit-ya')

@section('content')
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

            <div class="product_filter">
                <div class="product_options">
                    <div class="product_options-categories">
                        <label for="category">Danh mục sản phẩm:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <a href=""><img src="{{$product->images[0]}}" alt="{{$product->name}}"></a>
                            <div class="product-overlay">
                                <button class="add-to-cart-button">+ Thêm</button>
                            </div>
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

            @if( $data->total() > 8 )
            {{ $data->links('components.pagination') }}
            @endif

        </div>
    </section>
    <!-- end product section -->
@stop
