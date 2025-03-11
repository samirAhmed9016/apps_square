<?php

namespace App\Interfaces;

interface LocationRepositoryInterface
{
    public function getStatesWithCities();
    public function saveUserLocation($userId, $stateId, $cityId);
}
