<?php

namespace App\Interfaces;

interface FavoriteRepositoryInterface
{
    public function addToFavorites(int $userId, int $productId);
    public function removeFromFavorites(int $userId, int $productId);
    public function getUserFavorites(int $userId);
}
