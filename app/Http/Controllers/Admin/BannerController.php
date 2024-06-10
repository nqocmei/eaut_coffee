<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Repositories\Banner\BannerInterface;

use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    private $BannerRepository;

    public function __construct(BannerInterface $BannerRepository)
    {
        $this->BannerRepository = $BannerRepository;
    }

    public function index()
    {
        $banners = $this->BannerRepository->getAllBanner();

        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|integer',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3500',
        ]);

        $this->BannerRepository->store($request);

        return redirect()->route('banner.index')->with('success', 'Tải banner lên thành công!');
    }

    public function update(Request $request) {
        $request->validate([
            'title' =>'required|string|max:255',
            'position' =>'required|integer',
            'image_path' =>'required|image|mimes:jpeg,png,jpg,gif|max:3500',
        ]);

        $this->BannerRepository->update($request, $request->route('bannerId'));

        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
    }

    public function edit($id)
    {
        $banner = $this->BannerRepository->findById($id);

        return view('admin.banner.edit', ['banner' => $banner]);
    }

    public function destroy($id) {
        $this->BannerRepository->destroy($id);

        return redirect()->route('banner.index')->with('success', 'Xóa banner thành công!');
    }
}
