<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class DetailController extends Controller
{
    
    
     //详情
        function detail(Request $request)
        {
            // 获取session里的id
            $user_id = $request->session('user_id')->get('user_id');
            // 获取订单
            $orders = DB::table('dc_orders')->orderby('order_time','desc')->where('user_id',$user_id)->get();
           
            return view('home.detail.detail',compact( 'orders')); 
        }

       
           
            
            
         
        

}
