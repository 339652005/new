@extends('layouts.home')

@section('content')
	<title>订单结算</title>
	<style>
	    body{margin:0px;padding:0px;}
		#top{background-color:#F1F1F1;}
		#top-m{width:990px;margin:0px auto;font-size:12px;line-height:30px;color:#6A6A6A;}
		#top-m:after{content:'';display:block;clear:both;}
		#top-m-l{float:left;}
		#top-m-r{float:right;}
		#top-img{display:block;margin:0px auto;width:990px;margin-bottom:10px;}
		#order{margin:0px auto;width:990px;border:1px solid #f0f0f0;}
		#o-title{font-size:14px;float:left;height:40px;line-height:40px;text-indent:20px;font-weight:bold;}
		#o-add{font-size:13px;float:right;height:40px;line-height:40px;margin-right:20px;text-decoration:none;color:#005EA7;}
		#o-addr{margin-left:40px;margin-top:10px;border:2px solid #E4393C;display:inline-block;padding:5px 50px;position:relative;}
		#o-addr>i{position:absolute;right:0px;bottom:0px;border:1px solid #e4393c;border-width:7px;border-color:transparent #E4393C #E4393C transparent;}
		#o-addr>b{position:absolute;right:0px;bottom:-3px;color:white;}
		#o-name{height:50px;margin-left:20px;}
		#o-addres{margin-left:17px;}
		#o-tel{margin-left:17px;}
		#o-line{width:900px;margin:35px auto 0px auto;border:1px solid #f0f0f0;}
		#o-shqd{float:left;height:30px;margin-left:43px;line-height:50px;font-size:14px;font-weight:bold;}
		#o-jgsm{float:right;height:30px;margin-right:45px;line-height:50px;font-size:14px;}
		#o-content{width:910px;margin:0px auto;clear:both;margin-top:40px;background-color:#F7F7F7;}
		#o-content::after{content:'';display:block;clear:both;}
		/*#o-content-l{height:100%;background-color:pink;float:left;}*/
		#opcon{float:right;width:580px;background-color:white;}
		#opcon::after{content:'';display:block;clear:both;}
		.o-con-d{width:580px;height:150px;float:right;background-color:#F3FBFE;margin-bottom:3px;}

		.o-pic{float:left;margin-top:27px;margin-left:20px;}
		.o-m{width:288px;float:left;}
		.o-name{display:inline-block;width:270px;margin-top:27px;margin-left:10px;font-size:14px;}
		.o-tui{margin-top:12px;margin-left:10px;display:block;text-indent:20px;height:30px;line-height:30px;font-size:13px;color:#FF6C00;background:url('./images/purchase-icon.png') no-repeat 0px -79px;}
		.o-price{float:left;height:50px;line-height:70px;margin-right:20px;color:#E4393C;font-weight:bold;}
		.o-cnt{float:left;height:50px;line-height:70px;margin-right:20px;}
		.o-state{float:left;height:50px;line-height:70px;}

		#o-za{width:990px;margin:0px auto;}
		#o-zafei1{width:128px;float:right;height:100px;margin-right:42px;text-align:right;}
		#o-zafei2{width:198px;float:right;height:100px;text-align:right;}
		.o-zafei{margin-top:7px;}
		#o-end{width:990px;height:80px;background-color:#F4F4F4;margin:0px auto;border-radius:3px;margin-top:5px;text-align:right;}
		#o-end>div{line-height:40px;padding-right:40px;}
		#o-end1>b{color:#E4393C;}
		#o-end2{font-size:13px;}
		#o-submit{float:right;width:135px;height:36px;background:url('./images/btn-submit.jpg') no-repeat;margin-right:48px;margin-top:10px;}
		#o-final{width:990px;margin:0px auto;height:100px;height:86px;}



		 /*底 部*/
			     #bottom{height:100px;background-color:#F5F5F5;}
			     #b_m{margin:0px auto;width:1210px;}
			     #b_m>img{float:left;margin-left:10px;margin-top:20px;margin-right:72px;}
			     #footer{margin:0px auto;width:1210px;height:300px;}
			     #footer dl{float:left;margin-right:120px;}
			     #footer dt{height:30px;}
			     #footer dd{font-size:12px;margin-left:0px;line-height:20px;} 
	</style>
<!-- </head> -->
<body>
	
	<img id='top-img' src="/home/images/top.png" alt="">
	<div id='order'>
		 <span id='o-title'>收货人信息</span>
		 <a href='#' id='o-add'>收货地址</a>
		 <div style='clear:both;'></div>
		 <span id='o-addr'>外卖信息<i></i><b>v</b></span>
		 <span id='o-name'>{{ session('order_name') }}</span>
		 <span id='o-addres'>{{ session('order_addr') }}</span>
		 <span id='o-tel'>{{ session('order_tell') }}</span>
		 <div id='o-line'>{{ session('order_addr') }}</div>
		 <span id='o-shqd'>送货清单</span>
		 <span id='o-jgsm'>外卖订餐信息一览表</span>
		 <div id='o-content'>
		    
		     	<img src="/home/images/wexinqc100@2x.393ade.png" alt="">
		     	
		@foreach( $carts as $cart)	
		
           <!--  # code...
             print_r($cart->name); 
             print_r($cart->id); 
             print_r($cart->price); 
            
             print_r($cart->options->shop->shop_name); // shop对象 -->
             
		 	   <div id='opcon'>
				 	<div class='o-con-d'>
				 		<img width="100" height="120" style="border:3px #ccc solid;" class='o-pic' src="/{{$cart->options->piture}}" alt="">
				 		<div class='o-m'>
					 		<span class='o-name'>{{$cart->name}}
					 		</span>
					 		<span class='o-tui'>{{$cart->options->shop->shop_name}}</span>
				 		</div>
				 		<!-- 单品件数 -->
				 		<span class='o-price'>￥{{$cart->price}}</span>
				 		<span class='o-cnt'>x {{$cart->qty}}　=　{{$cart->price*$cart->qty}}</span>
				 		<span class='o-cnt'>获得积分:{{$cart->price*$cart->qty*0.1}}</span>
				 		
				 	</div>
			 	</div>
		@endforeach
			 	 <!-- <div id='opcon'>
			 	 
			 	 				 	<div class='o-con-d'>
			 	 				 		<img class='o-pic' src="/home/images/2.png" alt="">
			 	 				 		<div class='o-m'>
			 	 					 		<span class='o-name'>
			 	 					 		   希捷(SEAGATE)2TB 7200转64M SATA3 台式机硬盘(ST2000DM001)
			 	 					 		</span>
			 	 					 		<span class='o-tui'>7天无理由退货</span>
			 	 				 		</div>
			 	 				 		<span class='o-price'>￥479.00</span><span class='o-cnt'>x1</span><span class='o-state'>有货</span>
			 	 				 	</div>
			 	 			 	</div> -->

		 	</div>	
		 	<div style='clear:both;'></div>	 
		 </div>
		 <div id='o-za'>
		 	 <div id='o-zafei1'>
		 	 <!-- 总金额 -->
		 	 	<div class='o-zafei'>￥　{{ $total }}</div>
		 	 	<div class='o-zafei'>-￥0.00</div>
		 	 	<div class='o-zafei'>￥0.00</div>
		 	 	<div class='o-zafei'>￥0.00</div>
		 	 </div>
		 	 <div id='o-zafei2'>
		 	 	<div class='o-zafei'>{{$count}}　件商品，总商品金额：</div>
		 	 	<div class='o-zafei'>返现：</div>
		 	 	<div class='o-zafei'>运费：</div>
		 	 	<div class='o-zafei'>服务费：</div>
		 	 </div>
		 	 <div style='clear:both;'></div>
		 	 <div id='o-end'>
		 	<div id='o-zafei'><span>应付总额：</span> <b>￥　{{ $total }}</b></div>
		 	<!-- <div id='o-zafei'><span>寄送至： 北京 昌平区 六环以内 回龙观育龙教育园区兄弟连</span>&nbsp;&nbsp;<span>收货人：景水 135****2258</span></div> -->
		 </div>
		  <div id='o-final' >
		 	<a style="background-color:red;font-size:20px;text-align:center;line-height:30px;font-weight:;" id='o-submit' href="/home/finish"> 去支付 </a>

		 	<!-- <form action="/home/finish">
		 		<input type="text" name="" value="">
		 		<input type="text" name="" value="">
		 		<input type="text" name="" value="">
		 		<input type="text" name="" value="">
		 		<input type="text" name="" value="">
		 	</form> -->
		 
		 </div>
		 
		 </div>
		 
		 @endsection
<!-- 	    
</body>
</html> -->