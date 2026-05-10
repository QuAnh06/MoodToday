<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        // 2. Thử đăng nhập (Auth::attempt sẽ tự kiểm tra mật khẩu đã hash)
        // 'remember' giúp lưu phiên đăng nhập nếu bạn có checkbox
        if (Auth::attempt($credentials, $request->remember)) {
            
            if (Auth::user()->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Tài khoản của bạn đang bị khóa.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->with(
            'error', 'Thông tin đăng nhập không chính xác.',
        );
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255|unique:users,id', 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'status' => 'active',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, mời bạn đăng nhập!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}