<?php

namespace App\Http\Controllers;

use App\Interfaces\LocationRepositoryInterface;
use App\Models\UserLocation;
use App\Transformers\UserLocationTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractal\Fractal;



class LocationController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getStatesWithCities(): JsonResponse
    {
        return response()->json($this->locationRepository->getStatesWithCities());
    }

    public function saveUserLocation(Request $request): JsonResponse
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        $user = auth()->user();

        // Check if the user already has a saved location
        $userLocation = UserLocation::updateOrCreate(
            ['user_id' => $user->id],
            [
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]
        );

        return Fractal::create()
            ->item($userLocation)
            ->transformWith(new UserLocationTransformer())
            ->respond();
    }
}
