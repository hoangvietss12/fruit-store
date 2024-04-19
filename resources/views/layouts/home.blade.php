<!DOCTYPE html>
<html lang="vn">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title')</title>

  @include('home.assets.css')
</head>

<body>

  <!-- header section start -->
    @include('home.components.header')
  <!-- end header section -->

    @yield('content')

  <!-- footer section -->
  @include('home.components.footer')
  <!-- end footer section -->

  <!-- copyright section -->
  @include('home.components.copyright')
  <!-- copyright section -->

  @include('home.assets.js')

  @yield('script')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var carouselItems = document.querySelectorAll("#customCarousel1 .carousel-item");
    var currentIndex = 0;
    var interval = 5000;

    function showSlide(index) {
        carouselItems.forEach(function(item, i) {
            if (i === index) {
                item.classList.add("active");
            } else {
                item.classList.remove("active");
            }
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
        showSlide(currentIndex);
    }

    var nextBtn = document.querySelector("#customCarousel1 .carousel-control-next");
    var prevBtn = document.querySelector("#customCarousel1 .carousel-control-prev");

    nextBtn.addEventListener("click", function() {
        nextSlide();
    });

    prevBtn.addEventListener("click", function() {
        prevSlide();
    });

    var indicators = document.querySelectorAll("#customCarousel1 .carousel-indicators li");
    indicators.forEach(function(indicator, index) {
        indicator.addEventListener("click", function() {
            currentIndex = index;
            showSlide(currentIndex);
        });
    });

    var autoSlide = setInterval(nextSlide, interval);

    document.querySelector("#customCarousel1").addEventListener("mouseenter", function() {
        clearInterval(autoSlide);
    });

    document.querySelector("#customCarousel1").addEventListener("mouseleave", function() {
        autoSlide = setInterval(nextSlide, interval);
    });
});

  </script>
</body>

</html>
