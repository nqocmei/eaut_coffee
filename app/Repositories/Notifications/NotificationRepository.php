<?php

namespace App\Repositories\Notifications;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationRepository extends Controller implements NotificationInterface
{
    private Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function get($userId)
    {
        return $this->notification::where('user_id', $userId)
            ->orderBy('read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    public function getById($id)
    {
        return $this->notification::find($id);
    }

    public function store($data)
    {
        return $this->notification::create($data);
    }

    public function update($request)
    {
        $notification = $this->notification::find($request['id']);
        $notification->fill($request);
        $notification->save();
    }

    public function destroy($id)
    {
        $this->notification::find($id)->delete();
    }

    public function push($user_id, $notification)
    {
        event(new NotificationEvent($user_id, $notification));
    }

    public function createAndPushNotificationForUser($data)
    {
        $notification = $this->store($data);
        $data['read'] = 0;
        $data['created_at'] = $notification->created_at;
        $this->push($data['user_id'], $data);
    }

    public function createAndPushNotificationForUsers($user_ids, $notificationData)
    {
        foreach ($user_ids as $id) {
            $notificationData['user_id'] = $id;
            $notificationData['read'] = 0;
            $this->createAndPushNotificationForUser($notificationData);
        }
    }

    public function countUnreadNotifications($user_id) {
        return $this->notification::where('user_id', $user_id)->where('read', 0)->count();
    }
}
