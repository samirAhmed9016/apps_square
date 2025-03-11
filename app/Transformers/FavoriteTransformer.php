<?php

namespace App\Transformers;

use App\Models\Favorite;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class FavoriteTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Favorite $favorite)
    {
        return [
            'id' => $favorite->id,
            'product' => [
                'id' => $favorite->product->id,
                'name' => $favorite->product->name,
                'price' => $favorite->product->price,
                'image' => asset('storage/' . $favorite->product->image),
            ],
        ];
    }
}
