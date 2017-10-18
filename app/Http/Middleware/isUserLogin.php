<?php

namespace App\Http\Middleware;

use Closure;

class isUserLogin
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

        
        if(!session('user_id')){
            return redirect('home/login')->with('errors','请重新登录');
        }
        return $next($request);
    }
}
