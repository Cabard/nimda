<?php


namespace Cabard\Nimda\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Посредник запроса, проверят существование бота
 * Class AccessToBot
 * @package Cabard\Netbot\Http\Middleware
 */
class AdminAuthenticated
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::guard('nimda')->user()) {
            return $next($request);
        }
        if ($request->ajax() || $request->wantsJson()) {
            dd('NE ZALOGINEN');
            return response('Unauthorized.', 401);
        } else {
            dd('NE ZALOGINEN');
            return redirect(route('nimda.adminLogin'));
        }
    }
}
