@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Sửa sản phẩm</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>


    <form method="POST" action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh:</label>
            <input type="hidden" name="image_path_old" value="{{ $product->image_path }}">
            <input type="file" class="form-control mb-3" id="image_path" name="image_path" value="{{ $product->image_path }}"
                accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'preview_image_product')">
            <img id="preview_image_product" src="{{ asset($product->image_path) }}" alt="" width="auto"
                height="120" />
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá (%):</label>
            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100"
                value="{{ $product->discount }}">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $product->amount }}"
                required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Danh mục:</label>
            <select name="id_category" class="form-select">
                <option value="{{ $product->id_category }}" selected>{{ $product->categories->name }}</option>
                @foreach ($list_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="Update">
            &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/product') }}">Hủy</a>
        </div>
    </form>

    <script>
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                img.style.height = '200px';

                document.getElementById('imagePreview').innerHTML = '';
                document.getElementById('imagePreview').appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    </script>
@endsection
