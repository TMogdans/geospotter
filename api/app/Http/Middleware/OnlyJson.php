<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class OnlyJson
{

    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('Content-Type') == 'application/json' ||
            !$request->header('Accept') == 'application/json') {
            return response('Forbidden.', 403);
        }

        return $next($request);
    }
}