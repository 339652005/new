<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

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
       public function jsy()
        {
            // echo '<PRE>';
            // print_r($_POST);die;
            $_SESSION['orders']['rec'] = $_POST['rec'];
            $_SESSION['orders']['tel'] = $_POST['tel'];
            $_SESSION['orders']['addr'] = $_POST['addr'];
            $_SESSION['orders']['umsg'] = $_POST['umsg'];
            
            require('./view/orders/index.html');
        
        }
        
        
        // 最终结账
      public  function finish()
        {
            // 开启事务
            $this -> pdo = new PDO(DSN, USER, UPWD);
            $this -> pdo -> beginTransaction();
            
            //     改库存方法                 写主表方法                写详情表方法
            if ( $this -> updateStock() && $this -> writeOrder() && $this -> writeDetail() ) {
                $this -> pdo -> commit(); // 如果三者都成功,就提交
            } else {
                $this -> pdo -> rollBack();
                echo '提交订单失败';
                header('refresh:2;url=./index.php?c=orders&a=info');
                die;
            }
            
            
            // 善后
            $this -> last();

        
        }
        
        
        // 写入主表
        private function writeOrder()
        {
            $data['oid'] =  $this -> oid =  $_SESSION['orders']['oid'] = date('YmdHis').uniqid();
            $data['ormb'] = $_SESSION['orders']['sum'];
            $data['ocnt'] = $_SESSION['orders']['count'];
            $data['uid'] = $_SESSION['userInfo'] -> uid;
            $data['rec'] = $_SESSION['orders']['rec'];
            $data['tel'] = $_SESSION['orders']['tel'];
            $data['addr'] = $_SESSION['orders']['addr'];
            $data['status'] = 1;
            $data['umsg'] = $_SESSION['orders']['umsg'];
            $data['otime'] = time();
            
            $res = DB::Table('shop_orders') -> insert($data);
            
            if ($res==='0'){
                return true;  // 写主表成功
            } else {
                return false; // 写主表失败
            }
            
        }
    
    
        // 写入详情表
        private function writeDetail()
        {
            // 拼成一条SQL语句
            $sql = "insert into shop_detail(oid,gid,bprice,bcnt) values";
            foreach($_SESSION['cart'] as $k=>$v){
                $sql .= "('{$this->oid}',{$v->gid},{$v->price},{$v->cnt}),";
            }
            $sql = rtrim($sql,',');
            
            
            if ( $this -> pdo -> exec($sql) ) {
               return true;   // 写详情表成功
            } else {
               return false;  // 写详情表失败
            }
        }
        
        
        // 修改库存和销量
        private function updateStock()
        {
        
            foreach($_SESSION['cart'] as $k=>$v){
                $sql = "update shop_goods set stock=stock-{$v->cnt},salecnt=salecnt+{$v->cnt} where gid={$k}";
                if (!$this-> pdo -> exec($sql)){
                   return false;  // 修改库存失败
                   
                }  
            }
            return true; // 修改库存成功
        }
        
        
        // 最后的显示成功订单,清空购物车及订单操作
        private function last()
        {
            // 跳转回首页
            header('refresh:5;url=./index.php?c=first&a=index');
            
            // 提示订单成功的信息
            require('./view/orders/ok.html');
            
            // 清空
            unset($_SESSION['cart']);    
            unset($_SESSION['orders']); 
            //unset($_SESSION['back']); 
            
            
            die;
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
   
