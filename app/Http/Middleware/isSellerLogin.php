<?php

namespace App\Http\Middleware;

use Closure;

class isSellerLogin
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


        if(!session('seller_id')){
            return redirect('seller/login')->with('errors','丢失登录状态,重新登录');
        }
        return $next($request);
    }
}
