@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Sửa đơn hàng</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <hr>
    <div class="mb-3">
        <div style="font-size: 16px;"><strong>Khách hàng:</strong> {{ $order->recipient }}</div>
        <div style="font-size: 16px;"><strong>Email:</strong> {{ $order->email }}</div>
        <div style="font-size: 16px;"><strong>Số điện thoại:</strong> {{ $order->pickup_phone }}</div>
        <div style="font-size: 16px;"><strong>Địa chỉ:</strong> {{ $order->delivery_address }}</div>
    </div>
    <hr>

    <form method="POST" action="{{ route('orders.update', ['orders' => $order->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="id_dathang" class="form-label">Mã đơn hàng</label>
            <input type="text" class="form-control" id="id_dathang" name="id_dathang" value="{{ $order->id }}"
                disabled>
        </div>

        <div class="mb-3">
            <label for="order_date" class="form-label">Ngày đặt</label>
            <input type="text" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}"
                disabled>
        </div>

        <div class="mb-3">
            <label for="delivery_date" class="form-label">Ngày giao hàng dự kiến</label>
            <input type="datetime-local" class="form-control" id="delivery_date" name="delivery_date"
                value="{{ isset($order->delivery_date) ? date('Y-m-d\TH:i', strtotime($order->delivery_date)) : date('Y-m-d\TH:i') }}"
                min="{{ date('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-3">
            <label for="payment_methods" class="form-label">Phương thức thanh toán</label>
            <input type="text" class="form-control" id="payment_methods" name="payment_methods"
                value="{{ $order->payment_methods == 0 ? 'COD' : 'VNPAY' }}" disabled>
        </div>

        <div class="mb-3">
            <label for="delivery_address" class="form-label">Địa chỉ giao hàng</label>
            <input type="text" class="form-control" id="delivery_address" name="delivery_address"
                value="{{ $order->delivery_address }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status" required>
                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Đang xử lý
                </option>
                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Chờ lấy hàng
                </option>
                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đang giao hàng
                </option>
                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Giao thành công</option>
            </select>
        </div>

        <div class="mb-3">
            <div style="overflow-x: scroll; max-width: 100%;">
                <table class="table table-hover my-0">
                    <thead>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Giá gốc</th>
                        <th class="text-center">Giảm giá</th>
                        <th class="text-center">Giá khuyến mại</th>
                        <th class="text-center">tổng tiền</th>
                    </thead>
                    <tbody>
                        @php
                            $totalPrice = 0;
                        @endphp

                        @foreach ($orderDetails as $orderDetail)
                            @php
                                $product = $orderDetail->product;
                                $totalPrice += $product->promotional_price * $orderDetail->quantity;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $product->name }}</td>
                                <td class="text-center">{{ $orderDetail->quantity }}</td>
                                <td class="text-center  text-decoration-line-through">
                                    {{ number_format($product->price, 0, ',', '.') }}đ</td>
                                <td class="text-center">{{ $product->discount }}%</td>
                                <td class="text-center">{{ number_format($product->promotional_price, 0, ',', '.') }}đ</td>
                                <td class="text-center">
                                    {{ number_format($product->promotional_price * $orderDetail->quantity, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-3">
            <h4 class="text-end text-danger fs-2">Tổng tiền: {{ number_format($totalPrice, 0, ',', '.') }}đ</h4>
        </div>

        <input type="submit" class="btn btn-primary" value="Update">
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/orders') }}">Hủy</a>

    </form>

@endsection
