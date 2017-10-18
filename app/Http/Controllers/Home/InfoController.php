<?php
 
namespace App\Http\Controllers\Home;
use DB;
// use user;
use Illuminate\Http\Request;
use Cart;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
// 表单验证
use Illuminate\Support\Facades\Validator;
class InfoController extends Controller
{
    public function userinfo()
    {
    	$user_id = session('user_id')[0];
        $user = user::find($user_id);
        
        return view('home.userinfo.info',compact('user')); 
    }  
    public function changeUserInfo(  Request  $request)
    {
    		// return '修改信息';
           $input = $request->only('user_name','user_tell','user_email');
           // dd($input);
        // 2.表单验证
        $rule=[     // 常用
            'user_name'=>'required|regex:/^\w{4,12}$/', 
            //'seller_pwd'=>'required|regex:/^\w{4,12}$/',
           // 'seller_repwd'=>'required|same:seller_pwd',
            'user_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'user_email'=>'required|email',
            //'seller_status'=>'required'
        ];
        $msg = [
            // 常用
            'user_name.required'=>'请输入用户名',  // 错误返回信息
            //'seller_pwd.required'=>'请输入密码',
           // 'seller_repwd.required'=>'请输入密码',
            'user_name.regex'=>'请输入4-12位数字,字母,下划线',
           // 'seller_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            //'seller_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'user_email.required'=>'请输入邮箱',
            'user_tell.required'=>'请输入电话',
            'user_tell.regex'=>'手机号码输入不正确',
            'user_email.email'=>'邮箱输入不正确',
            // 状态权限
           //'seller_status.required'=>'请输入状态'
        ];
         // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/user/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
        // // 检测该登录用户是否存在
        // $seller = seller::where('seller_name','=',$input['seller_name'])->get();
        // foreach ($seller as $key => $value) {
        //     //  存在// print_r($value->seller_id); 
        //     if(!empty($value) && ($value->seller_id!=$id)){
        //         return back()->with('errors','用户名已经存在');
        //     }
        // }
        $sellers = user_name::find($id);
           $users->user_tell = $input['user_tell'];
           $users->user_email = $input['user_email'];
           $users->user_name = $input['user_name'];
           // $sellers->seller_status = $input['seller_status'];
           // $sellers->seller_pwd = Crypt::encrypt($input['seller_pwd']);users
        $re = $users->save();  
        if($re){
            return redirect('home/userinfo')->with('errors','信息更新成功'); 
        }else{
            return back()->with('errors','更新失败');  
        }
    }    
       
}
   
