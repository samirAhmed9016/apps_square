<?php

namespace App\Http\Controllers;

use App\Interfaces\BannerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index(): JsonResponse
    {
        $banners = $this->bannerRepository->getAllBanners();
        return response()->json($banners, 200);
    }


    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:1',
        ]);

        $banner = $this->bannerRepository->createBanner($validatedData);

        return response()->json(['message' => 'Banner created successfully', 'banner' => $banner], 201);
    }
}
