<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Notifications\NotificationInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $notificationRepo;

    public function __construct(NotificationInterface $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }

    public function readNotification(Request $request)
    {
        $this->notificationRepo->update($request->json()->all());
    }

    public function countUnreadNotifications(Request $request) {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $count = $this->notificationRepo->countUnreadNotifications($userId);
            return response()->json($count);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra vui lòng thử lại sau!',
            ], 500);
        }
    }

    public function getNotificationList(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $notificationList = $this->notificationRepo->get($userId);
            return response()->json($notificationList);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra vui lòng thử lại sau!',
            ], 500);
        }
    }

    public function createNotification(Request $request)
    {
        try {
            $notificationData = [
                'user_id' => $request->user_id,
                'content' => $request->notifi_content,
                'link' => $request->link,
                'image_path' => $request->image_path,
                'read' => 0
            ];
            $this->notificationRepo->createAndPushNotificationForUser($notificationData);
            return response()->json([
                'message' => 'Tạo thông báo thành công!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra vui lòng thử lại sau!',
            ], 500);
        }
    }
}
