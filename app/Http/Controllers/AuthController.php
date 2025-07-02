<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        return view('pages.login', compact('apiBaseUrl'));
    }

    public function submitLogin(Request $request)
    {
        // Tidak digunakan lagi, login via JS
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // Tidak perlu hapus session token, cukup redirect ke login
        return redirect()->route('login');
    }
} 