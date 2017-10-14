<?php 
  
namespace App\Http\Controllers\Admin;

use App\Http\Model\Manager;
use Illuminate\Http\Request;

use App\Http\Requests; 

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       // dd();
        // return view('admin.manager.list');

        // 1 获取需要的用户数据
        // $manager = User::orderBy('manager_id','desc')->get();
        // $manager = User::orderBy('manager_id','asc')->paginate(10);
        // dd($manager);

//        2 将查询出的数据绑定前台模板页面
//        给前台模板绑定变量的三种方法
       // return view('admin.manager.list',['manager'=>$manager]);
//        redirect()->with() 这个with中的变量，前台需要通过session来获取
//        而view函数跟着的with中的变量，前台通过变量名来获取
//        return view('admin.manager.list')->with('users',$users);

//        必须要掌握的一种给前台模板绑定变量的方式 compact()
//          return view('admin.manager.list',compact('users'));


//          查询操作（）
//        $users = User::orderBy('user_id','desc')->where('user_name','like','%'.前台提交过来的查询参数.'%')->get();


        $input = $request->input('keywords')?$request->input('keywords'):'';
        $manager = Manager::orderBy('manager_id','asc')->where('manager_name','like','%'.$input.'%')->paginate(5);
// dd( $manager);
        foreach ($manager as $key => $value) {
          # code...
          // dd( $value->manager_name);
        }
        return view('admin.manager.list',compact('manager','input'));

    }

    
    public function create()
    {
         return view('admin.manager.add');
    }

   
    public function store(Request $request)
    {
//        1 接受前台用户传过来的数据
          $input = $request->except('_token');
          // dd($input);
//        2 执行数据库添加操作（向user表添加一条记录）
//   第一种添加方式（创建一个空模型，给模型的属性赋值，然后执行save方法）
           $manager = new Manager();
           $manager->manager_name = $input['manager_name'];
           $manager->manager_tell = $input['manager_tell'];
           $manager->manager_email = $input['manager_email'];
           $manager->manager_status = $input['manager_status'];
           $manager->manager_auth = $input['manager_auth'];
           $manager->manager_pwd = Crypt::encrypt($input['manager_pwd']) ;

           // dd($manager);
            $res = $manager->save();

//          第二种添加方式（create）
//        $input = [
//            'user_name'=>'xxx',
//            'user_pass'=>'xxxx'
//        ]
        // 密码加密
        // $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        // $re = User::create($input);



        //  3 判断执行是否成功
        //  4 如果成功，跳转到列表页 ；如果失败，跳转到添加页继续添加
         // dd($res);
          if($res){
              //return '成功';
              return redirect('/admin/manager');  //列表页
          }else{
              //return '失败';
              return redirect('/admin/manager/create')->with('msg','用户添加失败');  //添加页
          }

          //补充表单验证
    }


    
    public function edit($id)
    {
        // return 'edit';

        //获取到要修改的那条记录
        $manager = Manager::find($id);
// dd($manager);
        return view('admin.manager.edit',compact('manager'));
    }

   
    
    public function update(Request $request, $id)
    {
        
//        1 接收要修改的记录的内容和id
          // $input  = $request->input('manager_name');
         $input = $request->except('_token','_method');
//        2 找到要修改的用户记录，用提交过来的修改值修改
          $manager = Manager::find($id);

          // $manager->manager_name = $input;
          $manager->manager_name = $input['manager_name'];
           $manager->manager_tell = $input['manager_tell'];
           $manager->manager_email = $input['manager_email'];
           $manager->manager_status = $input['manager_status'];
           $manager->manager_auth = $input['manager_auth'];
          $re = $manager->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
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
    
}
