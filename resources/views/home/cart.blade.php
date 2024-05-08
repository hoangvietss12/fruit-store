@extends('layouts.home')

@section('title', 'Giỏ hàng Fruit-ya')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <a href="{{ route("store.index") }}">Shop</a>
                            <a href="{{ route("cart.index") }}">Giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="cart__search mt-3">
        <form action="{{ route('cart.search') }}" method="get" class="d-flex justify-content-center align-items-baseline">
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

    <!-- cart section -->
    <section class="shopping-cart spad">
        <div class="container">
        @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('message') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        @endif

            @if( $data->isEmpty() )
            <p style="font-size: 20px; text-align: center;">Không có sản phẩm nào</p>
            <div class="continue__btn">
                <a href="{{ route('store.index') }}">Mua sắm ngay!</a>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('purchase.order') }}" method="get">
                    @csrf
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <a href="{{ route('store.product', ['id' => $item->product->id]) }}">
                                                    <img style="width: 90px; height: 90px;"
                                                        src="{{ $item->product->images[0] }}" alt="{{ $item->product->name }}">
                                                </a>
                                            </div>
                                            <div class="product__cart__item__text">
                                                <a href="{{ route('store.product', ['id' => $item->product->id]) }}" class="d-inline">
                                                    <h6>{{ $item->product->name }}</h6>
                                                </a>
                                                @if($item->product->discount > 0)
                                                    <div class="d-block">
                                                        <h5 class="d-inline-block text-danger">{{ number_format($item->product->price - ($item->product->price * $item->product->discount)) }} <span>đ</span></h5>
                                                        <h6 class="d-inline-block" style="text-decoration: line-through;">{{ number_format($item->product->price) }} <span>đ</span></h6>
                                                    </div>
                                                @else
                                                    <div class="d-block">
                                                        <h5 class="text-danger">{{ number_format($item->product->price) }} <span>đ</span></h5>
                                                    </div>
                                                @endif
                                                <p style="font-size: 0.9rem;">Số lượng còn lại: {{ $item->product->quantity }} {{ $item->product->unit }}</p>
                                            </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2" id="pro-qty-{{ $index }}">
                                                <input type="text" value="{{ old('product_quantity', $item->quantity) }}" name="product_quantity[]" data-index="{{ $index }}">
                                                <span class="fw-bold">{{ $item->product->unit }}</span>
                                            </div>
                                            @error('product_quantity.*')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </td>
                                    @if($item->product->discount > 0)
                                        <td class="cart__price has_discount" data-price="{{ $item->price }}" data-discount="{{  $item->product->discount }}">{{ number_format(($item->price - ($item->price * $item->product->discount)) * $item->quantity) }} <span>đ</span>
                                    @else
                                        <td class="cart__price" data-price="{{ $item->price }}">{{ number_format($item->quantity*$item->price) }} <span>đ</span>
                                    @endif
                                    </td>
                                    <td class="cart__close"><a href="{{ route('cart.remove', ['id' => $item->product_id]) }}"><i class="fa fa-close"></a></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="continue__btn">
                                <a href="{{ route('store.index') }}">Đến cửa hàng!</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="order__btn">
                                <button type="submit">Mua hàng thôi!</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- end cart section -->
@stop
