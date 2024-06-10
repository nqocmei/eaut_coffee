<?php
namespace App\Repositories\Order;

interface OrderInterface{
    public function allOrder();
    public function findOrder($id);
    public function findDetailProduct($id);
    public function findUser($id);
    public function updateOrder($data, $id);
    public function getOrdersByUser($id);
    public function editOrderByUser($data);
}
