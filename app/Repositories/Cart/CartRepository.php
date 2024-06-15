<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface
{

    public function store($data)
    {
        return Cart::create($data);
    }

    public function getCartByUser($id)
    {
        return Cart::where('id_user', $id)->get();
    }

    public function totalCartByUser($id)
    {
        $cart = Cart::where('id_user', $id)->get();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->quantity * $item->product->promotional_price;
        }
        return $total;
    }

    public function deleteProductFromCart($product_id)
    {
        if (Auth::check()) {
            $cart = Cart::where('id_user', Auth::id())->where('id_product', $product_id)->first();
            if (!$cart) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'], 404);
            }
            $cart->delete();

            $totalCart = $this->totalCartByUser(Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!',
                'totalCart' => number_format($totalCart, 0, ',', '.') . 'đ',
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Bạn phải đăng nhập để sử dụng chức năng này!'], 401);
        }
    }
}
