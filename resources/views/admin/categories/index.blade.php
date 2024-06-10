@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Danh sách danh mục</strong></h1>

    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <a class="btn btn-primary" href="{{ route('category.create') }}">Thêm danh mục</a>
    <p class="text-danger my-2">Chỉ nên thêm ít danh mục</p>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên danh mục</th>
                    <th>Hiển thị trên nav</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if ($category->is_show_in_nav == 1)
                                Có
                            @elseif ($category->is_show_in_nav == 0)
                                Không
                            @endif
                        </td>
                        <td colspan="2">
                            <a href="{{ route('category.edit', ['category' => $category]) }}"
                                class="btn btn-warning mb-2">Edit</a>
                            <form method="post" action="{{ route('category.destroy', ['category' => $category]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
