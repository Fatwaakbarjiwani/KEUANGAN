<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoaController extends Controller
{
    public function index()
    {
        $apiBaseUrl = env('API_BASE_URL', 'http://localhost/api/');
        $coa = [];
        // Tidak perlu ambil token dari session, data diambil via JS di client
        return view('pages.coa', compact('coa', 'apiBaseUrl'));
    }
} 