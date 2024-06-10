<?php

namespace App\Repositories\Cart;

use App\Models\Cart;

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
}
