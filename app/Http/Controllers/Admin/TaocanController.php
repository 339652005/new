<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// 添加使用的命名空间
// use App\Taocan;
use App\Http\Model\Taocan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
class taocanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         $input = $request->input('keywords')?$request->input('keywords'):'';
        $taocan = Taocan::orderBy('taocan_id','asc')->where('taocan_name','like','%'.$input.'%')->paginate(10);
        return view('admin.taocan.list',compact('taocan','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.taocan.add');
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
           $taocan = new taocan();
           $taocan->taocan_name = $input['taocan_name'];
           // $taocan->taocan_sales = $input['taocan_sales'];
           $taocan->taocan_price = $input['taocan_price'];
           // $taocan->taocan_desc = $input['taocan_desc'];
           // $taocan->taocan_status = $input['taocan_status'];
           // $taocan->taocan_piture = $input['taocan_piture'];
           // dd();
           $re = $taocan->save();
        if($re){
             //return '成功';
            return redirect('admin/taocan');  //列表页
        }else{
            // return '失败';
            return redirect('admin/taocan/create')->with('msg','类别添加失败');  //添加页
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
        $taocan = taocan::find($id);

        return view('admin.taocan.edit',compact('taocan'));
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
          // $input  = $request->input('taocan_name');
          $input = $request->except('_token','_method');
          // dd($input);
//        2 找到要修改的用户记录，用提交过来的修改值修改
          // $taocan = taocan::find($id);
          $taocan = new taocan();  //空的
          $taocan->taocan_name = $input['taocan_name'];
          // $taocan->taocan_sales = $input['taocan_sales'];
          $taocan->taocan_price = $input['taocan_price'];
          // $taocan->taocan_desc = $input['taocan_desc'];
          // $taocan->taocan_piture = $input['taocan_piture'];
          // $taocan->taocan_status = $input['taocan_status'];
          $re = $taocan->save();   //save()保存数据
//        3 判断执行是否成功
        if($re){
            // return '成功';
            return redirect('admin/taocan');   //列表页
        }else{
            // return '失败';
            return redirect('admin/taocan/'.$id.'/edit')->with('msg','类别修改失败');  //返回错误信息
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
        $taocan = taocan::find($id);
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
