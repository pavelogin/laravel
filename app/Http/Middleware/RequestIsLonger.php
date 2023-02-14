<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestIsLonger
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $seconds = microtime(true) - $start;
        if ($seconds > 1) {
            logger()->channel('telegram')->debug('Longer request by url - ' . $request->fullUrl() . ' (Seconds: ' . $seconds . ').');
        }


        return $response;
    }
}
