<?php

namespace App\Http\Middleware;

use Closure;

class isManagerLogin
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
        if(!session('manager_id')){
            return redirect('admin/login')->with('errors','丢失登录状态,重新登录');
        }
        return $next($request);
    }
}
