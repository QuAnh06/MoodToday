<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $dataLogin = $request->validate([
            'zalo_id' => 'required|string|exists:users,zalo_id',
        ]);

        $user = User::where('zalo_id', $dataLogin['zalo_id'])->first();

        if (!$user || $user->status !== 'active') {
            return back()->withErrors(['zalo_id' => 'Tài khoản không hợp lệ hoặc đã bị khóa.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'zalo_id' => 'required|string|max:255|unique:users,zalo_id',
            'name' => 'required|string|max:255',
        ]);

        User::create([
            'zalo_id' => $request->zalo_id,
            'name' => $request->name,
            'avatar' => null,
            'status' => 'active',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, mời bạn đăng nhập!');
    }

    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }    

}
