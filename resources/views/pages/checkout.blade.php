@extends('layouts.site_layout')
@section('content')
<form class="body mt-5" action="{{ route('order-cod') }}" method="POST" id="checkout" enctype="multipart/form-data">
    @csrf
    @php
        $user = Auth::user();
    @endphp
    <div class="mb-3 bg-light p-3 my-3">
        <h4>Thông tin giao hàng</h4>
        <div class="d-md-flex justify-content-between">
            <div class="col-12 col-md-6">
                <div style="font-size: 16px;">
                    <strong>Khách hàng:</strong>
                    <input type="text" name="recipient" class="form-control my-1" placeholder="Tên khách hàng"
                        value="{{ @$user->fullname ?? old('recipient') }}">
                </div>
                <div style="font-size: 16px;"><strong>Email:</strong>
                    <input type="email" name="email" value="{{ @$user->email ?? old('email') }}"
                        class="form-control my-1" placeholder="Email khách hàng">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div style="font-size: 16px;"><strong>Số điện thoại:</strong>
                    <input type="text" name="pickup_phone" value="{{ @$user->phone ?? old('phone') }}"
                        class="form-control my-1" placeholder="Số điện thoại khách hàng">
                </div>
                <div style="font-size: 16px;"><strong>Địa chỉ:</strong>
                    <input type="text" name="delivery_address" value="{{ @$user->address ?? old('address') }}"
                        class="form-control my-1" placeholder="Địa chỉ nhận hàng">
                </div>
                <input type="hidden" name="delivery_date" value="">
                <input type="hidden" name="id_user" value="{{ @$user->id }}">
            </div>
        </div>
    </div>
    <div style="overflow-x: scroll; max-width: 100%;">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Ảnh sp</th>
                    <th>Tên sp</th>
                    <th>Giá gốc</th>
                    <th>Giảm giá</th>
                    <th>Giá khuyến mại</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $index = -1;
                @endphp
                @foreach ($carts as $cart)
                                @php
                                    $total += $cart->product->promotional_price * $cart->quantity;
                                    $index += 1;
                                @endphp
                                <tr data-id="{{ $cart->id }}">
                                    <td class="text-center">
                                        <img src="{{ asset($cart->product->image_path) }}" width="100" height="100"
                                            class="object-fit-contain" />
                                    </td>
                                    <td class="text-center">
                                        <p>{{ $cart->product->name }}</p>
                                    </td>
                                    <td class="text-center text-decoration-line-through">
                                        <p>{{ number_format($cart->product->price, 0, ',', '.') }}đ</p>
                                    </td>
                                    <td class="text-center">
                                        <p>{{ $cart->product->discount }}%</p>
                                    </td>
                                    <td class="text-center">
                                        <p>{{ number_format($cart->product->promotional_price, 0, ',', '.') }}đ</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-around gap-1">
                                            <p>{{ $cart->quantity }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center total-money">
                                        {{ number_format($cart->product->promotional_price * $cart->quantity, 0, ',', '.') }}đ
                                    </td>
                                </tr>
                                <input type="hidden" name="products[{{ $index }}][id_product]" value="{{ $cart->product->id }}" />
                                <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $cart->quantity }}" />
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <h5 class="fw-bold">Phương thức thanh toán</h5>
        <div>
            <div class="d-flex align-items-center p-2">
                <input type="radio" id="cod" name="redirect" value="0" checked>
                <label for="cod" style="margin-bottom: 1px; margin-left: 5px;"
                    class="paymentContent font-weight-bold text-xl p">
                    Trả tiền khi nhận hàng (COD)
                </label>
            </div>
            <div class="d-flex align-items-center p-2">
                <input type="radio" id="vnpay" name="redirect" value="1">
                <label for="vnpay" style="margin-bottom: 1px; margin-left: 5px;"
                    class="paymentContent font-weight-bold text-xl p">
                    Thanh toán online (VNPAY)
                </label>
            </div>
        </div>
    </div>
    <h5 class="d-flex justify-content-end align-items-center">
        Tổng thanh toán:&nbsp;<span class="text-danger total-cart" style="font-size: 20px;">
            {{ number_format($total, 0, ',', '.') }}đ</span>
        <input type="hidden" name="total_funds" value="{{ $total }}">
    </h5>
    <a href="{{ url('/cart') }}" class="btn btn-danger">
        <i class="fa fa-arrow-left"></i> Quay lại giỏ hàng</a>
    <button type="submit" class="btn btn-success text-white submit-order">Đặt hàng</button>
</form>
@endsection
@section('js')
<script>
    //cod
    $('#cod').click(function () {
        $('#checkout').attr('action', "{{ route('order-cod') }}");
    });

    //chuyen khoan vnpay
    $('#vnpay').click(function () {
        $('#checkout').attr('action', "{{ route('vnpay') }}");
    });

    $('.submit-order').click(function (event) {
        if (!confirm('Bạn có chắc chắn muốn đặt hàng bằng phương thức thanh toán này không?')) {
            event.preventDefault();
        }
    });
</script>
@if ($errors->any())
    <script>
        showToast('error', 'Lỗi', '{{ $errors->first() }}', {
            position: 'topRight'
        });
    </script>
@endif
@endsection