<?php
  
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
// use Type;
use App\Http\Model\Type;
use App\Http\Model\Shop;
use App\Http\Model\Taocan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $type = Type::orderBy('type_id','asc')->get();

    // 商品搜索
      $input = $request->input('keywords')?$request->input('keywords'):'';
      $shops = Shop::orderBy('shop_id','asc')->where('shop_name','like','%'.$input.'%')->paginate(10);
      
    // 类别信息数组
      $type =  DB::table('dc_type')->get();
        foreach ($type as $key => $value) { 
            $arrType[$value->type_id] = $value->type_name;
        }

       
    // 显示主页  
      return view('home.index.list',compact('type','shops','input','arrType'));
    }

    

   
    public function show($id)
    {
       
       // 2.店铺信息的获取  id $shop_id=$id;
       $shop =  DB::table('dc_shop')->where('shop_id',$id)->first();
        // dd( $shop->seller_id);

       // 3.店铺对应 商品 的获取   
       $seller_id =  $shop->seller_id;  //$seller_id  作为店铺商品外键 1:N
       $foods =  DB::table('dc_foods')->where('seller_id',$seller_id)->get();
       // dd($foods );  // 所有的商品

       // 1.所有套餐信息(限定不同商户 套餐不同)
        $taocan = Taocan::orderBy('taocan_id','asc')->where('seller_id',$seller_id)->get();
// dd($taocan ); 
     // $shop =  DB::table('dc_shop')->where('seller_id',$seller_id)->get();
        //foreach ($type as $key => $value) { 
        //    $arrType[$value->type_id] = $value->type_name;
       // }
        // dd( $arrType);

       
       
      return view('home.index.show',compact('taocan','shop','foods'));
    }

   

    /**
     * 详情页具体套餐里的商品
     *
     * @param  int  $id
     * @return 
     */
    public function taocanFoods(Request $request,$taocan_id,$shop_id)
    {
       // 2.店铺信息的获取 
       $shop =  DB::table('dc_shop')->where('shop_id',$shop_id)->first();  
       // 3.店铺对应 商品 的获取   
       $seller_id =  $shop->seller_id;  // 1:N
       $foods =  DB::table('dc_foods')->where('taocan_id',$taocan_id)->where('seller_id',$seller_id)->get();
       // 1.所有套餐信息(限定不同商户 套餐不同)
        $taocan = Taocan::orderBy('taocan_id','asc')->where('seller_id',$seller_id)->get();
      return view('home.index.show',compact('taocan','shop','foods'));
    }

      /**
     * 首页不同类别下的商品
     *
     * @param  int  $id
     * @return 
     */
    public function typeFoods(Request $request,$type_id)
    {
// dd();
        $type = Type::orderBy('type_id','asc')->get();
        // 类别信息数组
        $type =  DB::table('dc_type')->get();
        foreach ($type as $key => $value) { 
            $arrType[$value->type_id] = $value->type_name;
        }
        // 所有店
        $shops = Shop::orderBy('shop_id','asc')->where('type_id',$type_id)->paginate(10);
       
    // 显示主页  
      return view('home.index.list',compact('type','shops','arrType'));

      //  // 2.店铺信息的获取 
      //  $shop =  DB::table('dc_shop')->where('shop_id',$shop_id)->first();  
      //  // 3.店铺对应 商品 的获取   
      //  $seller_id =  $shop->seller_id;  // 1:N
      //  $foods =  DB::table('dc_foods')->where('taocan_id',$taocan_id)->where('seller_id',$seller_id)->get();
      //  // 1.所有套餐信息(限定不同商户 套餐不同)
      //   $taocan = Taocan::orderBy('taocan_id','asc')->where('seller_id',$seller_id)->get();
      // return view('home.index.show',compact('taocan','shop','foods'));
    }
}
