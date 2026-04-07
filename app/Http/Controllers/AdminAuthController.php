<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = AdminUser::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            // Lưu session admin
            session(['admin_id' => $admin->id, 'admin_role' => $admin->role]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không đúng.']);
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_role']);
        return redirect()->route('admin.login');
    }
}