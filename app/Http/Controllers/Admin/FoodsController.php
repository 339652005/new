<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 添加使用的命名空间
use App\Foods;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $input = $request->input('keywords')?$request->input('keywords'):'';
        $foods = foods::orderBy('foods_id','asc')->where('foods_name','like','%'.$input.'%')->paginate(10);
        return view('admin.foods.list',compact('foods','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foods.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $input = $request->except('_token');
           $foods = new foods();
           $foods->foods_name = $input['foods_name'];
           $foods->foods_sales = $input['foods_sales'];
           $foods->foods_price = $input['foods_price'];
           $foods->foods_desc = $input['foods_desc'];
           $foods->foods_status = $input['foods_status'];
           $foods->foods_piture = $input['foods_piture'];
           // dd();
           $re = $foods->save();
        if($re){
             //return '成功';
            return redirect('admin/foods');  //列表页
        }else{
            // return '失败';
            return redirect('admin/foods/create')->with('msg','类别添加失败');  //添加页
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
        //获取到要修改的那条记录
        $foods = foods::find($id);
        return view('admin.foods.edit',compact('foods'));
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
        // 1 接收要修改的记录的内容和id
          // $input  = $request->input('foods_name');
          $input = $request->except('_token','_method');
          // dd($input);
//        2 找到要修改的用户记录，用提交过来的修改值修改
          $foods = foods::find($id);
          $foods->foods_name = $input['foods_name'];
          $foods->foods_sales = $input['foods_sales'];
          $foods->foods_price = $input['foods_price'];
          $foods->foods_desc = $input['foods_desc'];
          $foods->foods_piture = $input['foods_piture'];
          $foods->foods_status = $input['foods_status'];
          $re = $foods->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
            return redirect('admin/foods');   //列表页
        }else{
            // return '失败';
            return redirect('admin/foods/'.$id.'/edit')->with('msg','类别修改失败');  //返回错误信息
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
}
