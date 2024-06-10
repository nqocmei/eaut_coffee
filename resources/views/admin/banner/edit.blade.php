@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Sửa banner</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{ route('banner.update', ['bannerId' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <p class="text-danger">Lưu ý: Bạn phải cập nhập lại ảnh khi chỉnh sửa!</p>
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" class="form-control mb-3" id="title" title="title" name="title"
                value="{{ $banner->title ?? old('title') }}" required>
            <label for="position" class="form-label">Vị trí hiển thị:</label>
            <select class="form-select mb-3" aria-label="" id="position" name="position"
                data-old-value="{{ old('position', '') }}" required>
                <option selected disabled>Chọn</option>
                <option value="0" {{ $banner->position == 0 ? 'selected' : '' }}> Header (Slider)</option>
                <option value="1" {{ $banner->position == 1 ? 'selected' : '' }}>Middle</option>
                <option value="2" {{ $banner->position == 2 ? 'selected' : '' }}> Footer</option>
            </select>
            <label for="image_path" class="form-label">Tải ảnh lên (hỗ trợ jpeg, jpg, png, gif tối đa 3500kb):</label>
            <input type="file" class="form-control mb-3" id="image_path" name="image_path"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_image')">
            <img id="preview_image" src="{{ asset($banner->image_path) }}" alt="" width="auto" height="120" />
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/banner') }}">Hủy</a>
    </form>
@endsection
