<?php

namespace App\Http\Controllers\Auth;

use App\Interfaces\Auth\LocationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreLocationRequest;

use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    protected $locationRepository;


    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }
    public function getStates()
    {

        return  $this->locationRepository->getStates();
    }

    public function storeLocation(StoreLocationRequest $request): JsonResponse
    {
        $response = $this->locationRepository->storeUserLocation(
            $request->phone_number,
            $request->state_id,
            $request->city_id
        );

        return response()->json($response, 200);
    }
}
