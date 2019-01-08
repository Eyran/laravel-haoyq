<?php

namespace App\Http\Middleware;

use Closure;

class BrowseLog
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
        $log = new \App\Models\BrowseLog();

        $log->ip_addr = $request->getClientIp();
        $log->request_url = $request->path();
        $log->city_name = get_city_by_ip(false, 'null');

        $log->save();

        return $next($request);
    }
}
