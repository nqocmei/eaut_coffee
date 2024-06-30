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
    <title>Admin Dashboard</title>
    @include('admin.layouts.import_css')
</head>

<body>
    <div class="wrapper">
        {{-- side bar --}}
        @include('admin.partials.sidebar')

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="dropdown notifications-dropdown">
                            <a class="text-reset me-2 p-1 position-relative" type="button" data-bs-toggle="dropdown"
                                id="notifications-menu" aria-expanded="false">
                                <i class="fa-solid fa-bell" style="font-size: 24px;"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="total-unread-notification">
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-1" aria-labelledby="notifications-menu"
                                id='notifications-list'>
                                @if (!Auth::check())
                                    <li>Bạn cần đăng nhập để sử dụng tính năng này!</li>
                                @endif
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a type="button" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(Auth::user()->avatar ?? 'frontend/img/user.jpg') }}"
                                    class="avatar img-fluid rounded-circle me-1" alt="Admin img" />
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href="{{ URL::to('/profile') }}"><i
                                            class="align-middle me-1" data-feather="user"></i>Hồ sơ</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="{{ URL::to('/admin_logout') }}"><i
                                            class="align-middle me-2" data-feather="log-out"></i><span
                                            class="align-middle">Đăng xuất</span></a></li>
                            </ul>
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
</body>
@include('admin.layouts.import_js')
@yield('js')
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
<script>
    const csrfToken = '{{ csrf_token() }}';
</script>
@if (Auth::check())
    <script src="{{ asset('frontend/script/notifications.js') }}"></script>
    <script>
        const apiNotificationReadUrl = "{{ route('api_notification_read') }}";
        const api_token = '{{ Auth::user()->api_token }}';
        countUnreadNotifications("{{ route('api_notification_count_unread') }}");
        getListNotification("{{ route('api_notification_list_more') }}");
        const notificationsList = document.getElementById('notifications-list');
        notificationsList.addEventListener('scroll', () => {
            if (notificationsList.scrollTop + notificationsList.clientHeight >= notificationsList.scrollHeight) {
                getListNotification("{{ route('api_notification_list_more') }}");
            }
        });
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script type="module" src="{{ asset('js/pusher8_3.min.js') }}"></script>
    <script type="module">
        import Echo from '{{ asset('js/laravel-echo_1.15.3_echo.min.js') }}';

        const id = '{{ Auth::id() }}';

        window.Pusher = Pusher;

        const echo = new Echo({
            broadcaster: 'pusher',
            namespace: 'App.Events',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true,
            wsHost: window.location.hostname,
            encrypted: true,
        });

        echo.channel(`notification-${id}`).listen('.notification', (data) => {
            appendNotifications(data?.message, true);
            countUnreadNotifications("{{ route('api_notification_count_unread') }}");
        });
    </script>
@endif

</html>
