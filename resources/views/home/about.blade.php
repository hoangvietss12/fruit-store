@extends('layouts.home')

@section('title', 'Giới thiệu - Fruit-ya')

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
                        <h4>Giới thiệu</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route("home.index") }}">Trang chủ</a>
                            <span>Giới thiệu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="about_section layout_padding">
        <div class="container">
            <div class="about_header">
                <h2 class="text-center fw-bold">Giới thiệu về Cửa hàng trái cây Fruit-ya</h2>
                <p class="my-3">Fruit-ya là một cửa hàng chuyên kinh doanh các loại trái cây tươi ngon và đa dạng, mang lại sự tươi mới và dinh dưỡng cho khách hàng. Với sứ mệnh cung cấp những sản phẩm chất lượng cao và dịch vụ tận tâm, Fruit-ya đã nhanh chóng trở thành điểm đến ưa thích của những người yêu thích ẩm thực và quan tâm đến sức khỏe.</p>
            </div>
            <div class="row">
                <div class="about_section mt-5 d-flex align-items-center">
                    <div class="col-md-6 ">
                        <div class="img-box">
                            <img src="{{ asset('images/about-1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h5 class="fw-bold">Sản Phẩm và Dịch Vụ:</h5>
                            </div>
                            <p>Fruit-ya tự hào là địa chỉ lý tưởng cho những ai đang tìm kiếm các loại trái cây tươi ngon và đa dạng. Cửa hàng cung cấp một loạt các loại trái cây từ khắp nơi trên thế giới, đảm bảo về chất lượng và nguồn gốc. Từ những quả chuối mát lạnh đến các loại berry tươi ngon, từ trái cây quen thuộc như táo, cam, bưởi đến những loại exotic như măng cụt, kiwi và dừa, Fruit-ya luôn đảm bảo sự đa dạng và tươi mới trong sản phẩm của mình.</p>
                            <p>Ngoài ra, Fruit-ya cũng cung cấp các dịch vụ tư vấn chuyên nghiệp về dinh dưỡng và cách chọn lựa trái cây phù hợp với nhu cầu của từng khách hàng. Đội ngũ nhân viên am hiểu về các loại trái cây và có kinh nghiệm trong lĩnh vực dinh dưỡng sẵn sàng tư vấn và hỗ trợ khách hàng một cách tận tình và chu đáo.</p>
                        </div>
                    </div>
                </div>
                <div class="about_section mt-5 d-flex align-items-center">
                    <div class="col-md-6 ">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h5 class="fw-bold">Mục Tiêu và Cam Kết::</h5>
                            </div>
                            <p>Fruit-ya cam kết mang lại những sản phẩm chất lượng cao nhất với giá cả hợp lý nhất để đem đến sự hài lòng tối đa cho khách hàng. Mục tiêu của chúng tôi không chỉ là cung cấp trái cây tươi ngon mà còn là xây dựng mối quan hệ lâu dài và tin cậy với khách hàng thông qua sự chăm sóc tận tâm và dịch vụ xuất sắc.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-box">
                            <img src="{{ asset('images/about-2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="about_section mt-5 d-flex align-items-center">
                    <div class="col-md-6 ">
                        <div class="img-box">
                            <img src="{{ asset('images/about-3.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h5 class="fw-bold">Phục Vụ Cộng Đồng::</h5>
                            </div>
                            <p>Fruit-ya không chỉ là một cửa hàng kinh doanh, mà còn là một phần của cộng đồng địa phương. Chúng tôi cam kết hỗ trợ và tham gia vào các hoạt động cộng đồng, như chương trình từ thiện và hoạt động xã hội, nhằm góp phần vào sự phát triển và phục vụ cho cộng đồng một cách tích cực.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- end about section -->
@stop
