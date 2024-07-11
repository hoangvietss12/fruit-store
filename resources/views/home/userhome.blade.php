@extends('layouts.home')

@section('title', 'Trang chủ Fruit-ya')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
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
                            <img src="{{$product->images}}" alt="{{$product->name}}">

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
                            <a href="{{ route('store.product', ['id' => $product->id]) }}">
                                {{$product->name}}
                            </a>
                            <div class="price_box">
                                @if($product->status === "Còn hàng")
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
                    Tin mới
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('images/b1.jpg') }}" alt="">
                            <h4 class="blog_date">
                                29 <br>
                                Tháng 4
                            </h4>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fruit-ya ra mắt chương trình khuyến mãi mùa hè: Mua nhiều giá hời
                            </h5>
                            <p class="mt-3">
                                Fruit-ya vừa công bố chương trình khuyến mãi hấp dẫn cho mùa hè này, khi mua bất kỳ sản phẩm nào tại cửa hàng, khách hàng sẽ được giảm giá ngay một sản phẩm khác cùng loại.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('images/b2.jpg') }}" alt="">
                            <h4 class="blog_date">
                                28 <br>
                                Tháng 4
                            </h4>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fruit-ya mở rộng dịch vụ giao hàng tận nơi trong khu vực Hà Nội
                            </h5>
                            <p class="mt-3">
                                Fruit-ya vừa công bố việc mở rộng dịch vụ giao hàng tận nơi đến khách hàng trong khu vực Hà Nội, giúp họ có thể dễ dàng tiếp cận với các loại trái cây tươi ngon ngay tại nhà.
                            </p>
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

        function actionUrl(id) {
            return "{{ route('cart.index') }}" + "/" + id;
        }

        function detailUrl(id) {
            return "{{ route('store.index') }}" + "/" + id;
        }

        function displayMoreProducts(products) {
            var productContainer = document.getElementById('product-container');
            if (productContainer) {
                products.forEach(function(product) {
                    var productHtml = `
                    <div class="col-sm-6 col-lg-4 product-item">
                        <div class="box">
                            <div class="img-box">
                                ${product.discount > 0 ? '<span class="sale-label">Sale '+ (product.discount*100) +' %</span>' : ''}
                                <img src="${product.images}" alt="${product.name}">
                                ${product.status === "Còn hàng" ?
                                    `
                                    <div class="product-overlay">
                                        <a class="add-to-cart-button" href="${actionUrl(product.id)}">+ Thêm</a>
                                    </div>
                                    ` :
                                    ''
                                }
                            </div>
                            <div class="detail-box">
                                <span class="rating">
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </span>
                                <a href="${ detailUrl(product.id) }">
                                    ${product.name}
                                </a>
                                <div class="price_box">
                                ${product.status === "Còn hàng" ?
                                    (product.discount > 0 ?
                                        `
                                        <p class="price">
                                            ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price - product.price * product.discount)}
                                        </p>
                                        <p class="price price_old">
                                            ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
                                        </p>
                                        ` :
                                        `
                                        <p class="price">
                                            ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
                                        </p>
                                        `
                                    ) :
                                    `
                                    <p class="price price_out">
                                        Tạm hết hàng
                                    </p>
                                    `
                                }

                                </div>
                            </div>
                        </div>
                    </div>`;
                    productContainer.innerHTML += productHtml;
                });
            }
        }

    </script>
@stop
