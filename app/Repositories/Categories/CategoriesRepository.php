<?php

namespace App\Repositories\Categories;

use App\Models\Categories;

class CategoriesRepository implements CategoriesInterface
{
    public function getAllCategories()
    {
        return Categories::all();
    }

    public function storeCategories($data)
    {
        return Categories::create($data);
    }

    public function findCategoriesById($id)
    {
        return Categories::find($id);
    }

    public function updateCategories($data, $id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function deleteCategories($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }
}
