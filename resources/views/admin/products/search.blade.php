@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Từ khóa đã tìm kiếm: {{ $keyword }}</strong></h1>

    <div class="d-flex justify-content-between">
        <a class="btn btn-primary" href="{{ route('product.create') }}">Thêm sản phẩm</a>

        <form action="{{ route('search.product') }}" method="GET" class="d-flex">
            <input type="text" value="" placeholder="Nhập để tìm kiếm..." name="keyword" class="form-control"
                style="width: unset;" required>
            <button class="btn btn-primary" type="submit">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </form>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Hình</th>
                <th>Số lượng</th>
                <th>Giá gốc</th>
                <th>Giảm giá</th>
                <th>Giá khuyến mại</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchs as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset($product->image_path) }}" class="object-fit-contain" width="120"
                            height="120" alt=""></td>
                    <td>{{ $product->amount }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if ($product->discount)
                            {{ $product->discount }}%
                        @endif
                    </td>
                    <td>{{ $product->promotional_price }}</td>
                    <td colspan="2">
                        <a href="{{ route('product.edit', ['product' => $product]) }}" class="btn btn-warning mb-2">Edit</a>
                        <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Delete"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item @if ($searchs->currentPage() === 1) disabled @endif">
                <a class="page-link" href="{{ $searchs->url(1) }}&keyword={{ $keyword }}">Đầu</a>
            </li>
            <li class="page-item @if ($searchs->currentPage() === 1) disabled @endif">
                <a class="page-link" href="{{ $searchs->previousPageUrl() }}&keyword={{ $keyword }}">Trước</a>
            </li>
            @for ($i = 1; $i <= $searchs->lastPage(); $i++)
                <li class="page-item @if ($searchs->currentPage() === $i) active @endif">
                    <a class="page-link"
                        href="{{ $searchs->url($i) }}&keyword={{ $keyword }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item @if ($searchs->currentPage() === $searchs->lastPage()) disabled @endif">
                <a class="page-link" href="{{ $searchs->nextPageUrl() }}&keyword={{ $keyword }}">Sau</a>
            </li>
            <li class="page-item @if ($searchs->currentPage() === $searchs->lastPage()) disabled @endif">
                <a class="page-link" href="{{ $searchs->url($searchs->lastPage()) }}&keyword={{ $keyword }}">Cuối</a>
            </li>
        </ul>
    </nav>
@endsection
