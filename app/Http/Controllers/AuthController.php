<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $data = $request->only('npm', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Berhasil Login');
        } else {
            return redirect()->back()->with('failed', 'Npm atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin')->with('success', 'Berhasil logout');
    }
}