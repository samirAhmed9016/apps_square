<?php

namespace App\Repositories;

use App\Models\State;
use App\Models\City;
use App\Models\UserLocation;
use App\Interfaces\LocationRepositoryInterface;
use App\Transformers\StateTransformer;
use Spatie\Fractal\Fractal;

class LocationRepository implements LocationRepositoryInterface
{

    public function getStatesWithCities()
    {
        return State::with('cities')->get();
        return Fractal::create()
            ->collection($states)
            ->transformWith(new StateTransformer())
            ->respond();
    }


    public function saveUserLocation($userId, $stateId, $cityId)
    {
        return UserLocation::updateOrCreate(
            ['user_id' => $userId],
            ['state_id' => $stateId, 'city_id' => $cityId]
        );
    }
}
