<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 补充的命名空间使用
// use App\Users;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
// use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return 'index';
        //  1.三元检测是否有搜索的关键字没有就为空 有接收
        $input = $request->input('keywords')?$request->input('keywords'):'';
        //  2.用关键字为条件查找数据库符合条件的数据  分页显示
        $user = User::orderBy('user_id','asc')->where('user_name','like','%'.$input.'%')->paginate(5);
        //  3.返回 用户列表页视图
        return view('admin.user.list',compact('user','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1 接受前台用户传过来的数据
          $input = $request->except('_token');
          //dd($input);
        // 2 执行数据库添加操作（向user表添加一条记录）
           $user = new User();
           $user->user_name = $input['user_name'];
           $user->user_tell = $input['user_tell'];
           $user->user_email = $input['user_email'];
           $user->user_status = $input['user_status'];
           $user->user_lasttime = time();
           //$user->user_auth = $input['user_auth'];
           $user->user_pwd = Crypt::encrypt($input['user_pwd']) ;
           $re = $user->save();
          if($re){
              //return '成功';
              return redirect('admin/user');  //列表页
          }else{
              //return '失败';
              return redirect('admin/user/create')->with('msg','用户添加失败');  //添加页
          }

          //补充表单验证
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'index';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return 'index';
        $user = User::find($id);
// dd($manager);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return 'index';
        $input = $request->except('_token','_method');
        $user = User::find($id);
        $user->user_name = $input['user_name'];
        $user->user_tell = $input['user_tell'];
        $user->user_email = $input['user_email'];
        $user->user_status = $input['user_status'];
        $re = $user->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
            return redirect('admin/user');   //列表页
        }else{
            // return '失败';
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
}
