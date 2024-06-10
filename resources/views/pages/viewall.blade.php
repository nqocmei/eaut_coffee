@extends('layouts.site_layout')
@section('content')
    <div class="body">
        <div class="body__main-title">
            <h2>TẤT CẢ SẢN PHẨM</h2>
        </div>
        <div>
            <div class="row">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="page-item @if ($products->currentPage() === 1) disabled @endif">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item @if ($products->currentPage() === $i) active @endif">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if ($products->currentPage() === $products->lastPage()) disabled @endif">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
@endsection
