<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取session里的id
        $seller_id = $request->session('seller_id')->get('seller_id');
        // 获取店
        $shop = DB::table('dc_shop')->where('seller_id',$seller_id)->first();
       // 通过点获取详情订单号 所有
        $details = DB::table('dc_detail')->where('shop_id',$shop->shop_id)->get();
        foreach ($details as $key => $value) {
           $arr[] = $value->order_id;
        }
       // dd($arr);//
       // 属于这个店的单
        //
        $orders = DB::table('dc_orders')->orderBy('order_time','desc')->whereIn('order_id',$arr)->get();
 // dd($orders);

        
        return view('seller.order.detail',compact( 'orders')); 
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        
        $details = DB::table('dc_detail')->where('order_id',$id)->get();
        // echo "<pre/>";
        // print_r($details);
        return view('seller.order.detailTwo',compact( 'details')); 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
