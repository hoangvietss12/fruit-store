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

            @if( !isset($group_orders) )
            <p style="font-size: 20px; text-align: center;">Không lịch sử mua hàng</p>
            <div class="continue__btn">
                <a href="{{ route('store.index') }}">Mua sắm ngay!</a>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <ul>
                        @php
                            $group_order_keys = array_keys($group_orders);
                            $check_date = $group_order_keys[0];
                        @endphp
                        @foreach($group_orders as $date=>$order)
                            <li class="pt-3 border-bottom">
                                @php
                                    if($check_date !== substr($date, 0, 10)) {
                                        $check_date = substr($date, 0, 10);
                                        echo '<h4 class="text-center my-3 fw-bold">Ngày '.date("d-m-Y", strtotime(substr($date, 0, 10))).'</h4>';
                                    }
                                @endphp
                                <strong>Thời gian đặt hàng:</strong> {{ date("H:i:s", strtotime($date)) }}<br>
                                <strong>Phương thức đặt hàng:</strong> {{ $order['order_type'] }}<br>
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
                                                @foreach($order['order_details'] as $item)
                                                <tr>
                                                    <td class="product__cart__item">
                                                            <div class="product__cart__item__pic">
                                                                <a href="{{ route('store.product', ['id' => $item['product_id']]) }}">
                                                                    <img style="width: 90px; height: 90px;"
                                                                        src="{{ $item['product_images'][0] }}" alt="{{ $item['product_name'] }}">
                                                                </a>
                                                            </div>
                                                            <div class="product__cart__item__text">
                                                                <a href="{{ route('store.product', ['id' => $item['product_id']]) }}" class="d-inline">
                                                                    <h6>{{ $item['product_name'] }}</h6>
                                                                </a>
                                                                <div class="d-block">
                                                                    <h5 class="text-danger">{{ number_format($item['order_detail_price']) }} <span>đ</span></h5>
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td class="quantity__item">
                                                        <div class="quantity">
                                                            <div class="pro-qty-2 text-center">
                                                                <span>{{ $item['order_detail_quantity'] }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__price">{{ number_format($item['order_detail_total_price']) }} <span>đ</span></td>
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
