@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Sửa danh mục</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>


    <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}"
        enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" class="form-control mb-3" id="name" name="name" value="{{ $category->name ?? old('name')}}"
                required>
            <label for="is_show_in_nav" class="form-label">Hiển thị trên thanh điều hướng:</label>
            <select class="form-select mb-3" id="is_show_in_nav" name="is_show_in_nav" required>
                <option disabled>Chọn</option>
                <option value="1" {{ $category->is_show_in_nav == 1 ? 'selected' : '' }}>Có</option>
                <option value="0" {{ $category->is_show_in_nav == 0 ? 'selected' : '' }}>Không</option>
            </select>
            <label for="path" class="form-label">Đường dẫn:</label>
            <input type="text" class="form-control mb-3" id="path" name="path"
                value="{{ $category->path ?? old('path') }}">
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="Update">
            &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/category') }}">Hủy</a>
        </div>
    </form>

@endsection
