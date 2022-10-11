<?php

namespace App\Http\Middleware;

use Closure;

class ForceJsonResponse
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
        if ($request->cookie('accessToken')) {
            $request->headers->set('Authorization', "Bearer " . $request->cookie('accessToken'));
            $request->headers->set('Accept', 'application/json,*/*');
            $request->headers->set('content-type', 'application/json');
            return $next($request);
        }
    }
}
