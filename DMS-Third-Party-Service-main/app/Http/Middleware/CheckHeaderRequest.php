<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHeaderRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->headers->has('apikey')){
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Invalid request !!'
                ]
            ], 400);
        }

        return $next($request);
    }

}
