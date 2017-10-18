<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// Input的使用
use Illuminate\Support\Facades\Input;

// 表单验证
use Illuminate\Support\Facades\Validator;

// 使用自定义Model
use App\Http\Model\user;
// 密码处理
use Illuminate\Support\Facades\Crypt;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reg()
    {
       // return 'reg';
       return view('home.reg.reg');
    }
     public function repass()
    {
       return view('home.reg.repass');
    }
    public function dorepass(Request $request)
    {
      
    $input =  $request->only("reg_pwd","user_pwd","user_repwd", "code","agree");
      // dd($input);
//        2 验证密码是否符合要求
          
        // 2.表单验证
        $rule=[     // 常用
            // 'user_name'=>'required|regex:/^\w{4,12}$/', 
            'reg_pwd'=>'required|regex:/^\w{4,12}$/',
            'user_pwd'=>'required|regex:/^\w{4,12}$/',
            'user_repwd'=>'required|same:user_pwd',
           
           
        ];
        $msg = [
            // 常用
            // 'user_name.required'=>'请输入用户名',  // 错误返回信息
            'reg_pwd.required'=>'请输入原密码',
            'user_pwd.required'=>'请输入新密码',
            'user_repwd.required'=>'请输入确认密码',
            // 'user_name.regex'=>'请输入4-12位数字,字母,下划线',
            'reg_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.same'=>'您两次输入的密码不一致',
           
        ];

//        进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
//        如果验证失败
        if ($validator->fails()) {
            return redirect('home/repass')
                ->withErrors($validator)
                ->withInput();
        }

//        3 执行修改密码操作
//          3.1 先判断原密码是否正确
           $user =  User::find(session('user_id')[0]);
           // dd();
           if($input['reg_pwd'] !=  Crypt::decrypt($user->user_pwd)){
               return redirect('home/repass')->with('errors','原密码错误')->withInput();
           }

           // 逻辑判断agree
        if($input['code'] != session('code')){
            return redirect('home/repass')->with('errors','验证码错误')->withInput();
        }
        if($input['agree'] != 'on'){
            return redirect('home/repass')->with('errors','请同意服务条款')->withInput();
        }

//         4 修改密码
           $user->user_pwd = Crypt::encrypt($input['user_pwd']);
           $re = $user->save();
            if($re){
                // return '成功';
                return redirect('home/login')->with('errors','密码修改成功');
            }else{
                // return '失败';
                return redirect('home/repass')->with('errors','密码修改失败');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doreg(Request $request)
    {
        // return 'reg';
         // 1 接受前台用户传过来的数据
          $input = $request->only('user_name','user_pwd','user_repwd','code','agree');
         
        // 2.表单验证
        $rule=[     // 常用
            'user_name'=>'required|regex:/^\w{4,12}$/', 
            'user_pwd'=>'required|regex:/^\w{4,12}$/',
            'user_repwd'=>'required|same:user_pwd',
           
           
        ];
        $msg = [
            // 常用
            'user_name.required'=>'请输入用户名',  // 错误返回信息
            'user_pwd.required'=>'请输入密码',
            'user_repwd.required'=>'请输入密码',
            'user_name.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.same'=>'您两次输入的密码不一致',
           
        ];
       
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
          // dd();
            return redirect('home/reg')  // 跳转admin/manager/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }

       // 逻辑判断agree
        if($input['code'] != session('code')){
            return redirect('home/reg')->with('errors','验证码错误')->withInput();
        }
        if($input['agree'] != 'on'){
            return redirect('home/reg')->with('errors','请同意服务条款')->withInput();
        }
// dd($input['agree']);
        // 检测该登录用户是否存在
        $user = user::where('user_name','=',$input['user_name'])->first();
            if($user){
                return redirect('home/reg')->with('errors','此用户已经存在,请更换用户名注册')->withInput();
        }

    
           $user = new user();
           $user->user_name = $input['user_name'];
           $user->user_status = 1;  //开启
           
           $user->user_pwd = Crypt::encrypt($input['user_pwd']) ;

       
        // 新数据存入
        $res = $user->save();
// dd($res);
      //  3 判断执行是否成功->with('errors','账号锁定,禁止登陆')->withInput();
      if($res){
          return redirect('home/login')->with('errors','注册成功请登录');   
      }else{
          return redirect('home/reg')->with('errors','注册失败');  
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {
         // 互殴数据
        // dd(11);
        $input = Input::except('_token');
        // 验证表单

        $rule=[
            'user_name'=>'required|between:4,12',  
            'user_pwd'=>'required|between:4,12',
        ];
        $msg = [
            'user_name.required'=>'用户名为空',  // 错误返回信息
            'user_name.between'=>'用户名为4-12位',
            'user_pwd.required'=>'密码为空入',
            'user_pwd.between'=>'密码为4-12位'
        ];
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('home/login')  // 跳转
                ->withErrors($validator)     // 返回错误
                ->withInput();               //数据闪存
        }
         // dd( $input);
        // 逻辑判断
        // if($input['code'] != session('code')){
        //     return redirect('seller/login')->with('errors','验证码错误')->withInput();
        // }

        // 检测该登录用户是否存在
        $user = user::where('user_name','=',$input['user_name'])->first();
            if(!$user){
                return redirect('home/login')->with('errors','此用户不存在')->withInput();
            }

        // 密码是否正确
        if(Crypt::decrypt($user->user_pwd) !=  $input['user_pwd']){
            return redirect('home/login')->with('errors','密码错误')->withInput();
        }
      
        // 检测是否被官方禁止登陆
        if ($user->user_status==0) {
           return redirect('home/login')->with('errors','账号锁定,禁止登陆')->withInput();
        }

        // 数据信息存入 session $seller_id 清楚其他的下线
        // $request->session()->flush();
        $user_id =  $user->user_id;
       
        // 清理之前的 seller_id
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        $request->session()->forget('user_id', $user_id);
        $request->session()->push('user_id', $user_id);
        $request->session()->push('user_name', $input['user_name']);
        // dd(session('user_name')[0]);
        // 获取测试
        // $data = $request->session()->all();
        // $data = $request->session()->get('seller_id');
        // print_r($data);  //dd阻止session写入
        return redirect("home/index");  
    }  

   
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
          // dd('login');
          // dd('login');
         return view('home.login.login');
    }
    public function loginout(Request $request)
    {
        // session()->flush(); //退出销毁对应session
        $request->session()->forget('user_id');  //  下线
        $request->session()->forget('user_name');  //  下线
        return redirect('home/login')->with('errors','退出成功');
    }

   
}
