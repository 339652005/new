<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 添加使用的命名空间
// use App\Foods;
use App\Http\Model\Foods;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
class FoodsController extends Controller
{
    public function index(Request $request)
    {
      $data = $request->session()->get('seller_id');
     // dd($data[0]);
      $seller_id = $data[0];
      $taocan =  DB::table('dc_taocan')->where('seller_id', $seller_id)->get();
      foreach ($taocan as $key => $value) { 
        $arrType[$value->taocan_id] = $value->taocan_name;
      }
      // dd($arrType);   
         

      // ->where('seller_id', $seller_id)限定 只有当前用户的商品显示
      $input = $request->input('keywords')?$request->input('keywords'):'';
      $foods = Foods::orderBy('foods_id','asc')->where('foods_name','like','%'.$input.'%')->where('seller_id', $seller_id)->paginate(10);
      // dd($foods);
        return view('seller.foods.list',compact('foods','input','arrType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return 'test';
      // 限定数据为当前用户
      $data = $request->session()->get('seller_id');
     // dd($data[0]);
      $seller_id = $data[0];

      $taocan =  DB::table('dc_taocan')->where('seller_id', $seller_id)->get();
     
      // dd($taocan);
      return view('seller.foods.add',compact('taocan'));
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
     // dd($data[0]);
      $seller_id = $data[0];
      // dd();
          $input = $request->except('_token');
           
           $foods = new foods();
           $foods->foods_name = $input['foods_name'];
           $foods->foods_sales = $input['foods_sales'];
           $foods->foods_price = $input['foods_price'];
           $foods->foods_desc = $input['foods_desc'];
           $foods->foods_status = $input['foods_status'];

           $foods->foods_piture = $input['foods_piture']; //图片

           $foods->seller_id = $seller_id;// 用户

           $foods->taocan_id = $input['foods_taocan'];//套餐分类
          // dd( $foods->seller_id);
           $re = $foods->save();
        if($re){
             // return '成功';
            return redirect('seller/foods');  //列表页
        }else{
            // return '失败';
            return redirect('seller/foods/create')->with('msg','类别添加失败');  //添加页
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      // 限定数据为当前用户
      $data = $request->session()->get('seller_id');
      $seller_id = $data[0];

      $taocan =  DB::table('dc_taocan')->where('seller_id', $seller_id)->get();
      //  获取到要修改的那条记录
      $foods = foods::find($id);

      return view('seller.foods.edit',compact('foods','taocan'));
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

      // 限定数据为当前用户
      $data = $request->session()->get('seller_id');
      $seller_id = $data[0];

      // 1 接收要修改的记录的内容和id
          // $input  = $request->input('foods_name');
          $input = $request->except('_token','_method');
          // dd($input);
      // 2 找到要修改的用户记录，用提交过来的修改值修改
          $foods = foods::find($id);
          $foods->foods_name = $input['foods_name'];
          $foods->foods_sales = $input['foods_sales'];
          $foods->foods_price = $input['foods_price'];
          $foods->foods_desc = $input['foods_desc'];
          $foods->foods_status = $input['foods_status'];

          $foods->taocan_id = $input['foods_taocan'];  //套餐分类
          $foods->foods_piture = $input['foods_piture']; // 图片
          $foods->seller_id = $seller_id;// 用户 可以不加 没有变化

          $re = $foods->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
            return redirect('seller/foods');   //列表页
        }else{
            // return '失败';
            return redirect('seller/foods/'.$id.'/edit')->with('msg','类别修改失败');  //返回错误信息
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
        $foods = foods::find($id);
        //执行删除操作
        $re = $foods->delete();
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
    // 上传图片
    public function uploadLogo()
    {
    //获取上传的文件对象
    $file = Input::file('shop_logo');
      //判断文件是否有效
     //return $file;
      if($file->isValid()){
        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
        $newName = 'logo_'.date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        // 移动文件
        $path = $file->move(public_path().'\uploads',$newName);
        $filepath = 'uploads/'.$newName;
        //返回文件的路径
        return $filepath;
      }
    }
}
