<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return fractal(Category::all(), new CategoryTransformer())->toArray();
    }

    public function createCategory(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('categories', 'public');
        }
        return Category::create($data);
    }
}
