<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #ffffff;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('assets_site/img/logo-toyota.jpg') }}" alt="Logo ADMIN" class="brand-image img-circle elevation-3" style="border-radius: 3px;">
      <span class="brand-text font-weight-light" style="color: black; font-weight: bold !important">VĨNH LONG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->avatar ? asset('uploads/photo/' . Auth::user()->avatar) : asset('uploads/default/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Trang chủ
                <span class="right badge badge-danger">Thống Kê</span>
              </p>
            </a>
          </li>

          <li class="nav-header">QUẢN LÝ <i class="fa fa-cubes" aria-hidden="true"></i></li>
          @if (in_array(Auth::user()->usertype, ['nvKPI', 'admin']))
          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Nhân viên
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.thongbao.index') }}" class="nav-link {{ request()->routeIs('admin.thongbao.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Thông báo
              </p>
            </a>
          </li>
            @endif
          <li class="nav-item">
            <a href="{{ route('admin.khachhang.index') }}" class="nav-link {{ request()->routeIs('admin.khachhang.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                KHÁCH HÀNG
              </p>
            </a>
          </li>

          @if (in_array(Auth::user()->usertype, ['nvKPI', 'admin']))
          <li class="nav-header">QUẢN LÝ KPI <i class="fa fa-cubes" aria-hidden="true"></i></li>

          <li class="nav-item">
            <a href="{{ route('admin.kpi.index') }}" class="nav-link {{ request()->routeIs('admin.kpi.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-star"></i>
              <p>
                    Chấm điểm KPI
              </p>
            </a>
          </li>

          <i class="fa-solid fa-feather-pointed"></i>
          <li class="nav-item">
            <a href="{{ route('admin.kpi_tieuchi.index') }}" class="nav-link {{ request()->routeIs('admin.kpi_tieuchi.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bars"></i>
                Tiêu chí KPI
              </p>
            </a>
          </li>
          @endif

          @if (in_array(Auth::user()->usertype, ['nvThongKe', 'admin']))

            <li class="nav-header">QUẢN LÝ TÍCH ĐIỂM <i class="fa fa-cogs" aria-hidden="true"></i></li>
            <li class="nav-item">
                <a href="{{ route('admin.tichdiemkhachhang.index') }}" class="nav-link {{ request()->routeIs('admin.tichdiemkhachhang.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-american-sign-language-interpreting"></i>
                <p>
                    Hóa đơn tích điểm
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.qua_doi.index') }}" class="nav-link {{ request()->routeIs('admin.qua_doi.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-object-group"></i>
                <p>
                    Quản lý quà tặng theo điểm
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.thongkevadoiqua.index') }}" class="nav-link {{ request()->routeIs('admin.thongkevadoiqua.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-window-restore"></i>
                <p>
                    Đổi quà cho khách hàng
                </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.thongkediem.index') }}" class="nav-link {{ request()->routeIs('admin.thongkediem.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-puzzle-piece"></i>
                <p>
                    Thống Kê
                </p>
                </a>
            </li>
          @endif


          <li class="nav-header">TÀI KHOẢN <i class="fa fa-cogs" aria-hidden="true"></i></li>

          <li class="nav-item">
            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Hồ sơ cá nhân
              </p>
            </a>
          </li>
          <li class="nav-item">
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Đăng Xuất</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
