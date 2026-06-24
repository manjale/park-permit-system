<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user=$request->user();
        $role = $user->role;
        if(!$user || !in_array($role,$roles)){
            return response()->json(['message'=>'unauthorised'],401);
        }

    
        return $next($request);
    }
}
