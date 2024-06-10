@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Thêm banner</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="POST" action="{{ route('banner.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" class="form-control mb-3" id="title" title="title" name="title"
                value="{{ old('title') }}" required>
            <label for="position" class="form-label">Vị trí hiển thị:</label>
            <select class="form-select mb-3" aria-label="" id="position" name="position"
                data-old-value="{{ old('position', '') }}" required>
                <option selected disabled>Chọn</option>
                <option value="0"> Header (Slider)</option>
                <option value="1"> Middle</option>
                <option value="2"> Footer</option>
            </select>
            <label for="image_path" class="form-label">Tải ảnh lên (hỗ trợ jpeg, jpg, png, gif):</label>
            <input type="file" class="form-control mb-3" id="image_path" name="image_path"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_image_created')">
            <img id="preview_image_created" src="{{ asset('images/imgNotFound.jpg') }}" alt="" width="auto" height="120"  />
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/banner') }}">Hủy</a>
    </form>

@endsection
