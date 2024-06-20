<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && (auth()->user()->isAdmin() || auth()->user()->isManager())) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}

