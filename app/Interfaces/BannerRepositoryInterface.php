<?php

namespace App\Interfaces;

interface BannerRepositoryInterface
{
    public function getAllBanners();
    public function createBanner(array $data);
}
