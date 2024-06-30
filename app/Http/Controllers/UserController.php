<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|string|max:255',
            'address' => 'string|max:255',
            'phone' => 'string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:3500',
        ]);

        $this->userRepository->update($request);
        return redirect()->back()->with('message', ['content' => 'Cập nhập hồ sơ thành công!', 'type' => 'success']);
    }

    public function getAllUser(Request $request)
    {
        $users = $this->userRepository->getAllUser();
        return view('admin.users.index', [
            'users' => $users,
            'isSearch' => false,
        ]);
    }

    public function searchUsers(Request $request)
    {
        $users = $this->userRepository->searchUser($request);
        return view('admin.users.index', [
            'users' => $users,
            'keyword' => $request->input('keyword'),
            'isSearch' => true,
        ]);
    }
}
