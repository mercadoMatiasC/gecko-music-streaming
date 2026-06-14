<?php

namespace App\Http\Middleware;

use App\Exceptions\BusinessException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin {
    public function handle(Request $request, Closure $next): Response {
        if (!Auth::check() || !Auth::user()->isAdmin())
            throw new BusinessException("You are not allowed to perform the requested action.", 403);

        return $next($request);
    }
}