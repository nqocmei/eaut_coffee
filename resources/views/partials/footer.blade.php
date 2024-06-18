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
            <a href="{{ route('services') }}" class="text-reset text-decoration-none">Xem chi tiết tại đây!</a>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row text-muted">
            <p class="text-center mb-0">Copy rights by @<span>{{ @config('site.site_name') }}</span></p>
        </div>
    </div>
</footer>
