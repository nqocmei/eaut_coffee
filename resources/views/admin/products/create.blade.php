@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Thêm sản phẩm</strong></h1>
    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Hình ảnh:</label>
            <input type="file" class="form-control mb-3" id="image_path" name="image_path"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_img_product')">
        </div>

        <img id="preview_img_product" src="" alt="" width="auto" height="120" class="mb-3" />

        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}"min="0"
                max="100">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Danh mục:</label>
            <select name="id_category" class="form-select">
                <option value="">Chọn danh mục</option>
                @foreach ($list_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Gửi</button>
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/product') }}">Hủy</a>
    </form>
@endsection
