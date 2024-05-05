@extends('layouts.home')

@section('title', 'Liên hệ - Fruit-ya')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endifF

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Liên hệ</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <span>Liên hệ</span>
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
      <div class="heading_container heading_center">
        <h2>Liên hệ với chúng tôi</h2>
      </div>

      <div class="contact_info">
        <p>Địa chỉ: 9A28 Hoàng Quốc Việt, Nghĩa Tân, Cầu Giấy, Hà Nội, Việt Nam</p>
        <p>Số điện thoại: +84 375283992</p>
        <p>Email: fruit.ya111@gmail.com</p>
        <p>Ngoài ra, quý khách hàng cũng có thể kết nối với chúng tôi thông qua các mạng xã hội sau:</p>
        <ul class="contact_list">
            <li>Facebook: <a href="" class="contact-link">Fruit-ya</a></li>
            <li>Instagram: <a href="" class="contact-link">@fruitya_official</a></li>
            <li>Twitter: <a href="" class="contact-link">@fruitya_tweets</a></li>
        </ul>
        <p>Chúng tôi rất vui lòng được phục vụ và đồng hành cùng bạn qua mọi kênh liên hệ. Đừng ngần ngại liên hệ với chúng tôi nếu có bất kỳ thắc mắc hoặc yêu cầu nào.</p>
      </div>
    </div>
  </section>
  <!-- end contact section -->
@stop
