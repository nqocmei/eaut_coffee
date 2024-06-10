<?php
namespace App\Repositories\Cart;

interface CartInterface
{
    public function store($data);
    public function getCartByUser($id);
    public function totalCartByUser($id);
}

