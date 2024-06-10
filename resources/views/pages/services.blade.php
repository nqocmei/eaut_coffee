@extends('layouts.site_layout')
@section('content')
    <div class="post-slider">
        <div class="post-wrapper" style="background: url({{ asset('images/coffee-bg.jpg') }}) no-repeat center / cover;">
            <div class="post py-5 my-4">
                <h1 class="text-white my-5 py-5 text-center" style="text-shadow: 1.5px 1.5px 0 hsl(0deg 0% 58.42%)">
                    Dịch vụ tại {{ config('site.site_name') }}
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <div class="main-services">
                                <i class="{{ config('site.icon_services_firt') }}"></i>
                                <div class="main-services__content mt-2">
                                    <h4> {{ config('site.services_firt') }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="main-services">
                                <i class="{{ config('site.icon_services_second') }}"></i>
                                <div class="main-services__content mt-2">
                                    <h4> {{ config('site.services_second') }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="main-services">
                                <i class="{{ config('site.icon_services_third') }}"></i>
                                <div class="main-services__content mt-2">
                                    <h4>{{ config('site.services_third') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="main-services">
                                <i class="{{ config('site.icon_services_fourth') }}"></i>
                                <div class="main-services__content mt-2">
                                    <h4>{{ config('site.services_fourth') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </h1>
            </div>
        </div>
    </div>
    @php
        $randomBanner = $banners
            ->filter(function ($banner) {
                return $banner->position == 1;
            })
            ->sortByDesc('created_at')
            ->first();
    @endphp
    <div class="mb-0" style="background: url({{ asset($randomBanner->image_path) }}) no-repeat center / cover;">
        <div class="service-banner mb-0">
            <div class="boxservice">
                <h3 class="fw-bold text-center">
                    {{ config('site.site_slogan') }}
                </h3>
                <p class="text-center">{{ config('site.site_slogan_description') }}</p>
            </div>
        </div>
    </div>
@endsection
