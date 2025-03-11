<?php

namespace App\Transformers;

use App\Models\State;
use League\Fractal\TransformerAbstract;

class StateTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'cities'
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
    public function transform(State $state)
    {
        return [
            'id' => $state->id,
            'name' => $state->name,
            'created_at' => $state->created_at->toIso8601String(),
        ];
    }
    public function includeCities(State $state)
    {
        return $this->collection($state->cities, new CityTransformer());
    }
}
