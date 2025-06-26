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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = \Illuminate\Support\Facades\Http::post(env('API_BASE_URL').'/api/login', [
            'login' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();

        if ($response->ok() && isset($data['token'])) {
            // Simpan token ke session
            session(['token' => $data['token']]);
            return redirect('/');
        } else {
            return back()->withErrors(['login' => $data['message'] ?? 'Login gagal'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('token');
        $request->session()->flush();
        return redirect()->route('login');
    }
} 