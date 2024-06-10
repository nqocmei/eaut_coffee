@extends('layouts.site_layout')
@section('content')

<div class="post-slider">
    <i class="fa fa-chevron-left prev" aria-hidden="true"></i>
    <i class="fa fa-chevron-right next" aria-hidden="true"></i>

    <div class="post-wrapper">
        @foreach ($banners as $banner)
            @if ($banner->position == 0)
                <div class="post">
                    <img src="{{ asset($banner->image_path) }}" alt="{{ $banner->title }}">
                </div>
            @endif
        @endforeach
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="body">

    <div class="body__main-title">
        <h2>Sản phẩm nổi bật</h2>
    </div>

    <div class="post-slider2">
        <i class="fa fa-chevron-left prev2" aria-hidden="true"></i>
        <i class="fa fa-chevron-right next2" aria-hidden="true"></i>

        <div class="row">
            <div class="post-wrapper-slick w-100">
                @if ($related_products)
                    @foreach ($related_products as $product)
                        <a class="col-md-3 col-6 post-card-container text-reset text-decoration-none"
                            href="{{ route('detail', ['id' => @$product->id]) }}">
                            <div class="product">
                                <div class="product__img">
                                    <img src="{{ asset(@$product->image_path) }}" alt="">
                                </div>
                                <div class="product__sale">
                                    <div>
                                        @if (@$product->discount)
                                            -{{ @$product->discount }}%
                                        @else
                                            Mới
                                        @endif
                                    </div>
                                </div>

                                <div class="product__content">
                                    <div class="product__title">
                                        {{ @$product->name }}
                                    </div>

                                    <div class="product__old-price">
                                        <span class="Price">
                                            <bdi>
                                                {{ number_format(@$product->price, 0, ',', '.') }}
                                                <span class="currencySymbol">₫</span>
                                            </bdi>
                                        </span>
                                    </div>

                                    <div class="product__new-price">
                                        <span>
                                            <bdi>
                                                {{ number_format(@$product->promotional_price, 0, ',', '.') }}
                                                <span class="currencySymbol">₫</span>
                                            </bdi>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div>No data</div>
                @endif
            </div>

        </div>
    </div>
</div>

<div class="banner">
    <div class="body__main-title">
        <h2>Dịch vụ của chúng tôi</h2>
    </div>

    <div class="banner-top banner-top-2 row gap-2 gap-md-0" style="color: {{ config('site.text_color') }};">
        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: {{ config('site.color_services_firt') }};">
                <div> {{ config('site.services_firt') }} </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: {{ config('site.color_services_second') }};">
                <div style="margin: 0 auto;"> {{ config('site.services_second') }} </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: {{ config('site.color_services_third') }};">
                <div style="margin: 0 auto;"> {{ config('site.services_third') }} </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#" class="banner-top-2-child text-decoration-none text-reset"
                style="background-color: {{ config('site.color_services_fourth') }};">
                <div> {{ config('site.services_fourth') }} </div>
            </a>
        </div>

    </div>
</div>

<div class="banner">
    @php
        $randomBanner = $banners
            ->filter(function ($banner) {
                return $banner->position == 1;
            })
            ->sortByDesc('created_at')
            ->first();
    @endphp

    @if ($randomBanner)
        <div class="banner-top">
            <img src="{{ asset($randomBanner->image_path) }}" alt="{{ $randomBanner->title }}">
        </div>
    @endif

</div>

<div class="body" id='products-by-categories'>
    <div class="body__main-title d-flex align-items-center">
        <h2>Sản phẩm theo danh mục</h2>
    </div>
    <ul class="nav nav-tabs" id="tab-products-category" role="tablist">
        @foreach ($categories as $category)
            <li class="nav-item nav-link-item" role="presentation">
                <button class="nav-link{{ (request()->query('category') ?? 1) == $category->id ? ' active' : '' }}"
                    id="{{ Str::slug($category->name) }}-tab" data-bs-toggle="tab"
                    data-bs-target="#{{ Str::slug($category->name) }}" role="tab"
                    aria-controls="{{ Str::slug($category->name) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                    onclick="window.location='{{ route('home', ['category' => $category->id]) }}#products-by-categories';">
                    {{ $category->name }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="tab-products-category-content">
        @foreach ($categories as $category)
            <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}" id="{{ Str::slug($category->name) }}"
                role="tabpanel" aria-labelledby="{{ Str::slug($category->name) }}-tab">
                <div class="row">
                    @if ($products_by_category->count() > 0)
                        @foreach ($products_by_category as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    @else
                        <div class="mt-3 mb-1">Opps! Không tìm thấy dữ liệu!</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="banner">
    @php
        $latestBanners = $banners
            ->filter(function ($banner) {
                return $banner->position == 2;
            })
            ->sortByDesc('created_at')
            ->take(3);
    @endphp
    <div class="row banner-top">
        @foreach ($latestBanners as $banner)
            <img class="col-md-4 col-sm-6" src="{{ asset($banner->image_path) }}" />
        @endforeach
    </div>
</div>

<!-- Products -->
<div class="body">

    <div class="body__main-title">
        <h2>TẤT CẢ SẢN PHẨM</h2>
    </div>

    <div>
        <div class="row">
            @foreach ($productsForHome as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <center style="margin-top: 30px;">
            <a href="{{ route('viewAll') }}" class="btn text-white" style="background: #ff4500;">Xem thêm</a>
        </center>
    </div>

</div>

@endsection