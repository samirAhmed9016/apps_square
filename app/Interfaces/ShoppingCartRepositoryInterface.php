<?php


namespace App\Interfaces;

interface ShoppingCartRepositoryInterface
{
    public function addToCart(int $userId, int $productId, int $quantity);
    public function removeFromCart(int $userId, int $productId);
    public function getUserCart(int $userId);
    public function updateCartItem(int $userId, int $productId, int $quantity);
}
