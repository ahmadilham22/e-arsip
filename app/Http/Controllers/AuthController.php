<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'npm' => 'required',
            'password' => 'required',
        ]);
        $data = $request->only('npm', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Berhasil Login');
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Email atau password salah']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Alert::success('Congrats', 'You\'ve Successfully Logout');
        return redirect()->route('signin')->with('success', 'Berhasil logout');
    }
}
