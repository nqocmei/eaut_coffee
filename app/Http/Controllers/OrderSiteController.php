<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repositories\Notifications\NotificationInterface;
use App\Repositories\Order\OrderInterface;

use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderSiteController extends Controller
{

    private $OrderRepository, $notificationRepository, $userRepository;

    public function __construct(OrderInterface $OrderRepository, NotificationInterface $notificationRepository, UserInterface $userRepository)
    {
        $this->OrderRepository = $OrderRepository;
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $orders = $this->OrderRepository->getOrdersByUser(Auth::id());

        return view('pages.order', compact('orders'));
    }

    public function showEdit(Request $requests)
    {
        $order = $this->OrderRepository->findOrder($requests->id);

        if (!$order) {
            return redirect()->route('orders.index')->with('message', ['content' => 'Không tìm thấy dữ liệu!', 'type' => 'error']);
        }

        $products = $order->orderDetails->map(function ($orderDetail) {
            return $orderDetail->product;
        });

        $orderDetails = $order->orderDetails;

        return view('pages.orderDetail', compact('order', 'orderDetails'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'recipient' => 'required|string|max:255',
            'pickup_phone' => 'string|max:255',
            'delivery_address' => 'string',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:3500',
        ]);

        $order = $this->OrderRepository->findOrder($request->id);

        if (!$order) {
            return redirect()->route('order.edit', ['id' => $request->id])->with('message', ['content' => 'Không tìm thấy dữ liệu!', 'type' => 'error']);
        }

        if ($order->status !== 0) {
            return redirect()->route('order.edit', ['id' => $request->id])->with('message', ['content' => 'Không thể cập nhật dữ liệu do đơn hàng đang chuẩn bị giao!', 'type' => 'error']);
        }

        $order->recipient = $request->recipient;
        $order->pickup_phone = $request->pickup_phone;
        $order->delivery_address = $request->delivery_address;

        $order->save();

        $notification = Notification::where('link', route('orders.edit', ['orders' => $order->id]))
            ->first();

        if (!$notification) {
            $this->notificationRepository->createAndPushNotificationForAdmin(
                [
                    'content' => "{$request->recipient} vừa cập nhật thông tin đơn hàng {$order->id}!",
                    'link' => route('orders.edit', ['orders' => $order->id]),
                    'image_path' => 'https://th.bing.com/th/id/OIP.gkWLibtMKZ3vEk2qpPgHOQHaHa?rs=1&pid=ImgDetMain',
                ]
            );
        } else {
            $notification->update([
                'read' => 0,
                'created_at' => Carbon::now(),
            ]);
            $admins = $this->userRepository->getAllAdmin();

            foreach ($admins as $admin) {
                $notification->user_id = $admin->id;
                $this->notificationRepository->push($admin->id, $notification);
            }
        }
        return redirect()->route('order.edit', ['id' => $request->id])->with('message', ['content' => 'Cập nhật thông tin thành công!', 'type' => 'success']);
    }

}
