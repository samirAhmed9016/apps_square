<?php

namespace App\Transformers;

use App\Models\ShoppingCart;
use League\Fractal\TransformerAbstract;

class ShoppingCartTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ShoppingCart $cartItem)
    {
        return [
            'id' => $cartItem->id,
            'product' => [
                'id' => $cartItem->product->id,
                'name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'image' => asset('storage/' . $cartItem->product->image),
            ],
            'quantity' => $cartItem->quantity,
            'total_price' => $cartItem->quantity * $cartItem->product->price,
        ];
    }

    /**
     * Transform a collection of cart items and include total cart price.
     */
    public static function transformCollection($cartItems)
    {
        $transformedItems = $cartItems->map(function ($item) {
            return (new self())->transform($item);
        });

        $totalCartPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return [
            'cart_items' => $transformedItems,
            'total_cart_price' => $totalCartPrice,
        ];
    }





    // /**
    //  * List of resources to automatically include
    //  *
    //  * @var array
    //  */
    // protected array $defaultIncludes = [
    //     //
    // ];

    // /**
    //  * List of resources possible to include
    //  *
    //  * @var array
    //  */
    // protected array $availableIncludes = [
    //     //
    // ];

    // /**
    //  * A Fractal transformer.
    //  *
    //  * @return array
    //  */
    // public function transform(ShoppingCart $cartItem)
    // {
    //     return [
    //         'id' => $cartItem->id,
    //         'product' => [
    //             'id' => $cartItem->product->id,
    //             'name' => $cartItem->product->name,
    //             'price' => $cartItem->product->price,
    //             'image' => asset('storage/' . $cartItem->product->image),
    //         ],
    //         'quantity' => $cartItem->quantity,
    //         'total_price' => $cartItem->quantity * $cartItem->product->price,
    //     ];
    // }
}
