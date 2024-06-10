@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Danh sách đơn hàng</strong></h1>

    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card flex-fill">
        <div class="table-responsive mb-2">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Người nhận</th>
                        <th class="text-center">Thanh toán</th>
                        <th class="text-center">Ngày đặt</th>
                        <th class="text-center">Ngày giao</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Địa chỉ giao hàng</th>
                        <th class="text-center">Điện thoại</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center">{{ $order->recipient }}</td>
                            @if ($order->payment_methods == 0)
                                <td class="d-xl-table-cell text-center">
                                    <div class="badge bg-secondary">COD</div>
                                </td>
                            @elseif ($order->payment_methods == 1)
                                <td class="d-xl-table-cell text-center">
                                    <div class="badge bg-primary">VNPAY</div>
                                </td>
                            @else
                                <td class="d-xl-table-cell text-center">NaN</td>
                            @endif

                            <td class=" d-xl-table-cell text-center">{{ $order->order_date }}</td>
                            @if ($order->delivery_date)
                                <td class="d-xl-table-cell text-center">
                                    {{ date('d/m/Y', strtotime($order->delivery_date)) }}</td>
                            @else
                                <td class="text-center">----</td>
                            @endif
                            <td class="text-center">
                                {{-- 0 - pedding, 1 - waiting, 2 - delivering, 3 - success --}}
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
                            </td>
                            <td class="d-md-table-cell text-center">{{ $order->delivery_address }}</td>
                            <td class="d-md-table-cell text-center">{{ $order->pickup_phone }}</td>
                            <td class="d-md-table-cell text-center"><a
                                    href="{{ route('orders.edit', ['orders' => $order->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                        </tr>
                        <tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <ul class="pagination">
        <li class="page-item @if ($orders->currentPage() === 1) disabled @endif">
            <a class="page-link" href="{{ $orders->previousPageUrl() }}">Previous</a>
        </li>
        @for ($i = 1; $i <= $orders->lastPage(); $i++)
            <li class="page-item @if ($orders->currentPage() === $i) active @endif">
                <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item @if ($orders->currentPage() === $orders->lastPage()) disabled @endif">
            <a class="page-link" href="{{ $orders->nextPageUrl() }}">Next</a>
        </li>
    </ul>
@endsection
