<header class="header_section fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="{{ route('home.index') }}">
          <img src="../images/logo.png" alt="" width="100px" height="100px" />
        </a>

        <button
            data-mdb-collapse-init
            class="navbar-toggler"
            type="button"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home.index') }}">Trang chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.about') }}"> Giới thiệu </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('store.index') }}">Cửa hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.contact') }}">Liên hệ</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <x-app-layout>

                        </x-app-layout>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @endif
                @endauth
            @endif
          </ul>
        </div>
      </nav>
    </div>
</header>
