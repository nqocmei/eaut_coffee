<?php
namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function allProduct()
    {
        return Product::paginate(10);
    }

    public function getProductForHome()
    {
        return Product::orderBy('created_at', 'desc')->take(20)->get();
    }

    public function getProductByCategory($category)
    {
        return Product::where('id_category', $category)->paginate(10);
    }

    public function storeProduct($data)
    {
        Product::create($data);
    }

    public function findProduct($id)
    {
        return Product::where('id', $id)->first();
    }

    public function updateProduct($data, $id)
    {
        $this->findProduct($id)->update($data);
    }

    public function deleteProduct($id)
    {
        $this->findProduct($id)->delete();
    }

    public function relatedProduct()
    {
        return Product::orderBy('id', 'desc')->take(10)->get();
    }

    public function searchProduct($data)
    {
        $searchKeyword = $data->input('keyword');
        return Product::where('name', 'like', '%' . $searchKeyword . '%')->paginate(5);
    }

    public function viewAllWithPagination()
    {
        return Product::paginate(10);
    }
}
