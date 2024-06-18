<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $user->password = Hash::make($request->password);
        $user->id_role = 2; // user normal
        $user->save();
        return back()->with('message', ['content' => 'Đăng kí tài khoản thành công!', 'type' => 'success']);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            try {
                $user = User::find(Auth::id());
                $sessionLifetime = config('session.lifetime');
                $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes($sessionLifetime)->timestamp]);

                $user->update([
                    'api_token' => $token,
                ]);

                return redirect('/')->with('message', ['content' => 'Đăng nhập thành công!', 'type' => 'success'])
                    ->with('token', $token);
            } catch (\Exception $e) {
                return back()->with('message', ['content' => 'Không thể tạo token', 'type' => 'error']);
            }
        }

        return back()->with('message', ['content' => 'Sai tên tài khoản hoặc mật khẩu!', 'type' => 'error']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
