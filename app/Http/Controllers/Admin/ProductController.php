<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Controllers\Controller;

use App\Repositories\Product\ProductInterface;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->allProduct();

        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $list_categories = Categories::all();
        return view('admin.products.create', ['list_categories' => $list_categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image_path' => 'required',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
            'discount' => 'nullable',
            'promotional_price' => 'nullable|decimal:0,2',
            'amount' => 'required|numeric',
            'id_category' => 'required'
        ]);

        $imageName = time() . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('storage/images/product'), $imageName);

        $validatedData['image_path'] = 'storage/images/product/' . $imageName;

        $price = $validatedData['price'];
        $discount = $validatedData['discount'];

        $promotional_price = $price - ($price * $discount) / 100;
        $validatedData['promotional_price'] = $promotional_price;

        $this->productRepository->storeProduct($validatedData);

        return redirect()->route('product.index')->with('message', ['content' => 'Tạo sản phẩm thành công!', 'type' => 'success']);
        ;
    }

    public function edit($id)
    {
        $list_categories = Categories::all();
        $product = $this->productRepository->findProduct($id);
        return view('admin.products.edit', ['product' => $product, 'list_categories' => $list_categories]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image_path' => 'nullable',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
            'discount' => 'nullable',
            'promotional_price' => 'nullable|decimal:0,2',
            'amount' => 'required|numeric',
            'id_category' => 'required'
        ]);

        if ($request->file('image_path')) {
            $imageName = time() . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('storage/images/product'), $imageName);

            $validatedData['image_path'] = 'storage/images/product/' . $imageName;

        } else {
            $imageUrl = $request->image_path_old;
            $validatedData['image_path'] = $imageUrl;
        }

        $price = $validatedData['price'];
        $discount = $validatedData['discount'];

        $validatedData['promotional_price'] = $price - ($price * $discount) / 100;

        $this->productRepository->updateProduct($validatedData, $id);

        return redirect()->route('product.index')->with('message', ['content' => 'Cập nhập sản phẩm thành công!', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);

        return redirect()->route('product.index')->with('message', ['content' => 'Xóa sản phẩm thành công!', 'type' => 'success']);
    }

}
