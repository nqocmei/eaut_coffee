@extends('layouts.site_layout')
@section('content')
    <div class="body my-5">
        <h1 class="h3 mb-3 bg-light p-3"><strong>Đơn hàng đã đặt</strong></h1>
        <div class="err">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @php
            $status = $order->status == 0;
        @endphp
        <div class="mb-3 bg-light p-3 my-3">
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('put')
                <h5 class="fw-bold">Thông tin khách hàng</h5>
                <div class="me-4 row">
                    <div class="col-12 col-md-6">
                        <label for="recipient" class="fw-bold">Người nhận</label>
                        <input type="text" name="recipient" id="recipient" class="form-control mb-3"
                            placeholder="Nhập tên người nhận" value="{{ $order->recipient ?? old('recipient') }}"
                            {{ $status ? '' : 'disabled' }} />
                        <label for="email" class="fw-bold">Email:</label>
                        <input type="text" id="email" class="form-control mb-3" value="{{ $order->user->email }}"
                            disabled readonly />
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="pickup_phone" class="fw-bold">Số điện thoại</label>
                        <input type="text" name="pickup_phone" id="pickup_phone" class="form-control mb-3"
                            placeholder="Nhập số điện thoại" value="{{ $order->pickup_phone ?? old('pickup_phone') }}"
                            {{ $status ? '' : 'disabled' }} />
                        <label for="delivery_address" class="fw-bold">Địa chỉ</label>
                        <input type="text" name="delivery_address" id="delivery_address" class="form-control mb-3"
                            placeholder="Nhập địa chỉ" value="{{ $order->delivery_address ?? old('delivery_address') }}"
                            {{ $status ? '' : 'disabled' }} />
                    </div>
                </div>
                @if ($status)
                    <button class="btn btn-success" type="submit">Cập nhập</button>
                @endif
            </form>

            <div class="mb-3">
                <hr>
                <h5 class="fw-bold">Thông tin đơn hàng</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="me-1 fw-bold">ID đơn hàng:</span>{{ $order->id }}
                    </li>
                    <li class="list-group-item">
                        <span class="me-1 fw-bold">Ngày đặt:</span>{{ $order->order_date }}
                    </li>
                    <li class="list-group-item">
                        <span class="me-1 fw-bold">Ngày giao dự kiến:</span>
                        @if ($order->delivery_date)
                            {{ date('Y-m-d', strtotime($order->delivery_date)) }}
                        @else
                            ---
                        @endif
                    </li>
                    <li class="list-group-item">
                        <span class="me-1 fw-bold">Phương thức thanh toán:</span>
                        @if ($order->payment_methods == 0)
                            <div class="badge bg-secondary text-white">COD</div>
                        @elseif ($order->payment_methods == 1)
                            <div class="badge bg-primary text-white">VNP</div>
                        @else
                            ---
                        @endif
                    </li>
                    <li class="list-group-item">
                        <span class="me-1 fw-bold">Trạng thái:</span>
                        @if ($order->status == 0)
                            <span class="badge bg-primary">Đang xử lý</span>
                        @elseif ($order->status == 1)
                            <span class="badge bg-warning">Chờ lấy hàng</span>
                        @elseif ($order->status == 2)
                            <span class="badge bg-success">Đang giao hàng</span>
                        @elseif ($order->status == 3)
                            <span class="badge bg-success">Giao hàng thành công</span>
                        @else
                            <span class="badge bg-danger">----</span>
                        @endif
                    </li>
                    </li>
                </ul>
            </div>

            <div class="mb-3">
                <table class="table table-hover my-0">
                    <thead>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá gốc</th>
                        <th>Giảm giá</th>
                        <th>Giá khuyến mại</th>
                        <th>tổng tiền</th>
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

            <h5 class="d-flex justify-content-end align-items-center">
                Tổng thanh toán: &nbsp;<div class="text-danger" style="font-size: 20px;">
                    {{ number_format($totalPrice, 0, ',', '.') }}đ</div>
            </h5>

            &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/order') }}">Quay lại</a>
        </div>
    </div>
@endsection
