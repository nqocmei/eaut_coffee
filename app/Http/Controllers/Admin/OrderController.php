<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Repositories\Order\OrderInterface;
use App\Repositories\Notifications\NotificationInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    private $orderRepository, $notificationRepository;

    public function __construct(OrderInterface $orderRepository, NotificationInterface $notificationRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->allOrder();
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
        $this->orderRepository->updateOrder($validatedData, $id);

        $this->notificationRepository->createAndPushNotificationForUser(
            [
                'user_id' => $order->id_user,
                'content' => "Quản trị viên vừa cập nhật thông tin đơn hàng {$order->id}!",
                'link' => route('order.edit', ['id' => $order->id]),
                'image_path' => 'https://th.bing.com/th/id/OIP.gkWLibtMKZ3vEk2qpPgHOQHaHa?rs=1&pid=ImgDetMain',
                'read' => 0
            ]
        );

        return redirect()->route('orders.index')->with('message', ['content' => 'Cập nhập đơn hàng thành công!', 'type' => 'success']);
    }

}
