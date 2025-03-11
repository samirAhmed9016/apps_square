<?php

namespace App\Repositories;

use App\Interfaces\FavoriteRepositoryInterface;
use App\Models\Favorite;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function addToFavorites(int $userId, int $productId)
    {
        return Favorite::create(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function removeFromFavorites(int $userId, int $productId)
    {
        return Favorite::where('user_id', $userId)->where('product_id', $productId)->delete();
    }

    public function getUserFavorites(int $userId)
    {
        // return Favorite::where('user_id', $userId)->with('product')->get();
        return Favorite::with('product')->where('user_id', auth()->id())->get();
    }
}
