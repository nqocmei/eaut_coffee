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
            <div class="dropdown me-3 mt-2 pt-1 notifications-dropdown">
                <a class="text-reset me-2 p-1 position-relative" type="button" data-bs-toggle="dropdown"
                    id="notifications-menu" aria-expanded="false">
                    <i class="fa-solid fa-bell" style="font-size: 24px;"></i>
                    @if (Auth::check())
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="total-unread-notification">
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu px-2 py-1" aria-labelledby="notifications-menu" id='notifications-list'>
                    @if (!Auth::check())
                        <li>Bạn cần đăng nhập để sử dụng tính năng này!</li>
                    @endif
                </ul>
            </div>
            @if (Auth::check() && Auth::user())
                <div class="dropdown">
                    <button class="btn btn-outline-dark me-2 p-1" type="button" data-bs-toggle="dropdown"
                        id="dropdown-menu-user" aria-expanded="false">
                        <img class="rounded-circle " src="{{ asset(Auth::user()->avatar ?? 'frontend/img/user.jpg') }}"
                            alt="avatar" width="32" height="32" />
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-menu-user" style="left:-56px">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('user_profile') }}">
                                <i class="fa-solid fa-user icon-dropdown-menu"></i>
                                Trang cá nhân
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('site.order') }}">
                                <i class="fa-solid fa-truck icon-dropdown-menu"></i>
                                Đơn hàng
                            </a>
                        </li>
                        @if (Auth::user()->id_role == 1)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-1"
                                    href="{{ route('dashboard') }}">
                                    <i class="fa-brands fa-black-tie icon-dropdown-menu"></i>
                                    Quản trị
                                </a>
                            </li>
                        @endif
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item btn d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-right-from-bracket icon-dropdown-menu"></i>
                                    Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
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
