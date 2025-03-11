<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Transformers\ProductTransformer;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return fractal(Product::all(), new ProductTransformer())->toArray();
    }

    public function createProduct(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public');
        }
        return Product::create($data);
    }
}
