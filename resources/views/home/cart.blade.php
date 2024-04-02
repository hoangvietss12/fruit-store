@extends('layouts.home')

@section('title', 'Cửa hàng Fruit-ya')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <a href="{{ route("home.store") }}">Shop</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- cart section -->
    <section class="shopping-cart spad">
        <div class="container">
            @if( $data->isEmpty() )
            <p style="font-size: 20px; text-align: center;">Không có sản phẩm nào</p>
            <div class="continue__btn">
                <a href="{{ route('home.store') }}">Mua sắm ngay!</a>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
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
                                @foreach($data as $item)
                                <tr>
                                    <td class="product__cart__item">
                                        <a href="">
                                            <div class="product__cart__item__pic">
                                                <img style="width: 90px; height: 90px;"
                                                    src="{{ $item->product->images[0] }}" alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item->product->name }}</h6>
                                                <h5>{{ number_format($item->price) }} <span>đ</span></h5>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="{{ $item->quantity }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ number_format($item->quantity*$item->price) }} <span>đ</span>
                                    </td>
                                    <td class="cart__close"><a href=""><i class="fa fa-close"></a></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="continue__btn">
                                <a href="{{ route('home.store') }}">Đến cửa hàng!</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="order__btn">
                                <a href="{{ route('purchase.index') }}">Mua hàng thôi!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- end cart section -->
@stop
