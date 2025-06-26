<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PeriodeController extends Controller
{
    public function index()
    {
        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $response = Http::withToken($token)->get($apiBaseUrl.'/api/periode');
        $periode = $response->ok() ? ($response->json('data') ?? []) : [];
        return view('pages.settingPeriode', compact('periode', 'apiBaseUrl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required',
        ]);

        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $body = [
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ];
        $response = \Illuminate\Support\Facades\Http::withToken($token)
            ->post($apiBaseUrl.'/api/periode', $body);

        if ($response->ok()) {
            $msg = $response->json('message') ?? 'Periode berhasil ditambahkan!';
            return redirect()->route('settingPeriode')->with('success', $msg);
        } else {
            $msg = $response->json('message') ?? 'Gagal menambah periode baru.';
            return redirect()->route('settingPeriode')->with('error', $msg);
        }
    }

    // API Proxy methods untuk JavaScript
    public function getPeriodeById($id)
    {
        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        
        // Debug logging
        Log::info('getPeriodeById called with ID: ' . $id);
        Log::info('Token: ' . ($token ? 'exists' : 'missing'));
        Log::info('API Base URL: ' . $apiBaseUrl);
        
        $response = Http::withToken($token)->get($apiBaseUrl.'/api/periode/'.$id);
        
        Log::info('API Response status: ' . $response->status());
        Log::info('API Response body: ' . $response->body());
        
        return response()->json($response->json(), $response->status());
    }

    public function updatePeriode(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required',
        ]);

        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $body = [
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ];
        
        $response = Http::withToken($token)
            ->put($apiBaseUrl.'/api/periode/'.$id, $body);
        
        return response()->json($response->json(), $response->status());
    }

    public function deletePeriode($id)
    {
        $token = session('token');
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $response = Http::withToken($token)->delete($apiBaseUrl.'/api/periode/'.$id);
        
        return response()->json($response->json(), $response->status());
    }
} 