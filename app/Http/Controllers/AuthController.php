<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(Request $request){
        // Validate
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Thêm tài khoản
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_USER,
        ]);
        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

}
