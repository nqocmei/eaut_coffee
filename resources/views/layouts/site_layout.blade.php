<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('site.site_description') }}" />
    <link rel="shortcut icon" type="image/*" href="{{ asset(config('site.logo')) }}" />
    <title>{{ @config('site.site_name') }}</title>
    @include('layouts.import_css')
    @yield('css')
</head>

<body>
    {{-- navigation --}}
    @include('partials.navigation')

    {{-- content --}}
    @yield('content')

    {{-- back to top --}}
    <div class="go-to-top"><i class="fas fa-chevron-up"></i></div>

    {{-- footer --}}
    @include('partials.footer')

    @include('layouts.import_js')
    {{-- show izi toast --}}
    @if (Session::has('message'))
        <script>
            showToast(
                "{{ Session::get('message')['type'] }}",
                'Thông báo',
                "{{ Session::get('message')['content'] }}", {
                    position: 'topRight'
                }
            );
        </script>
    @endif
    {{-- slick slider --}}
    <script src="{{ asset('frontend/script/slickSlider.js') }}"></script>
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
        {{-- <script type="module" src="{{ asset('js/pusher8_3.min.js') }}"></script> --}}
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
    @yield('js')
</body>

</html>
