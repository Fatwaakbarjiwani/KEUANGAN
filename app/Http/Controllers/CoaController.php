<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoaController extends Controller
{
    public function index()
    {
        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $response = Http::withToken($token)->get($apiBaseUrl.'/api/coa');
        // Log::info('COA API Bearer token: ' . $token);
        // Log::info('COA API status: ' . $response->status());
        // Log::info('COA API response: ', is_array($response->json()) ? $response->json() : [$response->json()]);
        $coa = $response->ok() ? $response->json() : [];
        return view('pages.coa', compact('coa', 'apiBaseUrl', 'token'));
    }
} 