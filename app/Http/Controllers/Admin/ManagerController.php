<?php 
  
namespace App\Http\Controllers\Admin;

use App\Http\Model\Manager;
use Illuminate\Http\Request;

use App\Http\Requests; 

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
// 表单验证
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Session;
class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // 1.限定数据为当前用户
      $data = $request->session()->get('manager_id');
      $self_id = $data[0];
      $self = Manager::where('manager_id',$self_id)->first();
      // dd($request->session()->all());
      $input = $request->input('keywords')?$request->input('keywords'):'';
      $manager = Manager::orderBy('manager_id','asc')->where('manager_name','like','%'.$input.'%')->paginate(6);

        /*foreach ($manager as $key => $value) {
          // dd( $value->manager_name);
        }*/

        return view('admin.manager.list',compact('manager','input','self'));
    }

    
    public function create(Request $request)
    {
      // 1.当前用户
      $data = $request->session()->get('manager_id');
      $self_id = $data[0];
      $self = Manager::where('manager_id',$self_id)->first();
     
      return view('admin.manager.add',compact('self'));
    }

   
    public function store(Request $request)
    {
          // 1 接受前台用户传过来的数据
          $input = $request->except('_token');
          
        // 2.表单验证
        $rule=[     // 常用
            'manager_name'=>'required|regex:/^\w{4,12}$/', 
            'manager_pwd'=>'required|regex:/^\w{4,12}$/',
            'manager_repwd'=>'required|same:manager_pwd',
            'manager_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'manager_email'=>'required|email',
            'manager_status'=>'required',
            'manager_auth'=>'required'
        ];
        $msg = [
            // 常用
            'manager_name.required'=>'请输入用户名',  // 错误返回信息
            'manager_pwd.required'=>'请输入密码',
            'manager_repwd.required'=>'请输入密码',
            'manager_name.regex'=>'请输入4-12位数字,字母,下划线',
            'manager_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'manager_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'manager_email.required'=>'请输入邮箱',
            'manager_tell.required'=>'请输入电话',
            'manager_tell.regex'=>'手机号码输入不正确',
            'manager_email.email'=>'邮箱输入不正确',
            // 状态权限
            'manager_status.required'=>'请输入状态',
            'manager_auth.required'=>'请输入权限',

        ];

      
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
          // dd();
            return redirect('admin/manager/create')  // 跳转admin/manager/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }

        // 检测该登录用户是否存在
        $manager = Manager::where('manager_name','=',$input['manager_name'])->first();

       //  存在
        if($manager){
            return redirect('admin/manager/create')->with('errors','用户名已经被注册')->withInput();
        }
        // 执行数据库添加操作（向user表添加一条记录）
          // 第一种添加方式（创建一个空模型，给模型的属性赋值，然后执行save方法）
           $manager = new Manager();
           $manager->manager_name = $input['manager_name'];
           $manager->manager_tell = $input['manager_tell'];
           $manager->manager_email = $input['manager_email'];
           $manager->manager_status = $input['manager_status'];
           $manager->manager_auth = $input['manager_auth'];
           // 加密
           $manager->manager_pwd = Crypt::encrypt($input['manager_pwd']) ;

       
        // 新数据存入
        $res = $manager->save();

      //  3 判断执行是否成功
      if($res){
          return redirect('/admin/manager');  
      }else{
          return redirect('/admin/manager/create')->with('msg','用户管理员失败');  
      }
    }


    
    public function edit($id)
    { 
        //获取到要修改的那条记录
        $manager = Manager::find($id);
        return view('admin.manager.edit',compact('manager'));
    }

   
    
    public function update(Request $request, $id)
    {
         $input = $request->except('_token','_method');
        $rule=[     // 常用
            'manager_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'manager_email'=>'required|email',
            'manager_status'=>'required',
            'manager_auth'=>'required'
        ];
        $msg = [
            // 常用
            // 'manager_name.required'=>'请输入用户名',  // 错误返回信息
            // 'manager_pwd.required'=>'请输入密码',
            // 'manager_repwd.required'=>'请输入密码',
            // 'manager_name.regex'=>'请输入4-12位数字,字母,下划线',
            // 'manager_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            // 'manager_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'manager_email.required'=>'请输入邮箱',
            'manager_tell.required'=>'请输入电话',
            'manager_tell.regex'=>'手机号码输入不正确',
            'manager_tell.email'=>'邮箱输入不正确',
            // 状态权限
            'manager_status.required'=>'请输入状态',
            'manager_auth.required'=>'请输入权限',
        ];
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/manager/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
          $type = manager::find($id);
           // $manager->manager_name = $input['manager_name'];
           $manager->manager_tell = $input['manager_tell'];
           $manager->manager_email = $input['manager_email'];
           $manager->manager_status = $input['manager_status'];
           $manager->manager_auth = $input['manager_auth'];
           
        // 新数据存入
        $re = $manager->save();
        
        if($re){
           return redirect('admin/manager');   //列表页
        }else{
            // return '失败';
           return redirect('admin/manager/'.$id.'/edit')->with('msg','用户修改失败');  //返回错误信息
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
        // return 'destroy';
        //查询要删除的记录的模型
        $manager = Manager::find($id);
        //执行删除操作
        $re = $manager->delete();
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
//        return json_encode($data);
//        return response()->json($data);
        return  $data;    //return回去的数据ajax接收
    }

     /**
     * Display the specified resource.
     * 修改status状态
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 取数据库
        $manager = Manager::find($id);
        $status = $manager->manager_status;

        // 权限值得变换
        if ($status==1) {
          $status=0;
        }else{
          $status=1;
        }
        // 反向赋值
        $manager->manager_status = $status;
        $res = $manager->save();
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
