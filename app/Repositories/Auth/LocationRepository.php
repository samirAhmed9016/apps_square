<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\LocationRepositoryInterface;
use App\Models\State;
use App\Models\TemporaryUser;
use App\Models\TemporaryUserLocation;


class LocationRepository implements LocationRepositoryInterface
{



    public function getStates()
    {
        return response()->json(State::with('cities')->get());
    }


    public function storeUserLocation(string $phone_number, int $state_id, int $city_id): array
    {

        $temporaryUser = TemporaryUser::where('phone_number', $phone_number)->first();
        if (!$temporaryUser) {
            return ['error' => 'Phone number not found. Verify phone first.'];
        }
        $location = TemporaryUserLocation::where('phone_number', $phone_number)->first();

        if ($location) {
            $location->update([
                'state_id' => $state_id,
                'city_id' => $city_id
            ]);
        } else {
            TemporaryUserLocation::create([
                'phone_number' => $phone_number,
                'state_id' => $state_id,
                'city_id' => $city_id
            ]);
        }
        return ['message' => 'Location stored successfully.'];
    }
}
