<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Seller;
use App\Http\Model\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
// 表单验证
use Illuminate\Support\Facades\Validator;
class SellerController extends Controller
{ 
    
    public function index(Request $request)
    {
      
        $input = $request->input('keywords')?$request->input('keywords'):'';
        $seller = Seller::orderBy('seller_id','asc')->where('seller_name','like','%'.$input.'%')->paginate(6);
      return view('admin.seller.list',compact('seller','input'));

    }

   
    public function create()
    {
      return view('admin.seller.add');
    }

    
    public function store(Request $request)
    {
           $input = $request->except('_token');
// dd($input);
        // 2.表单验证
        $rule=[     // 常用
            'seller_name'=>'required|regex:/^\w{4,12}$/', 
            'seller_pwd'=>'required|regex:/^\w{4,12}$/',
            'seller_repwd'=>'required|same:seller_pwd',
            'seller_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'seller_email'=>'required|email',
            'seller_status'=>'required'
           
        ];
        $msg = [
            // 常用
            'seller_name.required'=>'请输入用户名',  // 错误返回信息
            'seller_pwd.required'=>'请输入密码',
            'seller_repwd.required'=>'请输入密码',
            'seller_name.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'seller_email.required'=>'请输入邮箱',
            'seller_tell.required'=>'请输入电话',
            'seller_tell.regex'=>'手机号码输入不正确',
            'seller_email.email'=>'邮箱输入不正确',
            // 状态权限
            'seller_status.required'=>'请输入状态'
          

        ];

      
       
         // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/user/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
        // 检测该登录用户是否存在
        $seller = seller::where('seller_name','=',$input['seller_name'])->first();

       //  存在
        if($seller){
            return back()->with('errors','用户名已经被注册')->withInput();
        }
        // 2 执行数据库添加操作（向seller表添加一条记录）
          
           $data['seller_name'] = $input['seller_name'];
           $data['seller_tell'] = $input['seller_tell'];
           $data['seller_email'] = $input['seller_email'];
           $data['seller_status'] = $input['seller_status'];
           $data['seller_pwd'] = Crypt::encrypt($input['seller_pwd']);
            // 留待补充 经验值 与积分的判断条件
           // $seller->seller_lasttime = time();  //最后登录时间
           // $seller->seller_jifen;  //购物加积分
           // dd($seller);
           // $re = $seller->save();
           $seller_id = seller::insertGetId($data);
           // dd($id);  //添加事物 失败回滚
          if($seller_id){
            return redirect('admin/seller')->with('msg','用户添加成功'); 
            // $type =  DB::table('dc_type')->get();

            // return view('admin.shop.add',compact('type','seller_id','data'));
          }else{
           // echo  $errors;
            return redirect('admin/seller/create')->with('msg','用户添加失败');  
          }
          
    }

   
    
    public function edit($id)
    {
      $seller = Seller::find($id);
       // dd($seller);
     return view('admin.seller.edit',compact('seller'));

    }

    public function update(Request $request, $id)
    {

      $input = $request->except('_token','_method');

      // $seller = Seller::find($id);
        $rule=[     
            'seller_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'seller_email'=>'required|email',
            // 'seller_status'=>'required',
        ];
        $msg = [
            // 常用
            // 'seller_name.required'=>'请输入用户名',  // 错误返回信息
            // 'seller_pwd.required'=>'请输入密码',
            // 'seller_repwd.required'=>'请输入密码',
            // 'seller_name.regex'=>'请输入4-12位数字,字母,下划线',
            // 'seller_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            // 'seller_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'seller_email.required'=>'请输入邮箱',
            'seller_tell.required'=>'请输入电话',
            'seller_tell.regex'=>'手机号码输入不正确',
            'seller_email.email'=>'邮箱输入不正确',
            // 状态权限
            // 'seller_status.required'=>'请输入状态',
            // 'seller_auth.required'=>'请输入权限',
        ];
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/seller/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
          $seller = seller::find($id);

          
           $seller->seller_tell = $input['seller_tell'];
           $seller->seller_email = $input['seller_email'];
           // $seller->seller_status = $input['seller_status'];
           
      $re = $seller->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
             //return '成功';
            return redirect('admin/seller');   //列表页
        }else{
             //return '失败';
            return redirect('admin/seller/'.$id.'/edit')->with('msg','商户修改失败');  //返回错误信息
        }
    }

   
    public function destroy($id)
    {
        // return 'destroy'; //取消删除
      return '取消删除功能';
        //查询要删除的记录的模型
        $seller = Seller::find($id);
        //执行删除操作
        $re = $seller->delete();

        
        //  $shop = Shop::find($id);
        // //执行删除操作
        // $res = $shop->delete();

        //根据返回的结果处理成功和失败
        if($re&&$res){
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

    public function show($id)
    {
      // $id = 194;
     // return '测试';
      // 取数据库
        $seller = seller::find($id);
        $status = $seller->seller_status;

        // 权限值得变换
        if ($status==1) {
          // 禁用
          $status=0;
          Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        }else{
          $status=1;
          Shop::where('seller_id',$id)->update(['shop_status' => 2]);
        }

        // 反向赋值
        $seller->seller_status = $status;

        $res = $seller->save();
        // $re = Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        // DB::table('dc_shop')->where('seller',$id)->update(['shop_status' => 3]);
        //  判断执行是否成功
        if($res){
          $data=[
              'status'=>1,
              'msg'=>'状态修改成功'
          ];

        }else{
            $data=[
                'status'=>0,
                'msg'=>'状态修改失败'
            ];
        }
         return  $data; 
         // print_r($res&&$res);
         


     }
        // // 取数据库
        // $seller = seller::find($id);
        // $status = $seller->seller_status;

        // // 权限值得变换
        // if ($status==1) {
        //   // 禁用
        //   $status=0;
        //   $re = Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        // }else{
        //   $status=1;
        //   $re = Shop::where('seller_id',$id)->update(['shop_status' => 2]);
        // }
        // // 反向赋值
        // $seller->seller_status = $status;

        // $res = $seller->save();
        // // $re = Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        // // DB::table('dc_shop')->where('seller',$id)->update(['shop_status' => 3]);
        // //  判断执行是否成功
        // if($res && $re){
        //   $data=[
        //       'status'=>1,
        //       'msg'=>'状态修改成功'
        //   ];

        // }else{
        //     $data=[
        //         'status'=>0,
        //         'msg'=>'状态修改失败'
        //     ];
        // }
        //  return  $data;    
    // }

     public function test()
     {
     
      
// $id = 194;
     // return '测试';
      // 取数据库
        $seller = seller::find($id);
        $status = $seller->seller_status;

        // 权限值得变换
        if ($status==1) {
          // 禁用
          $status=0;
          $re = Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        }else{
          $status=1;
          $re = Shop::where('seller_id',$id)->update(['shop_status' => 2]);
        }

        // 反向赋值
        $seller->seller_status = $status;

        $res = $seller->save();
        // $re = Shop::where('seller_id',$id)->update(['shop_status' => 3]);
        // DB::table('dc_shop')->where('seller',$id)->update(['shop_status' => 3]);
        //  判断执行是否成功
        if($res && $re){
          $data=[
              'status'=>1,
              'msg'=>'状态修改成功'
          ];

        }else{
            $data=[
                'status'=>0,
                'msg'=>'状态修改失败'
            ];
        }
         return  $data; 
         // print_r($res&&$res);



     }
    
}
