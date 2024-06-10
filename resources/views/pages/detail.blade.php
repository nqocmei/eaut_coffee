@extends('layouts.site_layout')
@section('content')
    <!--Main-->
    <div class="body" style="padding-top: 50px;">
        <a class="buy_continute" href="{{ URL::to('/') }}"><i class="fa fa-arrow-circle-left"></i> Trở lại mua hàng</a>
        <div class="mt-3 d-md-flex">
            <div class="col-md-6">
                <img src="{{ asset(@$product->image_path) }}" class="my-2 rounded"
                    style="visibility: visible; width: 100%; height: auto;">
            </div>
            <div class="col-md-6 my-3">
                <h4 class="fw-bold">{{ @$product->name }}</h4>
                <div>
                    <p class="m-0">Giá gốc:
                        <span class="text-decoration-line-through me-1">
                            {{ number_format(@$product->price, 0, ',', '.') }}₫
                        </span>
                        (-{{ $product->discount }}%)
                    </p>
                    <p class="m-0">Giá khuyến mãi:
                        {{ number_format(@$product->promotional_price, 0, ',', '.') }}₫
                    </p>
                </div>
                <div class="d-flex">
                    <span>Số lượng hiện có: {{ @$product->amount }} </span>
                </div>
                <input class="form-control mt-2" style="width: 100px;" type='number' name='quantity' id="quantity"
                    value='1' />
                <form action="" method="POST">
                    <div class="d-flex mt-3">
                        <a href="{{ route('add_to_cart', @$product->id) }}" id="add-to-cart-link"
                            class="product__cart-add text-decoration-none" name="add-to-cart">
                            Thêm vào giỏ hàng
                        </a>
                        {{-- handle soon --}}
                        <a href="{{ route('buy_now', @$product->id) }}" class="product__cart-buy text-decoration-none" name="buy-now">
                            Mua ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="body__main-title">
            <h2>MÔ TẢ SẢN PHẨM</h2>
        </div>
        <div class="px-2 my-4">{{ @$product->description }}</div>

        <!--Bình luận sản phẩm-->
        <div class="body__main-title">
            <h2>BÌNH LUẬN</h2>
        </div>
        @foreach($comments as $comment)
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <img src="{{ asset('frontend/img/user.jpg') }}" width="45" height="45" style="border-radius: 50%;" />
                    <div class="pl-3">
                        <b>{{ $comment->username }}</b>
                        <div style="line-height: 30px;">{{ $comment->content }}</div>
                        <div>{{ $comment->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
        @endforeach

        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center">
                <div>Nội dung</div>
                <div class="d-flex align-items-center">
                    <input type="hidden" id="rating" name="rating" value="0" />
                </div>
            </div>
            <textarea name="content" class="form-control" style="outline: none; margin-bottom: 5px;"></textarea>
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            @if(Auth::user())
            <input type="hidden" name="username" value="{{ Auth::user()->fullname }}" />
            @endif
            <div>
                <input class="btn btn-maincolor" type="submit" value="Gửi" />
            </div>
        </form>
        <hr>
        
        <div class="body__main-title">
            <h2>CÓ THỂ BẠN CŨNG THÍCH</h2>
        </div>
        <div class="row">
            @if ($randoms)
                @foreach ($randoms as $random)
                    <x-product-card :product="$random" />
                @endforeach
            @else
                <div>Không có dữ liệu!</div>
            @endif
        </div>
    </div>
    <script>
        document.getElementById('quantity').addEventListener('input', function() {
            var quantity = this.value;
            var link = document.getElementById('add-to-cart-link');
            var url = new URL(link.href);
            url.searchParams.set('quantity', quantity);
            link.href = url.toString();
        });
    </script>
@endsection
