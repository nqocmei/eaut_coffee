<?php

namespace App\Repositories\Banner;

use App\Models\Banner;

class BannerRepository implements BannerInterface
{
    public function store($request)
    {
        $imageName = time() . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('storage/images/banners'), $imageName);

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->position = $request->position;
        $banner->image_path = 'storage/images/banners/' . $imageName;
        $banner->save();
    }

    public function update($request, $id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->back()->with('error', 'Không tìm thấy banner!');
        }
        $banner->title = $request->title;
        $banner->position = $request->position;
        if ($request->hasFile('image_path')) {
            $oldImagePath = public_path($banner->image_path);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $imageName = md5(rand() . time()) . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('storage/images/banners'), $imageName);
            $banner->image_path = 'storage/images/banners/' . $imageName;
        }
        $banner->save();
    }

    public function getAllBanner()
    {
        return Banner::all();
    }

    public function findById($id)
    {
        return Banner::find($id);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $filePath = public_path($banner->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $banner->delete();
        }
        return redirect()->back()->with('error', 'Không tìm thấy banner!');
    }
}
