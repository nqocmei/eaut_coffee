<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
use App\Models\Comment;
class ProductSiteController extends Controller
{
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $randoms = Product::inRandomOrder()->take(4)->get();
        $comments = Comment::where('product_id', $product->id)->orderBy('created_at', 'desc')->get();
        return view('pages.detail', ['product' => $product, 'randoms' => $randoms, "comments" => $comments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'username' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
        ]);

        Comment::create([
            'product_id' => $request->input('product_id'),
            'username' => $request->input('username'),
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);
        return redirect()->back()->with('message', ['content' => 'Bình luận đã được gửi.', 'type' => 'success']);
    }
}
