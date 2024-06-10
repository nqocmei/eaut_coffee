<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Repositories\Order\OrderInterface;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    private $OrderRepository;

    public function __construct(OrderInterface $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }

    public function index()
    {
        $orders = $this->OrderRepository->allOrder();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('message', ['content' => 'Không tìm thấy dữ liệu!', 'type' => 'error']);
        }

        $products = $order->orderDetails->map(function ($orderDetail) {
            return $orderDetail->product;
        });

        $orderDetails = $order->orderDetails;
        return view('admin.orders.edit', compact('order', 'products', 'orderDetails'));
    }

    public function update($id, Request $request)
    {
        $order = Order::find($id);
        $validator = Validator::make($request->all(), [
            'delivery_date' => [
                'required',
                function ($attribute, $value, $fail) use ($order) {
                    if (Carbon::parse($value)->lessThan($order->order_date)) {
                        $fail('Ngày giao hàng dự kiến phải lớn hơn ngày đặt hàng!');
                    }
                },
            ],
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('message', ['content' => $validator->errors()->first(), 'type' => 'error'])
                ->withInput();
        }

        $validatedData = $validator->validated();
        $this->OrderRepository->updateOrder($validatedData, $id);

        return redirect()->route('orders.index')->with('message', ['content' => 'Cập nhập đơn hàng thành công!', 'type' => 'success']);
    }

}
