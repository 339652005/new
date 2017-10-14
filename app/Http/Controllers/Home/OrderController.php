<?php
 
namespace App\Http\Controllers\Home;
use DB;
use Illuminate\Http\Request;
use Cart;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Order;
class OrderController extends Controller
{
        private $oid;
        private $pdo;
    // 收集订单信息   收货人, 电话, 地址 ,留言
    public  function info(Request $request)
    {
        // 购物车信息判断
        // dd($request->session()->all());
        if (!$request->session()->has('cart')) { 
            // 无商品返回首页/做个弹层
            echo "无商品返回首页/做个弹层";
            return redirect('/home/index');
        } 

// 假数据
$request->session()->put('userLoginFlag','true');
$request->session()->put('user_id','70');  //登录用户id 伪造

        // 判断用户登录标志位
        if (!$request->session()->has('userLoginFlag')) {
            echo "没有登录";
            $request->session()->put('back','jsy');
            // 用户登录界面
            // return view('home.login.list');
            return redirect('home/login');
        }
        
            // 第三种状态 成功跳转
            return view('home.order.info');
        }
        
        // 结算页
       public function jsy(Request $request)
        {
            // dd(111);
            $input = $request->except('_token');
           $order = new Order();
           

        //购物车所有信息 的获取
           $carts = Cart::content();

        //总额 不含税
        $total = Cart::subtotal();
        //购物车商品数量
        $count = Cart::count();
      
      
        
       // echo "<pre/>";
       foreach ($carts as $key => $cart) {
            # code...
             //dd($cart->options->piture);
             // print_r($cart->name); 
             // print_r($cart->id); 
             // print_r($cart->price); 
             // echo "<br/>";
             // print_r($cart->options->shop); // shop对象
             // print_r($seller->id); 
       }
        
        // 暂时存入session
           $request->session()->put('order_name',$input['order_name']);
           $request->session()->put('order_addr', $input['order_addr']);
           $request->session()->put('order_tell', $input['order_tell']);
           $request->session()->put('order_umsg',$input['order_umsg']);
           $request->session()->put('order_total',$total);  //总售出金额
           $request->session()->put('order_count',$count);  //总数量


        return view('home.order.list',['carts'=>$carts,'total'=>$total,'count'=>$count]);
          
            // 跳转 订单详细待确认页面
        }
        
        
        // 最终结账
        public  function finish(Request $request)
        {
            //处理session销毁过后,用户再刷新 
            if (!$request->session()->has('order_id')) {
                // 回首页
                return redirect('/home/index');
            }

            // 开启事务
            DB::beginTransaction();
            //** 先主表生成订单号 详情表才能用这个订单号

            //  改库存方法   写主表方法    写详情表方法
            if($this->updateStock() && $this->writeOrder($request)  && $this->writeDetail() ){  
                DB::commit();
            }else{
                DB::rollBack();
                // 失败回首页
                return redirect('/home/index');
           }                  
            // 善后last() 
            // $this -> last();
                return redirect('/home/ok');
        }

        // 1.修改库存和销量 $v->qty 单间数量 statement执行sql语句 
        private function updateStock()
        {
            //购物车所有信息
            $carts = Cart::content();
            foreach( $carts as $k=>$v){  // dd($v->id); // foods_id
                $sql = "update dc_foods set foods_sales=foods_sales+{$v->qty} where foods_id={$v->id}";
                if(!DB::statement($sql)){
                   return false;  // 修改库存失败
                   die();         // 结束代码执行
                } 
            }   
            return true;          // 修改库存成功
        }
        
        
        // 2.写入主表
        private function writeOrder(Request $request)
        {
            /* 
             购物车所有信息
             订单名称 收货人 收货地址 收货人备注     收货人电话 
             状态(是否收货)  食品id   下单人user_id  总价格   总数量
             取出session数据       
             dd( $request->session()->all());
             */

            // 定义session里的订单号
            session(['order_id' => date('YmdHis').uniqid()]);
            $this -> oid =  session('order_id');
            $data['order_id'] =  $this -> oid;

            $data['order_status'] = 0;   //订单状态 0 派送中 1已收货
            $data['order_umsg'] = $request->session()->get('order_umsg');
            $data['order_tell'] = $request->session()->get('order_tell');
            $data['order_addr'] = $request->session()->get('order_addr');
            $data['order_name'] = $request->session()->get('order_name');  //收货人
            $data['order_total'] = $request->session()->get('order_total');  
            $data['order_count'] = $request->session()->get('order_count');  
            $data['user_id'] = session('user_id');  //登录用户
            //$data['foods_id'] = $request->session()->get('foods_id');  
            //食品id 暂时获取不到 oeder_id关联
 
             /*echo date('YmdHis').uniqid() ;  //生成基于微妙计数的精确唯一id        
             echo session('order_id').'<br/>';         
             echo $this -> oid;         
             echo $data['order_id'];  */      
            
            $res = DB::table('dc_orders') -> insert($data);
            if ($res){
                // echo "成功";
                return true;  // 写主表成功
            } else {
                // echo "失败";
                return false; // 写主表失败
            }
        }
    
    
        // 3.写入详情表
        private function writeDetail()
        {
            //  拼成一条SQL语句 bprice,bcnt 单价 单品数量
            $sql = "insert into dc_detail(order_id,foods_id,bprice,bcnt,foods_name,order_status,shop_name,shop_logo) values";
            // 购物车所有信息
            $carts = Cart::content();
            foreach( $carts as $k=>$cart){ 
                $shop_name =  $cart->options->shop->shop_name;      //店铺名
                $shop_logo = $cart->options->shop->shop_logo;       //店铺logo/
                // dd($cart->id);  // dd($cart->id); => foods_id        食品id(不显示)
                // dd($cart->qty);  // dd($cart->qty); => bcnt          单数
                $foods_picture = $cart->options->piture;  //        食品图片
                // dd($cart->price);  // dd($cart->bprice); => bprice   单价
                // dd($cart->name);  // dd($cart->name); => foods_name  食品名称
                // order_status =>0 送货中
                // 食品图片  店家名称 店家logo   订单状态
                 $sql .= "('{$this->oid}',{$cart->id},{$cart->price},{$cart->qty},'{$cart->name}','0','{$shop_name}','{$shop_logo}'),";
            }  
            $sql = rtrim($sql,',');
            // dd( $sql);
            
            if(!DB::statement($sql)){
                   return false;  // 修改库存失败
                   die();         // 结束代码执行
            } 

            if ( DB::statement($sql) ) {
                // echo "成功";
                return true;   // 写详情表成功
            } else {
                // echo "失败 ";
               return false;  // 写详情表失败
            }
        }
        
        
       
        
        
        // 4.最后的显示成功订单,清空购物车及订单操作
       
        public function ok(Request $request){
            // 提示订单成功的信息
            // dd($request->session()->all());
            $request->session()->forget('cart');
            $request->session()->forget('order_name');
            $request->session()->forget('order_addr');
            $request->session()->forget('order_tell');
            $request->session()->forget('order_umsg');
            $request->session()->forget('order_total');
            $request->session()->forget('order_count');
            $request->session()->forget('order_id');
               
            // "userLoginFlag" => "true"    用户是否登录
            // "user_id" => "70"            当前登录用户识别

            return view('home.order.ok',compact('request'));
        }


        //详情
        function ordersinfo()
            {
                require('./view/goods/showorders.html');
                
            }
        function showorders()
        {
            //通过 用户 ID 查出 订单 OID
            $orders = DB::Table('orders') -> select(" where uid={$_SESSION['userInfo'] -> uid} ");
            
            
            require('./view/orders/showorders.html');
        }
            function delorders()
         {
            $oid = $_GET['oid'];
            // echo $oid;
            // $res = DB::Table('orders') -> select(" where oid='{$oid}'");
            // echo '<pre>';
            // print_r($res);
            
            $flag = DB::Table('orders') -> delete(" '{$oid}'");
            
            if( $flag ){
                echo '订单取消成功';
                header('refresh:2;url=./index.php?c=orders&a=showorders');die;
            }else{
                echo '订单取消失败';
                header('refresh:2;url=./index.php?c=orders&a=showorders');die;
            }
            
            
         }
        
    }
   
