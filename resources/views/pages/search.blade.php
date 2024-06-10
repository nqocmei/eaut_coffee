@extends('layouts.site_layout')
@section('content')
    <div class="body">
        <div class="body__main-title">
            <h2>Từ khóa đã tìm kiếm: {{ $keyword }}</h2>
        </div>
        <div>
            <div class="row">
                @foreach ($searchs as $search)
                     <!-- call component -->
                    <x-product-card :product='$search' />
                @endforeach
            </div>
            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="page-item @if ($searchs->currentPage() === 1) disabled @endif">
                        <a class="page-link" href="{{ $searchs->url(1) }}&keyword={{ $keyword }}">First</a>
                    </li>
                    <li class="page-item @if ($searchs->currentPage() === 1) disabled @endif">
                        <a class="page-link"
                            href="{{ $searchs->previousPageUrl() }}&keyword={{ $keyword }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $searchs->lastPage(); $i++)
                        <li class="page-item @if ($searchs->currentPage() === $i) active @endif">
                            <a class="page-link"
                                href="{{ $searchs->url($i) }}&keyword={{ $keyword }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if ($searchs->currentPage() === $searchs->lastPage()) disabled @endif">
                        <a class="page-link" href="{{ $searchs->nextPageUrl() }}&keyword={{ $keyword }}">Next</a>
                    </li>
                    <li class="page-item @if ($searchs->currentPage() === $searchs->lastPage()) disabled @endif">
                        <a class="page-link"
                            href="{{ $searchs->url($searchs->lastPage()) }}&keyword={{ $keyword }}">Last</a>
                    </li>
                </ul>
            </nav>

        </div>

    </div>
@endsection
