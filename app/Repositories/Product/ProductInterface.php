<?php
namespace App\Repositories\Product;

interface ProductInterface
{
    public function allProduct();

    public function getProductForHome();

    public function getProductByCategory($category);

    public function storeProduct($data);

    public function findProduct($id);

    public function updateProduct($request, $id);

    public function deleteProduct($id);

    public function relatedProduct();

    public function searchProduct($data);

    public function viewAllWithPagination();
}
