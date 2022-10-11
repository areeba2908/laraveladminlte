<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if ( !($request->expectsJson())) {
            //$request->session()->flash('error', 'Error message!');
            return route('login');
        }



    }

    protected function unauthenticated($request, array $guards)
    {

        return response()->json([
            'status'    =>  414,
            'message'   =>  'authentication error',
            'body'      =>  [],
            'exception' =>  []
        ], 414, [], JSON_UNESCAPED_UNICODE );
    }
}
