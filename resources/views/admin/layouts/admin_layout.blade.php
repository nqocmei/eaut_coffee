<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
    <meta name="author" content="Admin Dashboard" />
    <meta name="keywords"
        content="Admin Dashboard, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" type="image/*" href="{{ asset(config('site.logo')) }}" />

    <link rel="canonical" href="https://demo-basic.Admin Dashboard.io/" />

    <title>Admin Dashboard</title>

    @include('admin.layouts.import_css')
</head>

<body>
    <div class="wrapper">
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

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset(Auth::user()->avatar ?? 'frontend/img/user.jpg') }}"
                                    class="avatar img-fluid rounded-circle me-1" alt="Admin img" />
                                <span class="text-dark">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ URL::to('/profile') }}"><i class="align-middle me-1"
                                        data-feather="user"></i>
                                    Hồ sơ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ URL::to('/admin_logout') }}">
                                    <i class="align-middle me-2" data-feather="log-out"></i>
                                    <span class="align-middle">Đăng xuất</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                @yield('admin_content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <p class="text-center mb-0">Copy rights by @<span>{{ @config('site.site_name') }}</span></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <style>
        .dropdown-menu.show {
            display: block;
        }
    </style>
    @yield('js')
    @include('admin.layouts.import_js')
    @if (Session::has('message'))
        <script>
            showToast('{{ Session::get('message')['type'] }}', 'Thông báo',
                '{{ Session::get('message')['content'] }}', {
                    position: 'topRight'
                });
        </script>
    @endif
    <script>
        const drop = document.querySelector('.nav-link.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu-end');
        drop.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownMenu.classList.toggle('show');
            dropdownMenu.setAttribute('data-bs-popper', 'static');
        });

        var currentUrl = window.location.href;
        var sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(function(link) {
            if (link.href === currentUrl) {
                link.closest('.sidebar-item').classList.add('active');
            }

            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-item').forEach(function(item) {
                    item.classList.remove('active');
                });
                link.closest('.sidebar-item').classList.add('active');
            });
        });
    </script>
</body>

</html>
