<?php
namespace App\Repositories\Order;

use App\Models\Order;

use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface{

    public function allOrder(){
        return Order::orderBy('id', 'desc')->paginate(10);
    }
    public function findOrder($id){
        return Order::where('id', $id)->first();
    }
    public function findDetailProduct($id){
        return DB::table('order_detail')
            ->join('order', 'order_detail.id_order', '=', 'order.id')
            ->select('order_detail.*')
            ->where('order.id', $id)
            ->get();
    }
    public function findUser($id){
        return DB::table('user')
            ->join('order', 'user.id', '=', 'order.id_user')
            ->select('user.*')
            ->where('order.id', $id)
            ->get();
    }
    public function updateOrder($data, $id){
        $this->findOrder($id)->update($data);
    }

    public function getOrdersByUser($id) {
        return Order::where('id_user', $id)->orderBy('id', 'desc')->paginate(10);
    }

    public function editOrderByUser($data) {
        return Order::where('id', $data['id'])->update($data);
    }

}
