<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{route("admin.index")}}"><img src="{{ route('home.index') }}/images/logo.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{route("admin.index")}}"><img src="{{ route('home.index') }}/images/logo.png" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('admin.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('account.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Tài khoản</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('vendor.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-contacts"></i>
          </span>
          <span class="menu-title">Nhà cung cấp</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('category.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Danh mục sản phẩm</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('product.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
          </span>
          <span class="menu-title">Sản phẩm</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('import.index')}}">
          <span class="menu-icon">
            <span class="mdi mdi-import"></span>
          </span>
          <span class="menu-title">Nhập hàng</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('order.index')}}">
          <span class="menu-icon">
            <i class="mdi mdi-file-document-box"></i>
          </span>
          <span class="menu-title">Đơn hàng</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-icon">
            <i class="mdi mdi-chart-bar"></i>
          </span>
          <span class="menu-title">Báo cáo và thống kê</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('report.product.index')}}"> Thống kê sản phẩm </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('report.revenue.index')}}"> Báo cáo doanh thu </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{route('admin.history')}}">
          <span class="menu-icon">
            <span class="mdi mdi-history"></span>
          </span>
          <span class="menu-title">Lịch sử truy cập</span>
        </a>
      </li>
    </ul>
  </nav>
