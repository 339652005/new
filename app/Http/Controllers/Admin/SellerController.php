<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
class SellerController extends Controller
{ 
    
    public function index(Request $request)
    {
      
      
        $input = $request->input('keywords')?$request->input('keywords'):'';
        $seller = Seller::orderBy('seller_id','asc')->where('seller_name','like','%'.$input.'%')->paginate(10);
      return view('admin.seller.list',compact('seller','input'));

    }

   
    public function create()
    {
      return view('admin.seller.add');
    }

    
    public function store(Request $request)
    {
        
           $input = $request->except('_token');
           $seller = new Seller();
           $seller->seller_name = $input['seller_name'];
           $seller->seller_tell = $input['seller_tell'];
           $seller->seller_status = $input['seller_status'];
           $seller->seller_email = $input['seller_email'];
           // $seller->seller_auth = $input['seller_auth'];
           $seller->seller_pwd = Crypt::encrypt($input['seller_pwd']) ;
          $re = $seller->save();
         // dd();  
          if($re){
              //return '成功';
              return redirect('admin/seller');  //列表页
          }else{
              //return '失败';
              return redirect('admin/seller/create')->with('msg','用户添加失败');  //添加页
          }

          //补充表单验证
    }

   
    
    public function edit($id)
    {
      // dd($request->except('_token'));
      $seller = Seller::find($id);
      return view('admin.seller.edit',compact('seller'));
    }

    
    public function update(Request $request, $id)
    {
        
      $input = $request->except('_token','_method');
//        2 找到要修改的用户记录，用提交过来的修改值修改
      $seller = Seller::find($id);

          // $seller->seller_name = $input['seller_name'];
      $seller->seller_name = $input['seller_name'];
      $seller->seller_tell = $input['seller_tell'];
      $seller->seller_status = $input['seller_status'];
      $seller->seller_email = $input['seller_email'];
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
        // return 'destroy';
        //查询要删除的记录的模型
        $seller = Seller::find($id);
        //执行删除操作
        $re = $seller->delete();
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
