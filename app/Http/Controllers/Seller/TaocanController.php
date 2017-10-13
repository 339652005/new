<?php
 
namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 添加使用的命名空间
// use App\Taocan;
use App\Http\Model\Taocan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
class taocanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // 限定数据为当前用户
      $data = $request->session()->get('seller_id');
      $seller_id = $data[0];
      //->where('seller_id', $seller_id)

      $input = $request->input('keywords')?$request->input('keywords'):'';
      $taocan = Taocan::orderBy('taocan_id','asc')->where('taocan_name','like','%'.$input.'%')->where('seller_id', $seller_id)->paginate(5);
      return view('seller.taocan.list',compact('taocan','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('seller.taocan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // 限定数据为当前用户
      $data = $request->session()->get('seller_id');
      $seller_id = $data[0];

          $input = $request->except('_token');
           $taocan = new taocan();
           $taocan->taocan_name = $input['taocan_name'];
           $taocan->seller_id = $seller_id;      //所属商家
           $taocan->taocan_price = $input['taocan_price'];
           // $taocan->taocan_desc = $input['taocan_desc'];
           // $taocan->taocan_status = $input['taocan_status'];
           // $taocan->taocan_piture = $input['taocan_piture'];
           // dd();
           $re = $taocan->save();
        if($re){
             //return '成功';
            return redirect('seller/taocan');  //列表页
        }else{
            // return '失败';
            return redirect('seller/taocan/create')->with('msg','类别添加失败');  //添加页
        }

        //补充表单验证
    }

   
    public function edit($id)
    {
      // 获取到要修改的那条记录
      $taocan = taocan::find($id);
      return view('seller.taocan.edit',compact('taocan'));
    }

   
    public function update(Request $request, $id)
    {
      // 限定数据为当前用户
      // $data = $request->session()->get('seller_id');
      // $seller_id = $data[0];

        // 1 接收要修改的记录的内容和id
          $input = $request->except('_token','_method');
          
          $taocan = new Taocan();  
          $taocan->taocan_name = $input['taocan_name'];
          $taocan->taocan_price = $input['taocan_price'];
          $re = $taocan->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
            return redirect('seller/taocan');   //列表页
        }else{
            // return '失败';
            return redirect('seller/taocan/'.$id.'/edit')->with('msg','类别修改失败');  //返回错误信息
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
      
      // 有商品 不可以删除
      $taocan = DB::table('dc_foods')->where('taocan_id',$id)->first();
      if($taocan){
        //有商品
        $data=[
                'status'=>1,
                'msg'=>'有商品,禁止删除'
            ];
         // dd($data['msg']);
         return  $data;
      }
     
      // dd($taocan);
        $taocan = Taocan::find($id);
        //执行删除操作
        $re = $taocan->delete();
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
