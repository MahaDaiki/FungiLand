<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserMatch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
          
            $authenticatedUserId = Auth::id();
          
            $userId = $request->route('userid') ?? $request->route('user')->id;
          
            if ($authenticatedUserId != $userId) {
                
                abort(403);
            }
        } else {
        
            abort(401);
        }


        return $next($request);
    }
}
