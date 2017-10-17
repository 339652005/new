
@extends('layouts.home')

@section('content')
    

<!--首页最新改版-->

    
<div class="constr">
	<div class="constr_in">
    	<!-- 面包屑 -->
    	<div class="bread fix">
        	<h4 class="l n"><a href="/" class="g3">首页</a> &gt; <a href="/shop/search/" class="g3">餐厅预订</a> &gt; 餐厅搜索列表(121)</h4>
            <div class="r">
			    <!-- Baidu Button BEGIN -->
		        <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
		        <span class="bds_more">分享到：</span>
		        <a class="bds_qzone"></a>
		        <a class="bds_tsina"></a>
		        <a class="bds_tqq"></a>
		        <a class="bds_renren"></a>
		        </div>
		        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
		        <script type="text/javascript" id="bdshell_js"></script>
		        <script type="text/javascript">
		            var bds_config = { 'bdText': '我找到了！我在订餐小秘书上发现了好多人气超旺的合肥特色餐厅，里面各种美食看的我好馋啊，有时间一起尝一尝？', 'searchPic': '1' };
		            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
		        </script>
		        <!-- Baidu Button END -->
		    </div>
        </div>
      
        <div class="constr_bg">
        	<div class="res_sch_box fix">
            	<div class="res_sch_list brd">
                    
                  
                     <h3 class="res_sch_list_tit">个人中心</h3>
                    <!-- 订单 -->
                    <h3 class="res_sch_list_tit">我的订单</h3>
                    <div class="res_sch_list_box"> 
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;最近三个月订单</a></dt>
                        </dl>
                         <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;待评价订单</a></dt>
                        </dl>
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;退单记录</a></dt>
                        </dl>
                    
                    </div>
                    <!-- 我的资产 -->
                     <h3 class="res_sch_list_tit">我的资产</h3>
                    <div class="res_sch_list_box"> 
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;我的红包</a></dt>
                        </dl>
                         <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;账户余额</a></dt>
                        </dl>
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;我的积分</a></dt>
                        </dl>
                    
                    </div>
                      <!-- 收藏店铺 -->
                   
                    <h3 class="res_sch_list_tit">收藏店铺</h3>
                    <div class="res_sch_list_box"> 
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;我的收藏</a></dt>
                        </dl>
                         <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;浏览历史</a></dt>
                        </dl>
                    
                    </div>
                      <!-- 收藏店铺 -->
                   
                    <h3 class="res_sch_list_tit">我的资料</h3>
                    <div class="res_sch_list_box"> 
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;个人资料</a></dt>
                        </dl>
                         <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;地址管理</a></dt>
                        </dl>
                    <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;安全中心</a></dt>
                        </dl>
                        <dl class="res_sch_link_dl">
                            <dt class="res_sch_link_dt"><a href="/shop/search-rHF_LY_56/" class="res_sch_link_a">&laquo;&nbsp;修改密码</a></dt>
                        </dl>
                    </div>


                </div>
                <!-- 右主体详细 -->
                <div class="cell pl10 pt10 pr10 bld">
                    <div class="bgfb">
                         
                    <!-- 特色服务 -->
                     
                      </div>
                       

                    <!-- 列表详细 -->          
                    

@foreach($orders as $order)

                        <div class="res_sch_fav_bar g9">
                        <span style="font-size: 16px;margin-bottom: 5px;color: #333;" class="l">{{date('m - d',$order->order_time)}} 　　</span>
                        <span style="padding-right:20px;font-size: 12px;font-weight: 700;margin-bottom: 5px;color: #999;" class="l">{{date('H:i',$order->order_time)}}　|</span>
                            <span style="padding-right:20px;" class="l">订单号: {{$order->order_id}}　|</span>  
                            <span style="padding-right:20px;" class="l">收货人: {{$order->order_name}}　|</span>  
                            <span style="padding-right:20px;" class="l">总数量: {{$order->order_count}}　|</span> 
                            <span style="padding-right:20px;" class="l">总金额: {{$order->order_total}}　|</span>
                            <span class="r">
                                  |  <u  class="u mr2"></u>
                                <a href="" class="g9 tdl mr5 schResFav" data-resid="F35D18C25643">收藏</a> | <a href=""  class="g9 tdl ml5">发表点评</a>
                            </span>

                        </div>

    <!--  -->
<!-- // 获取详细订单 -->
<?php
  $details = DB::table('dc_detail')->where('order_id',$order->order_id)->get();
?>
@foreach($details as $detail)                    

                        <div class="res_sch_detail">

                    <ul class="fix pb10 pl10 pr30" style="padding-left:110px;" >

                       







<!-- $orders = DB::table('dc_orders')->where('user_id',$user_id)->get(); -->
                    <li class="pct50 l">
                            <!-- 图片 -->
                            
                        	   
                                <div class="l mr20"　style='margin-left:40px;'>
                                    <a href="/shop/F14H02E39610/" class="img_beauty" target="_blank">
                                        <img src="/{{$detail->shop_logo}}" alt="汉堡王 合肥欢乐颂店" height="90" width="90" />
                                    </a>
                                </div>

                                <div class="cell">
                                    <h4 class="pb5">
                                        <a class="f14" href="javascript:;" title="{{$detail->foods_name}}" target="_blank">{{$detail->foods_name}}</a>
                                             
                                          <span class="g9 pl10 n"></span>                                                                          
                                    </h4> 
                                    <div class="pt5 fix"> 
                                        <div class="l">卖家：</div><div class="cell">{{$detail->shop_name}}</div>
                                    </div>
                                    <div class="pb2 pt5">
                                        <div class="l">地址：</div>
                                        <div class="cell">{{$order->order_addr}}</div>
                                    </div>
                                    <div class="pb2 pt2 fix">
                                        <div class="l">价格：</div>
                                        <div class="cell"> ¥ {{$detail->bprice}}　 X {{$detail->bcnt}}                     
                                        </div>
                                    </div>
                                </div>
                    </li>     
                           
                    <li class="cell tc">
                        	    <div class="w200 inline_any tl">
                                    <div class="pb2"><i class="star_mid vimg"><i style="width:64%;" class="star_red"></i></i><strong class="res_o_list co ml10">3.2</strong></div>

                                    
            @if($detail->order_status=='0')
                <p class="g9"><span style='color:red;'>发货中</span>  已送达 </p>
            @else
                 <p class="g9">发货中  <span style='color:red;'>已送达</span> </p>
            @endif
                                   
                                    <div class="btd pt5 mt10">
                                	    口味：<strong class="co mr10">3.4</strong>
                                        环境：<strong class="co mr10">3.4</strong>
                                        服务：<strong class="co">3.4</strong>
                                    </div>

                                </div>
                    </li> 
                          
                </ul> 
                   
                        </div>

                         <!-- 描述高亮 -->
  @endforeach                          
 @endforeach 

                </div>
            </div>
        </div>
       
@endsection