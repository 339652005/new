<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class hasRole
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
//        1 获取当前请求的路由对应的控制器的方法名
        $route = \Route::current()->getActionName();
        //dd($route);
//        2 获取当前用户
        $user_id = session('user')->user_id;
        //dd($user_id);
//        3 获取当前用户的权限
//          3.1 先获取用户的角色
//          3.2 根据角色获取权限
//        用户===》角色====》权限
        //获取当前用户的角色
        $roles =  User::find($user_id)->roles;
        //dd($roles);

         //$roles =    $user->roles;
         //$roles =    $user->roles()->get();
         //dd($roles);

//         声明一个空数组，存放所有的权限，通过判断$route在没有所有权限对应的数组，就可以知道用户是否有这条路由对应的权限
        $arr = array();



//         2.3 获取角色对应的权限
        foreach ($roles as $k=>$role){
            //每次遍历获取一个角色，然后获取这个角色对应的权限
            //dd($role);
            $pers =  $role->permissions()->get();
            //($pers);
//           遍历当前角色对应的权限
            foreach ($pers as $m=>$per){
//                将这个权限写入arr数组
//                dd($per);
//                获取当前权限模型的description属性
                $arr[] = $per->permission_name;

            }
        }
//        去掉arr数组中重复的权限a
        $newarr = array_unique($arr);
//        dd($newarr);



//    3 判断当前路由对应的控制器的方法是否在用户对应的权限中，如果在就放行，如果不在提示没有权限
        if(in_array($route,$newarr)){
            return $next($request);
        }else{
            return redirect('admin/nopermission');
        }







/*
//        4 判断当前用户是否具有当前请求的路由的权限
//         如果用户具有此条路由执行权，就放行执行这条路由对应的控制器方法；如果没有权限，给用户一个没有权限的提示页面
         if(in_array(当前请求的路由,用户具有的权限路由)){
             return $next($request);
         }else{
             return redirect('admin/nopermission');
         }*/

    }
}
