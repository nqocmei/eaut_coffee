<?php
namespace App\Repositories\Categories;

interface CategoriesInterface
{
    public function getAllCategories();
    public function storeCategories($data);
    public function findCategoriesById($id);
    public function updateCategories($data, $id);
    public function deleteCategories($id);
}

