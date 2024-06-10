@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Danh sách banner</strong></h1>

    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <a class="btn btn-primary" href="{{ route('banner.create') }}">Thêm banner</a>
    <div class="table-responsive mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Vị trí hiển thị</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td><img src="{{ asset($banner->image_path) }}" class="object-fit-contain" width="120"
                                height="120" alt=""></td>
                        <td>{{ $banner->title }}</td>
                        <td>
                            @if ($banner->position == 0)
                                Header (Slider)
                            @elseif ($banner->position == 1)
                                Middle
                            @else
                                Footer
                            @endif
                        </td>
                        <td colspan="2">
                            <a href="{{ route('banner.edit', ['banner' => $banner]) }}"
                                class="btn btn-warning mb-2">Edit</a>
                            <form method="post" action="{{ route('banner.destroy', ['banner' => $banner]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
