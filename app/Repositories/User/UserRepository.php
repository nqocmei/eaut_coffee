<?php
namespace App\Repositories\User;

use App\Models\User;
use Auth;

class UserRepository implements UserInterface
{
    public function update($request)
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->back()->with('message', ['content' => 'Không tìm thấy user!', 'type' => 'error']);
        }
        if ($user->email == $request->email) {
            return redirect()->back()->with('message', ['content' => 'Bạn không thể thay đổi email!', 'type' => 'error']);
        }
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            if (!empty($user->avatar)) {
                $oldImagePath = public_path($user->avatar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = md5(rand() . time()) . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('storage/images/users'), $imageName);
            $user->avatar = 'storage/images/users/' . $imageName;
        }

        $user->save();
    }

    public function getAllUser()
    {
        return User::orderBy('created_at', 'desc')->paginate(10);
    }

    public function searchUser($data)
    {
        $searchKeyword = $data->input('keyword');

        return User::where(function ($query) use ($searchKeyword) {
            $query->where('fullname', 'like', '%' . $searchKeyword . '%')
                ->orWhere('email', 'like', '%' . $searchKeyword . '%')
                ->orWhere('phone', 'like', '%' . $searchKeyword . '%')
                ->orWhere('address', 'like', '%' . $searchKeyword . '%');
        })->paginate(5);
    }

    public function getAllAdmin() {
        return User::where('id_role', 1)->get();
    }
}
