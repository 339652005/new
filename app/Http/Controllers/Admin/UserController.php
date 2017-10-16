<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 补充的命名空间使用
// use App\User;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
// use DB;
// 表单验证
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    
    public function index(Request $request)
    {
        // return 'index';
        //  1.三元检测是否有搜索的关键字没有就为空 有接收
        $input = $request->input('keywords')?$request->input('keywords'):'';
        //  2.用关键字为条件查找数据库符合条件的数据  分页显示
        $user = User::orderBy('user_id','asc')->where('user_name','like','%'.$input.'%')->paginate(8);
        //  3.返回 用户列表页视图
        // dd();
        // dd( $user);
        foreach ($user as $key => $value) {
            # code...
            // dd($value->user_name);
        }
        return view('admin.user.list',compact('user','input'));
    }

    
    public function create()
    {
        return view('admin.user.add');
    }

    
    public function store(Request $request)
    {
        $input = $request->except('_token');
        
        // 2.表单验证
        $rule=[     // 常用
            'user_name'=>'required|regex:/^\w{4,12}$/', 
            'user_pwd'=>'required|regex:/^\w{4,12}$/',
            'user_repwd'=>'required|same:user_pwd',
            'user_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'user_email'=>'required|email',
            'user_status'=>'required',
            'user_auth'=>'required'
        ];
        $msg = [
            // 常用
            'user_name.required'=>'请输入用户名',  // 错误返回信息
            'user_pwd.required'=>'请输入密码',
            'user_repwd.required'=>'请输入密码',
            'user_name.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'user_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'user_email.required'=>'请输入邮箱',
            'user_tell.required'=>'请输入电话',
            'user_tell.regex'=>'手机号码输入不正确',
            'email.email'=>'邮箱输入不正确',
            // 状态权限
            'user_status.required'=>'请输入状态',
            'user_auth.required'=>'请输入权限',
        ];
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/user/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
        $user = User::where('user_name','=',$input['user_name'])->first();
        if($user){
            return back()->with('errors','用户名已经被注册')->withInput();
        }
        // 2 执行数据库添加操作（向user表添加一条记录）
           $user = new User();
           $user->user_name = $input['user_name'];
           $user->user_tell = $input['user_tell'];
           $user->user_email = $input['user_email'];
           $user->user_status = $input['user_status'];
           $user->user_auth = $input['user_auth'];
           $user->user_pwd = Crypt::encrypt($input['user_pwd']);
            // 留待补充 经验值 与积分的判断条件
           // $user->user_lasttime = time();  //最后登录时间
           // $user->user_jifen;  //购物加积分
           $re = $user->save();
          if($re){
              return redirect('admin/user');  //列表页
          }else{
              return redirect('admin/user/create')->with('msg','用户添加失败');  //添加页
          }
    }

   
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }
   
    public function update(Request $request, $id)
    {
        $input = $request->except('_token');
        $rule=[     
            'user_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'user_email'=>'required|email',
            'user_status'=>'required',
            'user_auth'=>'required'
        ];
        $msg = [
            'user_email.required'=>'请输入邮箱',
            'user_tell.required'=>'请输入电话',
            'user_tell.regex'=>'手机号码输入不正确',
            'email.email'=>'邮箱输入不正确',
            'user_status.required'=>'请输入状态',
            'user_auth.required'=>'请输入权限',
        ];
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
       
        $user = User::find($id);
        $user->user_name = $input['user_name'];
        $user->user_tell = $input['user_tell'];
        $user->user_email = $input['user_email'];
        $user->user_status = $input['user_status'];
        $user->user_auth = $input['user_auth'];
        // 留待补充 经验值 与积分的判断条件
        // $user->user_lasttime = time();  //最后登录时间
        // $user->user_jifen;  //购物加积分
        $re = $user->save();   
        if($re){;
            return redirect('admin/user');   //列表页
        }else{
            return redirect('admin/user/'.$id.'/edit')->with('msg','用户修改失败');  //返回错误信息
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //查询要删除的记录的模型
        $user = User::find($id);
        //执行删除操作
        $re = $user->delete();
        //根据返回的结果处理成功和失败
        if($re){
          $data=[
              'status'=>0,
              'msg'=>'删除成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return  $data;  
    }
    public function show($id)
    {
        // 取数据库
        $user = user::find($id);
        $status = $user->user_status;

        // 权限值得变换
        if ($status==1) {
          $status=0;
        }else{
          $status=1;
        }
        // 反向赋值
        $user->user_status = $status;
        $res = $user->save();
        //  判断执行是否成功
        if($res){
          $data=[
              'status'=>0,
              'msg'=>'状态修改成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'状态修改失败'
            ];
        }
         return  $data;    //return回去的数据ajax接收
        /*if($res){
            // return '成功';
            return redirect('admin/manager');   //列表页
        }else{
            // return '失败';
            return redirect('admin/manager')->with('msg','修改失败');  //返回错误信息
        }*/
    }


}
