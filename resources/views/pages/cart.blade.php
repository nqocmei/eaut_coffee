@extends('layouts.site_layout')
@section('content')
    <style>
        input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <div class="body mt-5">
        @if (Auth::check())
            @if ($carts->count() <= 0)
            <div class="my-5 py-5 text-center">
                <p class="fs-5">Bạn chưa thêm sản phẩm nào vào giỏ hàng!</p>
            </div>
            @else
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá gốc</th>
                            <th>Giảm giá (%)</th>
                            <th>Giá khuyến mại</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach ($carts as $cart)
                            @php $total += $cart->product->promotional_price * $cart->quantity @endphp
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
                                        <button class="btn btn-danger decrease-btn" data-id="{{ $cart->id }}">-</button>
                                        <input type="number" class="form-control text-center quantity-input"
                                            name="quantity" value="{{ $cart->quantity }}" min="1"
                                            max="{{ $cart->product->amount }}" readonly />
                                        <button class="btn btn-danger increase-btn" data-id="{{ $cart->id }}">+</button>
                                    </div>
                                </td>
                                <td class="text-center total-money">
                                    {{ number_format($cart->product->promotional_price * $cart->quantity, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-right">
                                <h5 class="d-flex justify-content-end align-items-center">
                                    Tổng thanh toán:&nbsp;<span class="text-danger total-cart" style="font-size: 20px;">
                                        {{ number_format($total, 0, ',', '.') }}đ</span>
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">
                                <a href="{{ url('/') }}" class="btn btn-info text-white">
                                    <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
                                </a>
                                <button class="btn btn-success">
                                    <a class="text-white text-decoration-none" href="{{ route('checkout') }}">
                                        Mua hàng
                                    </a>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            @endif
        @else
            <div class="my-5 py-5 text-center">
                <p class="fs-5">Đăng nhập để sử dụng tính năng này!</p>
            </div>
        @endif
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const updateQuantity = async function(id, quantity) {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                const csrfToken = '{{ csrf_token() }}';

                try {
                    const response = await fetch('{{ route('update_quantity_cart') }}', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            id: id,
                            quantity: quantity
                        }),
                    });

                    const data = await response.json();

                    if (data.success) {
                        row.querySelector('.total-money').textContent = data.totalPrice;
                        document.querySelector('.total-cart').textContent = data.totalCart;
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            };

            document.querySelector('tbody').addEventListener('click', function(event) {
                const target = event.target;
                if (target.classList.contains('increase-btn') || target.classList.contains(
                        'decrease-btn')) {
                    const row = target.closest('tr');
                    const quantityInput = row.querySelector('.quantity-input');
                    let quantity = parseInt(quantityInput.value);

                    if (target.classList.contains('increase-btn')) {
                        if (quantity < parseInt(quantityInput.max)) {
                            quantity++;
                            updateQuantity(row.dataset.id, quantity);
                        }
                    } else if (target.classList.contains('decrease-btn')) {
                        if (quantity > 1) {
                            quantity--;
                            updateQuantity(row.dataset.id, quantity);
                        }
                    }

                    quantityInput.value = quantity;
                }
            });
        });
    </script>
@endsection
