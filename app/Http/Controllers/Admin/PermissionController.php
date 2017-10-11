<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use App\Http\Model\Permission;
class PermissionController extends Controller
{
    
    public function index(Request $request)
    {

         $input = $request->input('keywords')?$request->input('keywords'):'';
        $permissions = Permission::orderBy('permission_id','asc')->where('permission_name','like','%'.$input.'%')->paginate(5);
        // dd($permissions );
        return view('admin.per.list',compact('permissions','input'));

        // // ORM 获取所有权限数据
        // $permissions =  Permission::all();
        // // 引入视图并且在视图中 遍历数据
        // return view('admin.per.list',compact('permissions'));
    }

    public function create()
    {
        // 引入添加视图
        return view('admin.per.add');
    }


    public function store(Request $request)
    {
        // 添加的数据接收
        $input =  $request->except('_token');
        // 打印添加的数据
        // dd($input);
        // 接收的数据添加进入数据库
        $per =  Permission::create($input);
        // 对数据库添加的状态做判断
        if($per){
            // 成功显示页
            return redirect('admin/permission');
        }else{
            // 失败返回 并且传递错误信息msg到session
            return back()->with('msg','添加失败');
        }
    }
    // 修改数据
    public function edit($id)
    {
        // return 'edit';
        // 获取要修改权限的那个角色
        $permission = Permission::find($id);
        // 引入视图层 并且传递参数给显示界面
        // dd();
        return view('admin.per.edit',compact('permission'));
    }

    public function update(Request $request, $id)
    {
        // 通过ID找到要修改的角色记录
        $permission =  Permission::find($id);
        // 获取这条角色记录要修改的值
        $input = $request->except('_token','_method');
        //执行修改方法
        // dd( $permission);
        $re = $permission->update($input);
        if($re){
            // return '成功';
            return redirect('admin/permission');
        }else{
              // return '失败';
            return back()->with('msg','修改失败');
        }


       
        
       
    }

    public function destroy($id)
    {
        // dd($id);
        // 查询要删除的某权限的那个角色
        $permission = Permission::find($id);
        // 执行删除操作(删除这个角色的这项权限)
        $re = $permission->delete();
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
