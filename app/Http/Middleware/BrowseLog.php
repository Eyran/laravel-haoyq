<?php

namespace App\Http\Middleware;

use App\Events\UserBrowse;
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
        // 使用事件/监听器入库
        event(new UserBrowse($request->getClientIp(), $request->path(), get_city_by_ip(false, 'null')));

        return $next($request);
    }
}
