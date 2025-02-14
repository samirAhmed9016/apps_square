<?php

namespace App\Interfaces\Auth;

interface LocationRepositoryInterface
{
    public function getStates();
    public function storeUserLocation(string $phone_number, int $state_id, int $city_id): array;
}
