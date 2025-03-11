<?php

namespace App\Transformers;

use App\Models\UserLocation;
use League\Fractal\TransformerAbstract;

class UserLocationTransformer extends TransformerAbstract
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
    public function transform(UserLocation $userLocation)
    {
        return [
            'id' => $userLocation->id,
            'user_id' => $userLocation->user_id,
            'state' => [
                'id' => $userLocation->state->id,
                'name' => $userLocation->state->name,
            ],
            'city' => [
                'id' => $userLocation->city->id,
                'name' => $userLocation->city->name,
            ],
            'created_at' => $userLocation->created_at->toIso8601String(),
        ];
    }
}
