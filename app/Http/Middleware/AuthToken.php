<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Guest;
use App\Models\TokenGuest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        TokenGuest::query()->where('created_at', '<=', now()->subHours(1));
        
        if(!$request->bearerToken()){
            return response()->json([
                'status' => 'unauthenticated',
                'message' => 'Missing token'
            ], 401);
        }

        $guest = Guest::getUser();
        if(!$guest){
            return response()->json([
                'status' => 'unauthenticated',
                'message' => 'Invalid token'
            ], 401);
        }

        return $next($request);
    }
}
