<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('site.site_description') }}" />
    <title>{{ @config('site.site_name') }}</title>
    <link rel="shortcut icon" type="image/*" href="{{ asset(config('site.logo')) }}" />
    @include('layouts.import_css')
</head>

<body>
    <div class="header">
        <div class="navbar mx-1">
            <div class="navbar__left">
                <a href="{{ URL::to('/') }}" class="navbar__logo">
                    <img src="{{ asset(@config('site.logo')) }}" alt="">
                </a>

                <div class="navbar__menu">
                    <i id="bars" class="fa fa-bars" aria-hidden="true"></i>
                    <ul>
                        <li>
                            <a href="{{ URL::to('/') }}">Trang chủ</a>
                        </li>
                        @foreach ($categories_in_nav as $item)
                            <li>
                                <a
                                    href="{{ route('home', ['category' => $item->id]) }}#products-by-categories">{{ $item->name }}</a>
                                <!-- <a href="{{ URL::to($item->path) }}">{{ $item->name }}</a> -->
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="navbar__center">
                <form action="{{ route('search') }}" method="GET" class="navbar__search">
                    <input type="text" value="" placeholder="Nhập để tìm kiếm..." name="keyword" class="search "
                        required>
                    <i class="fa fa-search" id="searchBtn"></i>
                </form>
            </div>

            <div class="navbar__right">
                @if (Auth::check() && Auth::user())
                    @if (Auth::user()->id_role == 1)
                        <a class="btn btn-outline-dark me-2 p-2 d-none d-md-block" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                    <a class="btn btn-outline-dark mr-2 p-1" href="{{ route('user_profile') }}">
                        <img class="rounded-circle " src="{{ asset(Auth::user()->avatar ?? 'frontend/img/user.jpg') }}"
                            alt="avatar" width="32" height="32" />
                        @if (strlen(Auth::user()->fullname) > 10)
                            {{ substr(Auth::user()->fullname, 0, 10) . '...' }}
                        @else
                            {{ Auth::user()->fullname }}
                        @endif
                    </a>
                    <div class="logout ms-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-dark px-3 py-2" type="submit">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="login">
                        <a href="{{ URL::to('login') }}"><i class="fa fa-user"></i></a>
                    </div>
                @endif

                <a href="{{ route('cart') }}" class="navbar__shopping-cart">
                    <img src="{{ asset('frontend/img/shopping-cart.svg') }}" style="width: 24px;" alt="">
                    @if ($count_cart)
                        @if ($count_cart > 9)
                            <span>9+</span>
                        @else
                            <span>{{ $count_cart }}</span>
                        @endif
                    @else
                        <span>0</span>
                    @endif
                </a>
            </div>
        </div>

    </div>

    <!-- Content -->
    @yield('content')

    <div class="go-to-top"><i class="fas fa-chevron-up"></i></div>

    <footer>
        <div class="mx-5 d-md-flex py-3 h-auto">
            <div class="col-12 col-md-3 text-white">
                <h5 class="fw-bold">Giới thiệu</h5>
                <p class="ms-2">{{ @config('site.site_description') }}</p>
            </div>

            <div class="col-12 col-md-3 text-white">
                <h5 class="fw-bold">Liên hệ</h5>
                <p class="ms-2">Địa chỉ: {{ @config('site.address_shop') }}</p>
                <p class="ms-2">Email: {{ @config('site.email_shop') }}</p>
                <p class="ms-2">Số điện thoại: {{ @config('site.phone_shop') }}</p>
            </div>

            <div class="col-12 col-md-3 text-white">
                <h5 class="fw-bold">Liên kết</h5>
                <div class="d-flex gap-2">
                    <a href="{{ @config('site.facebook_link') }}" target="_blank" class="text-reset">
                        <i class="fa-brands fa-facebook fs-2"></i>
                    </a>
                    <a href="{{ @config('site.instagram_link') }}" class="text-reset" target="_blank">
                        <i class="fa-brands fa-instagram fs-2"></i>
                    </a>
                    <a href="{{ @config('site.tiktok_link') }}" class="text-reset" target="_blank">
                        <i class="fa-brands fa-tiktok fs-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 text-white">
                <h5 class="fw-bold">Dịch vụ</h5>
                <a href="{{ route('services')}}" class="text-reset text-decoration-none">Xem chi tiết tại đây!</a>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row text-muted">
                <p class="text-center mb-0">Copy rights by @<span>{{ @config('site.site_name') }}</span></p>
            </div>
        </div>
    </footer>
    @include('layouts.import_js')
    {{-- show izi toast --}}
    @if (Session::has('message'))
        <script>
            showToast(
                "{{ Session::get('message')['type'] }}", 
                'Thông báo',
                "{{ Session::get('message')['content'] }}", 
                { position: 'topRight' }
            );
        </script>
    @endif
    {{-- slick slider --}}
    <script>
        $(document).ready(function () {
            $('.post-wrapper').slick({
                slidesToScroll: 1,
                autoplay: true,
                arrow: true,
                dots: true,
                autoplaySpeed: 5000,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                appendDots: $(".dot"),
            });
        });

        $('.post-wrapper-slick').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: $('.prev2'),
            nextArrow: $('.next2'),
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });
    </script>
    @yield('js')
</body>

</html>