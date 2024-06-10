<?php
namespace App\Repositories\Banner;

interface BannerInterface
{
    public function store($request);

    public function update($request, $id);
    public function getAllBanner();
    public function findById($id);
    public function destroy($id);
}

