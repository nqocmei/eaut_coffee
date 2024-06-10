@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Cấu hình trang web</strong></h1>
    <div class="container">
        <div class="row">
            <form action="{{ route('configuration.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-md-flex gap-2">
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label for="site_name">Tên trang web:</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                value="{{ @$configurations['site_name'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="site_description">Mô tả trang web:</label>
                            <textarea type="text" class="form-control" id="site_description" name="site_description" rows="2">{{ @$configurations['site_description'] }}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="site_slogan">Slogan:</label>
                            <input type="text" class="form-control" id="site_slogan" name="site_slogan"
                                value="{{ @$configurations['site_slogan'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="site_slogan_description">Slogan:</label>
                            <textarea type="text" class="form-control" id="site_slogan_description" name="site_slogan_description"
                                rows="3">{{ @$configurations['site_slogan_description'] }}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control"
                                accept="image/jpeg, image/png, image/jpg, image/gif"
                                onchange="previewImage(this, 'logo-site')">
                            <img id="logo-site" src="{{ @asset($configurations['logo']) }}" alt="Logo"
                                style="max-height: 100px; margin-top: 10px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label for="address_shop">Địa chỉ shop:</label>
                            <input type="text" class="form-control" id="address_shop" name="address_shop"
                                value="{{ @$configurations['address_shop'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone_shop">Số điện thoại shop:</label>
                            <input type="text" class="form-control" id="phone_shop" name="phone_shop"
                                value="{{ @$configurations['phone_shop'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email_shop">Email shop:</label>
                            <input type="text" class="form-control" id="email_shop" name="email_shop"
                                value="{{ @$configurations['email_shop'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="facebook_link">Facebook shop:</label>
                            <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                                value="{{ @$configurations['facebook_link'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="instagram_link">Youtube shop:</label>
                            <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                                value="{{ @$configurations['instagram_link'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="tiktok_link">Instagram shop:</label>
                            <input type="text" class="form-control" id="tiktok_link" name="tiktok_link"
                                value="{{ @$configurations['tiktok_link'] }}">
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="fw-bold">Cấu hình dịch vụ trang web</h4>
                <p class="text-danger fs-6">*Chọn màu hợp lý để không bị ảnh hưởng đến người dùng*</p>
                <div class="d-md-flex gap-2">
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="text_color">Màu chữ:</label>
                            <input type="color" class="form-control" id="text_color" name="text_color"
                                value="{{ @$configurations['text_color'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="services_firt">Dịch vụ 1:</label>
                            <input type="text" class="form-control" id="services_firt" name="services_firt"
                                value="{{ @$configurations['services_firt'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="color_services_firt">Màu background dịch vụ 1:</label>
                            <input type="color" class="form-control" id="color_services_firt"
                                name="color_services_firt" value="{{ @$configurations['color_services_firt'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon_services_firt">Icon dịch vụ 1:</label>
                            <input type="text" class="form-control" id="icon_services_firt" name="icon_services_firt"
                                value="{{ @$configurations['icon_services_firt'] }}" placeholder="Icon fontawesome">
                        </div>
                        <div class="form-group mb-2">
                            <label for="services_second">Dịch vụ 2:</label>
                            <input type="text" class="form-control" id="services_second" name="services_second"
                                value="{{ @$configurations['services_second'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="color_services_second">Màu background dịch vụ 2:</label>
                            <input type="color" class="form-control" id="color_services_second"
                                name="color_services_second" value="{{ @$configurations['color_services_second'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon_services_second">Icon dịch vụ 2:</label>
                            <input type="text" class="form-control" id="icon_services_second"
                                name="icon_services_second" value="{{ @$configurations['icon_services_second'] }}"
                                placeholder="Icon fontawesome">
                        </div>
                        <div class="form-group mb-2">
                            <label for="services_third">Dịch vụ 3:</label>
                            <input type="text" class="form-control" id="services_third" name="services_third"
                                value="{{ @$configurations['services_third'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="color_services_third">Màu background dịch vụ 3:</label>
                            <input type="color" class="form-control" id="color_services_third"
                                name="color_services_third" value="{{ @$configurations['color_services_third'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon_services_third">Icon dịch vụ 3:</label>
                            <input type="text" class="form-control" id="icon_services_third"
                                name="icon_services_third" value="{{ @$configurations['icon_services_third'] }}"
                                placeholder="Icon fontawesome">
                        </div>
                        <div class="form-group mb-2">
                            <label for="services_fourth">Dịch vụ 4:</label>
                            <input type="text" class="form-control" id="services_fourth" name="services_fourth"
                                value="{{ @$configurations['services_fourth'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="color_services_fourth">Màu background dịch vụ 4:</label>
                            <input type="color" class="form-control" id="color_services_fourth"
                                name="color_services_fourth" value="{{ @$configurations['color_services_fourth'] }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="icon_services_fourth">Icon dịch vụ 4:</label>
                            <input type="text" class="form-control" id="icon_services_fourth"
                                name="icon_services_fourth" value="{{ @$configurations['icon_services_fourth'] }}"
                                placeholder="Icon fontawesome">
                        </div>
                    </div>
                </div>
                <div class="d-flex position-fixed" style="bottom: 20px;">
                    <button type="submit" class="btn btn-success">Cập nhập</button>
                </div>
            </form>
        </div>
    </div>
@endsection
