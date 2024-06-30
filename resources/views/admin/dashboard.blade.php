@extends('admin.layouts.admin_layout')
@section('admin_content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Orders</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalsOrders }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-danger">
                                            <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Members</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalsCustomer }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-success">
                                            <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Sales</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalsSaleProducts }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-danger">
                                            <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng thu nhập</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ number_format($totalsMoney, 0, ',', '.') }}đ</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-success">
                                            <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Lịch</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="chart">
                                <div id="datetimepicker-dashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate =
                date.getUTCFullYear() +
                "-" +
                (date.getUTCMonth() + 1) +
                "-" +
                date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: '<span title="Previous month">&laquo;</span>',
                nextArrow: '<span title="Next month">&raquo;</span>',
                defaultDate: defaultDate,
            });
        });
    </script>
@endsection
