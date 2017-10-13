<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cart;
use DB;
class ShopController extends Controller
{
    
    /*
     * 添加到购物车
     */
   public  function addcart($id)
   {
      // return 111;
     // 该商品信息
        $foods_id = $id;
        $food =  DB::table('dc_foods')->where('foods_id',$foods_id)->first();
        $seller_id = $food->seller_id;
        // 该店铺信息 食品归属店 单店版
        $shop =  DB::table('dc_shop')->where('seller_id',$seller_id)->first();

       Cart::add($food->foods_id,$food->foods_name,1,$food->foods_price,[ 'shop'  =>  $shop ]);
       return redirect()->route('cart');
   }

    /*
     * 购物车列表
     */

    public function cart()
    {
        // dd(11);
        //购物车所有信息
        $carts = Cart::content();
        //总额 不含税
        $total = Cart::subtotal();
        //购物车商品数量
        $count = Cart::count();
       // dd($carts);
        return view('product.cart',['carts'=>$carts,'total'=>$total,'count'=>$count]);
    }

    /*
     * 删除购物车里的某一件商品
     */
    public  function  getRemovecart($rowId)
    {
        Cart::remove($rowId);
        return redirect('/cart');
    }


    /*
     * 清空购物车
     */
    public function destroy()
    {
// return 111;
       Cart::destroy();
       return redirect()->route('cart');
    }
}
