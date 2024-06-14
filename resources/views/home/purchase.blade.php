@extends('layouts.home')

@section('title', 'Mua hàng Fruit-ya')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Mua hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <a href="{{ route("store.index") }}">Shop</a>
                            <span>Mua hàng</span>
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
            @if(session('message') == "Bạn phải hủy đặt hàng trước đã!" || session('message') == "Giao dịch đã bị hủy!")
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('message') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @elseif(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif

            @if($order_status)
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    Đơn hàng đang được vận chuyển

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
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
                <div class="col-lg-8">
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
                                        <a href="{{ route('store.product', ['id' => $item->product_id]) }}">
                                            <div class="product__cart__item__pic">
                                                <img style="width: 90px; height: 90px;"
                                                    src="{{ $item->product->images[0] }}" alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item->product->name }}</h6>
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
                                            </div>
                                        </a>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2 text-center">
                                                <span>{{ $item->quantity }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    @if($item->product->discount > 0)
                                        <td class="cart__price has_discount" data-price="{{ $item->price }}" data-discount="{{  $item->product->discount }}">{{ number_format(($item->price - ($item->price * $item->product->discount)) * $item->quantity) }} <span>đ</span>
                                    @else
                                        <td class="cart__price" data-price="{{ $item->price }}">{{ number_format($item->quantity*$item->price) }} <span>đ</span>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    @if(!$check_order)
                    <div class="cart__discount">
                        <div class="payment-select-1">
                            <h6>Lựa chọn phương thức đặt hàng</h6>
                            <form id="order-form" action="{{ route('purchase.submit') }}" method="post">
                                @csrf
                                <select class="js-example-basic-single" name="order_type" style="width:100%">
                                    <option value="" disabled>Chọn phương thức</option>
                                    <option value="Đến lấy hàng" selected>Đến lấy hàng</option>
                                    <option value="Ship tận nơi">Ship tận nơi</option>
                                </select>
                                <button class="btn-type-order">Áp dụng</button>
                            </form>
                        </div>

                        <div class="payment-select-2">
                            <h6>Lựa chọn phương thức thanh toán</h6>
                            <form id="payment-form" action="{{ route('payment.index') }}" method="post">
                                @csrf
                                <select class="js-example-basic-single" name="bank_code" style="width:100%">
                                    <option value="" disabled>Chọn phương thức</option>
                                    <option value="NCB" selected>NCB</option>
                                    <option value="VISA">VISA</option>
                                    <option value="MasterCard">MasterCard</option>
                                    <option value="JCB">JCB</option>
                                    <option value="EXIMBANK">EXIMBANK</option>
                                </select>
                                <div class="cart__total mt-5">
                                    <h6>Tổng đơn hàng</h6>
                                        <ul>
                                            <li>Tổng cộng <span>{{ number_format($total_price) }}đ</span></li>
                                            <li>Thanh toán <span>{{ number_format($total_price) }}đ</span></li>
                                        </ul>
                                        <button type="submit" name="redirect" class="secondary-btn" id="btn-submit-payment">Thanh toán</button>
                                        <div class="continue__btn mt-3">
                                            <a href="{{ route('purchase.index') }}" class="w-100 text-center">Quay lại</a>
                                        </div>
                                    </div>
                            </form>
                        </div>

                    </div>
                    <div class="cart__total" id="cart">
                        <h6>Tổng đơn hàng</h6>
                        <ul>
                            <li>Tổng cộng <span>{{ number_format($total_price) }}đ</span></li>
                            <li class="cart__fee">
                                Phí vận chuyển
                                <span>15,000đ</span>
                            </li>
                            <li>Thanh toán <span>{{ number_format($total_price) }}đ</span></li>
                        </ul>
                        <button type="submit" class="primary-btn" id="btn-submit-order">Đặt Hàng</button>
                        <button id="btn-check-payment" class="secondary-btn mt-3">Thanh toán với VN Pay</button>
                    </div>
                    @else
                    <div class="cart__total">
                        <h6>Tổng đơn hàng</h6>
                        <ul>
                            <li>Tổng cộng <span>{{ number_format($total_price) }}đ</span></li>
                            @if($check_order_type === true)
                            <li class="">
                                Phí vận chuyển
                                <span>15,000đ</span>
                            </li>
                            <li>Thanh toán <span>{{ number_format($total_price + 15000) }}đ</span></li>
                            @else
                            <li>Thanh toán <span>{{ number_format($total_price) }}đ</span></li>
                            @endif
                        </ul>
                        <a href="{{ route('purchase.cancel') }}" class="btn-cancel-order">Hủy đặt hàng</a>
                    </div>
                    @endif
                    <div class="continue__btn mt-3">
                        <a href="{{ route('cart.index') }}" class="w-100 text-center">Quay lại</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- end cart section -->
@stop
