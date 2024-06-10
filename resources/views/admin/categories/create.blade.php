@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Thêm danh mục</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" class="form-control mb-3" id="name" name="name" value="{{ old('name') }}" required>
            <label for="is_show_in_nav" class="form-label">Hiển thị trên thanh điều hướng:</label>
            <select class="form-select mb-3" aria-label="" id="is_show_in_nav" name="is_show_in_nav" data-old-value="{{ old('is_show_in_nav', '') }}" required>
                <option selected disabled>Chọn</option>
                <option value="1">Có</option>
                <option value="0">Không</option>
            </select>
            <label for="path" class="form-label">Đường dẫn:</label>
            <input type="text" class="form-control mb-3" id="path" name="path" value="{{ old('path') }}">
        </div>

        <button type="submit" class="btn btn-primary">Gửi</button>
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/category') }}">Hủy</a>
    </form>

@endsection
