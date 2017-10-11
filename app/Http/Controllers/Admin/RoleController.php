<?php
 
namespace App\Http\Controllers\Admin;

use App\Http\Model\Permission;
use App\Http\Model\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //返回授权页面
    public function auth($id)
    {
//        通过角色ID获取角色记录
        $role = Role::find($id);
//        获取所有的权限
        $permissions = Permission::get();

        // 获取当前角色已经拥有的权限
        $own_permissions = \DB::table('dc_permission_role')->where('role_id',$id)->lists('permission_id');
        
        return view('admin/role/auth',compact('role','permissions','own_permissions'));
    }
//  给用户的授权操作
    public function doAuth(Request $request)
    {
//        1 获取要授权的角色
        $role_id =  $request->input('role_id');

//        2 获取要给角色的权限
        $permissions = $request->input('permission_id');


        // dd($roles);
//        删除当前角色的所有权限
        \DB::table('dc_permission_role')->where('role_id',$role_id)->delete();
//         3 执行授权操作
        foreach ($permissions as $permission) {
            \DB::table('dc_permission_role')->insert(['permission_id'=>$permission,'role_id'=>$role_id]);
        }

        return redirect('admin/role');

//        4 授权成功或失败的处理
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $input = $request->input('keywords')?$request->input('keywords'):'';
        $roles = Role::orderBy('role_id','asc')->where('role_name','like','%'.$input.'%')->paginate(5);
        return view('admin.role.list',compact('roles','input'));


        // return 'index';
        // 获取所有的角色
        // $roles =  Role::all();
         // dd( $roles);
        // 引入视图显示角色信息
        // return view('admin.role.list',compact('roles'));
    }

    
    public function create()
    {
       
        return view('admin.role.add');
    }

   
    public function store(Request $request)
    {
    // 接收添加数据
       $input =  $request->except('_token');
    // dd($input);
    // 模型::create()   添加数据入数据库
       $role =  Role::create($input);
       if($role){
           return redirect('admin/role');
       }else{
           return back()->with('msg','添加失败');
       }
    }
    public function edit($id)
    {
         // dd(111);
        // 当前修改的角色信息
        $role = Role::find($id);
        // 引入视图 并且传递参数
        return view('admin.role.edit',compact('role'));
    }
    public function update(Request $request, $id)
    {
        //通过ID找到要修改的角色记录
        $role =  Role::find($id);
        // 获取这条角色记录要修改的值
        $input = $request->except('_token','_method');
        //执行修改方法
        $re = $role->update($input);
        if($re){
            return redirect('admin/role');
        }else{
            return back()->with('msg','修改失败');
        }
    }
    public function destroy($id)
    {
        //查询要删除的记录的模型
        $role = Role::find($id);
        //执行删除操作
        $re = $role->delete();
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
        return  $data;
    }
}
