@extends('layouts.home')

@section('title', 'Lịch sử mua hàng')

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
                        <h4>Lịch sử mua hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <span>Lịch sử mua hàng</span>
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

            @if( $orders->isEmpty() )
            <p style="font-size: 20px; text-align: center;">Không lịch sử mua hàng</p>
            <div class="continue__btn">
                <a href="{{ route('store.index') }}">Mua sắm ngay!</a>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <ul>
                        @foreach($orders as $order)
                            <li class="pt-3 border-bottom">
                                <strong>Ngày đặt hàng:</strong> {{ date("d-m-Y", strtotime($order->created_at)) }}<br>
                                <strong>Phương thức đặt hàng:</strong> {{ $order->order_type }}<br>
                                <strong>Chi tiết đơn hàng:</strong><br>
                                <ul>
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
                                                @foreach($order->order_details as $item)
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
                                                                <div class="d-block">
                                                                    <h5 class="text-danger">{{ number_format($item->price) }} <span>đ</span></h5>
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td class="quantity__item">
                                                        <div class="quantity">
                                                            <div class="pro-qty-2 text-center">
                                                                <span>{{ $item->quantity }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__price">{{ number_format($item->quantity*$item->price) }} <span>đ</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- end cart section -->
@stop
