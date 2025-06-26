<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Middleware global: redirect ke login jika tidak ada token, kecuali untuk route tertentu
        \Illuminate\Support\Facades\Route::matched(function ($event) {
            $request = request();
            $exceptRoutes = [
                'login', 'login.submit', 'logout', 'logout.submit', 'debug', 'debug.session', // tambahkan nama route lain jika perlu
            ];
            if (!in_array(Route::currentRouteName(), $exceptRoutes) && !session('token')) {
                abort(redirect()->route('login'));
            }
        });
    }
}
