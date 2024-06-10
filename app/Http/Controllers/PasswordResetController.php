<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    public function showEmailForm()
    {
        return view('pages.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('message', ['content' => 'Email không tồn tại.', 'type' => 'error']);
        }

        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Debug giá trị token và email
        if (is_null($token)) {
            return back()->with('message', ['content' => 'Không tạo được mã thông báo.', 'type' => 'error']);
        }

        if (is_null($request->email)) {
            return back()->with('message', ['content' => 'Email trống.', 'type' => 'warning']);
        }

        // Gửi email reset password
        try {
            Mail::send('pages.email_content', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Reset Request');
            });
        } catch (\Exception $e) {
            return back()->with('message', ['content' => 'Không gửi được email.', 'type' => 'error']);
        }
        return back()->with('message', ['content' => 'Chúng tôi đã gửi email liên kết đặt lại mật khẩu của bạn!', 'type' => 'success']);
    }

    public function showResetForm($token)
    {
        return view('pages.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        Log::info('Start resetPassword method');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:1',
            'token' => 'required'
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();
        Log::info('Password reset token retrieved: ' . print_r($passwordReset, true));

        if (!$passwordReset || $passwordReset->email !== $request->email) {
            Log::info('Invalid token or email.');

            return back()->with('message', ['content' => 'Mã thông báo hoặc email không hợp lệ.', 'type' => 'error']);

        }

        $user = User::where('email', $request->email)->first();
        Log::info('User found: ' . print_r($user, true));

        if (!$user) {
            Log::info('Email does not exist.');
            return back()->with('message', ['content' => 'Email không tồn tại.', 'type' => 'error']);
        }

        // Cập nhật mật khẩu mới cho người dùng
        $user->password = Hash::make($request->password);
        $user->save();

        Log::info('Password updated successfully.');

        // Xóa bản ghi reset password
        DB::table('password_resets')->where('email', $request->email)->delete();
        Log::info('Password reset record deleted.');

        Log::info('End resetPassword method');

        return redirect('/login')->with('message', ['content' => 'Mật khẩu đã được đặt lại!', 'type' => 'success']);

    }
}
