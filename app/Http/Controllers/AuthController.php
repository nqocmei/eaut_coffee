<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function registerPage()
    {
        return view('pages.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);//mã hóa mật khẩu 
        $user->id_role = 2; // user normal
        $user->save();
        return back()->with('message', ['content' => 'Đăng kí tài khoản thành công!', 'type' => 'success']);
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credetials))  {
            return redirect('/')->with('message', ['content' => 'Đăng nhập thành công!', 'type' => 'success']);
        }

        return back()->with('message', ['content' => 'Sai tên tài khoản hoặc mật khẩu!', 'type' => 'error']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
