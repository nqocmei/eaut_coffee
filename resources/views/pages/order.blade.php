@extends('layouts.site_layout')
@section('content')
    <div class="body my-5">
        <h1 class="h3 mb-3"><strong>Danh sách đơn hàng</strong></h1>

        <div class="">
            @if (session()->has('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="card flex-fill" style="overflow-x: scroll; max-width: 100%;">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Người nhận</th>
                        <th class="text-center">PTTT</th>
                        <th class="text-center">Ngày đặt</th>
                        <th class="text-center">Ngày giao dự kiến</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center"> {{ $order->recipient }} </td>
                            @if ($order->payment_methods == 0)
                                <td class="text-center d-xl-table-cell">
                                    <div class="badge bg-secondary text-white">COD</div>
                                </td>
                            @elseif ($order->payment_methods == 1)
                                <td class="text-center d-xl-table-cell">
                                    <div class="badge bg-primary text-white">VNP</div>
                                </td>
                            @else
                                <td class="text-center d-xl-table-cell">---</td>
                            @endif

                            <td class="text-center d-xl-table-cell">{{ $order->order_date }}</td>
                            @if ($order->delivery_date)
                                <td class="text-center d-xl-table-cell">
                                    {{ date('d/m/Y', strtotime($order->delivery_date)) }}
                                </td>
                            @else
                                <td class="text-center">---</td>
                            @endif
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-primary text-white">Đang xử lý</span>
                                @elseif ($order->trangthai == 1)
                                    <span class="badge bg-warning text-white">Chờ lấy hàng</span>
                                @elseif ($order->trangthai == 2)
                                    <span class="badge bg-success text-white">Đang giao hàng</span>
                                @elseif ($order->trangthai == 3)
                                    <span class="badge bg-success text-white">Giao thành công</span>
                                @else
                                    <span class="badge bg-danger text-white">---</span>
                                @endif
                            </td>
                            <td class="d-md-table-cell"><a class="btn btn-outline-dark" href="{{ route('order.edit', ['id' => $order->id]) }}"
                                    class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        <tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
