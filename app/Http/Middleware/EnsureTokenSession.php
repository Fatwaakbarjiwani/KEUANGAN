<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $exceptRoutes = [
            'login', 'login.submit', 'logout', 'logout.submit', 'debug', 'debug.session'
        ];
        $routeName = $request->route() ? $request->route()->getName() : null;
        if (!in_array($routeName, $exceptRoutes) && !session('token')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
