<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


// 添加使用的命名空间
// use App\Shop;
use App\Http\Model\Shop;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use DB;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // echo "<pre/>";
        $type =  DB::table('dc_type')->get();
        // dd( $type);
        foreach ($type as $key => $value) { 
            $arrType[$value->type_id] = $value->type_name;
        }
        // dd( $arrType);
        $input = $request->input('keywords')?$request->input('keywords'):'';
        $shop = Shop::orderBy('shop_id','asc')->where('shop_name','like','%'.$input.'%')->paginate(5);
        return view('admin.shop.list',compact('shop','input','arrType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // return 'test';
      $type =  DB::table('dc_type')->get();
     
      //dd($type);
      return view('admin.shop.add',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
//        1 接受前台用户传过来的数据
          $input = $request->except('_token');
         // dd($input);
//        2 执行数据库添加操作（向user表添加一条记录）
// 第一种添加方式创建一个空模型给模型的属性赋值然后执行save方法）
           $shop = new Shop();
           $shop->shop_name = $input['shop_name'];
           $shop->shop_addr = $input['shop_addr'];
           $shop->shop_x = $input['shop_x'];
           $shop->shop_y = $input['shop_y'];
           $shop->shop_desc = $input['shop_desc'];
           $shop->type_id = $input['shop_type'];
           $shop->shop_status = $input['shop_status'];
           $shop->shop_logo = $input['shop_logo_url'];
           $shop->shop_licence = $input['shop_licence_url'];
           $shop->shop_zhizhao = $input['shop_zhizhao_url'];
            // dd($shop);
           $re = $shop->save();
           
// dd($input);
          if($re){
              // return '成功';
              return redirect('admin/shop');  //列表页
          }else{
              // return '失败';
              return redirect('admin/shop/create')->with('msg','用户添加失败');  //添加页
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
    public function edit($id)
    {
      $type =  DB::table('dc_type')->get();
        //获取到要修改的那条记录
        $shop = Shop::find($id);
        return view('admin.shop.edit',compact('shop','type'));
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
      // dd($id);
//        1 接收要修改的记录的内容和id
          // $input  = $request->input('shop_name');
           $input = $request->except('_token','_method');

//        2 找到要修改的用户记录，用提交过来的修改值修改
           $shop = Shop::find($id);
           $shop->shop_name = $input['shop_name'];
           $shop->shop_addr = $input['shop_addr'];
           $shop->shop_x = $input['shop_x'];
           $shop->shop_y = $input['shop_y'];
           $shop->shop_desc = $input['shop_desc'];
           $shop->type_id = $input['shop_type'];
           $shop->shop_status = $input['shop_status'];
           // $shop->shop_logo = $input['shop_logo'];
           // $shop->shop_licence = $input['shop_licence'];
           // $shop->shop_zhizhao = $input['shop_zhizhao'];
            $shop->shop_logo = $input['shop_logo_url'];
           $shop->shop_licence = $input['shop_licence_url'];
           $shop->shop_zhizhao = $input['shop_zhizhao_url'];
// dd($input);
          // $shop->shop_name = $input;
           $re = $shop->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            
            return redirect('admin/shop');   //列表页
        }else{
            
            return redirect('admin/shop/'.$id.'/edit')->with('msg','店铺修改失败');  //返回错误信息
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
        $shop = Shop::find($id);
        //执行删除操作
        $re = $shop->delete();
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
        return  $data;    //return回去的数据ajax接收
    }


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

    public function uploadZhizhao()
    {
    $file = Input::file('shop_zhizhao');
    
      if($file->isValid()){
        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
        $newName = 'zhizhao_'.date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        // 移动文件
        $path = $file->move(public_path().'\uploads',$newName);
        $filepath = 'uploads/'.$newName;
        //返回文件的路径
        return $filepath;
      }
    }

    public function uploadLicence()
    {
    $file = Input::file('shop_licence');
    
      if($file->isValid()){
        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
        $newName = 'licence_'.date('YmdHis').mt_rand(1000,9999).'.'.$entension;
        // 移动文件
        $path = $file->move(public_path().'\uploads',$newName);
        $filepath = 'uploads/'.$newName;
        //返回文件的路径
        return $filepath;
      }
    }
    

}
