<?php

namespace App\Repositories;

use App\Interfaces\BannerRepositoryInterface;
use App\Models\Banner;
use App\Transformers\BannerTransformer;

class BannerRepository implements BannerRepositoryInterface
{
    public function getAllBanners()
    {
        return fractal(Banner::orderBy('order', 'asc')->get(), new BannerTransformer())->toArray();
    }

    public function createBanner(array $data)
    {
        $data['image'] = $data['image']->store('banners', 'public');

        return Banner::create($data);
    }
}
