<?php

namespace App\Repositories;

use App\Interfaces\ShoppingCartRepositoryInterface;
use App\Models\ShoppingCart;

class ShoppingCartRepository implements ShoppingCartRepositoryInterface
{
    public function addToCart(int $userId, int $productId, int $quantity)
    {
        return ShoppingCart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }

    public function removeFromCart(int $userId, int $productId)
    {
        return ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->delete();
    }

    public function getUserCart(int $userId)
    {
        return ShoppingCart::where('user_id', $userId)->with('product')->get();
    }

    public function updateCartItem(int $userId, int $productId, int $quantity)
    {
        return ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->update(['quantity' => $quantity]);
    }
}
