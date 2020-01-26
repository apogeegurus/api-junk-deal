<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $request->header('authorization');
        $envKey = env('API_KEY');

        if(empty($key) || !Hash::check($envKey, $key))
            return response()->json(['message' => 'forbidden']);


        return $next($request);
    }
}
