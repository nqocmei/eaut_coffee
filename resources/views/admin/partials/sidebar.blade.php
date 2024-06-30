<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ URL::to('/dashboard') }}">
            <span class="align-middle">Coffee shop</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">Pages</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/banner') }}">
                    <i class="align-middle" data-feather="image"></i>
                    <span class="align-middle">Banner</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/product') }}">
                    <i class="align-middle" data-feather="box"></i>
                    <span class="align-middle">Sản phẩm</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/category') }}">
                    <i class="align-middle" data-feather="tag"></i>
                    <span class="align-middle">Danh mục</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/orders') }}">
                    <i class="align-middle me-2" data-feather="package"></i>
                    <span class="align-middle">Đơn hàng</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/users') }}">
                    <i class="align-middle me-2" data-feather="user"></i>
                    <span class="align-middle">Người dùng</span>
                </a>
            </li>
            <li class="sidebar-header">Cài đặt trang web</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ URL::to('/admin/settings') }}">
                    <i class="align-middle me-2" data-feather="settings"></i>
                    <span class="align-middle">Cài đặt</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
