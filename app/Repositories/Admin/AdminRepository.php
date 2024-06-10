<?php
namespace App\Repositories\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminRepository implements AdminInterface
{

    public function signIn($data)
    {
        $credetials = [
            'email' => $data->email,
            'password' => $data->password
        ];

        if (Auth::attempt($credetials)) {
            return redirect('/dashboard');
        }

        return back()->with('thongbao', 'Sai tên tài khoản hoặc mật khẩu');

    }
    public function logOut()
    {
        Auth::logout();
        return redirect('/admin');
    }

    public function searchProduct($data)
    {
        $searchKeyword = $data->input('keyword');
        return Product::where('name', 'like', '%' . $searchKeyword . '%')->paginate(5);
    }

    public function totalsCustomer()
    {
        return User::where('id_role', 2)->count();
    }

    public function totalsOrders()
    {
        return Order::count();
    }
    public function totalsMoney()
    {
        return DB::table('order_detail')
            ->join('order', 'order_detail.id_order', '=', 'order.id')
            ->where('order.status', 3)
            ->sum(DB::raw('order.total_funds'));
    }

    public function totalsSaleProducts()
    {
        return DB::table('order_detail')
            ->join('order', 'order_detail.id_order', '=', 'order.id')
            ->where('order.status', 3)
            ->sum('order_detail.quantity');
    }


}
