<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->user_type == 0 && $request->is('fruitya-admin*')) {
            abort(404);
        }else if ($user && $user->user_type == 1 && !$request->is('fruitya-admin*')) {
            abort(404);
        }

        return $next($request);
    }
}