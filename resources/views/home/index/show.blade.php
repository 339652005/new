@extends('layouts.home')
@section('content')
    
<div class="constr">
	<div class="constr_in">
    	<!-- 面包屑 -->
    	<div class="bread fix">
        	<h4 class="l n"><a href="/" class="g3">首页</a> &gt; <a href="#" class="g3">店铺详情</a> </h4> 
        </div>
      
        <div class="constr_bg">
        	<div class="res_sch_box fix">

            <!-- 左侧 -->
            <div class="res_sch_list brd">
                    <h3 class="res_sch_list_tit">本店套餐</h3>
                    <div class="res_sch_list_box"> 
                        
                    <dl class="res_sch_link_dl grabtn_bg grabtn_bg_l f14" style="width:160px;">
                       
            <!-- 套餐遍历 -->
           
            @foreach($taocan as $value)
                <dd class="res_sch_link_dd">
                <a href="/home/show/{{ $value->taocan_id }}/{{ $shop->shop_id }}" class="res_sch_link_a ">{{ $value->taocan_name }}</a>
                </dd>
            @endforeach  
                    </dl>
                    </div>
           
            <!-- 本店信息 -->
            <h3 class="res_sch_list_tit">本店信息</h3>
            <div class="res_sch_list_box"> 
                <dl class="res_sch_link_dl grabtn_bg grabtn_bg_l f14">
            <!-- 名称 -->
                <dd class="res_sch_link_dd">
                店铺名称: {{ $shop->shop_name }}<span class="g9 ml10"></span>
                </dd>
            <!-- 商圈: -->
                <dd class="res_sch_link_dd">
                商圈: {{ $shop->shop_addr }}<span class="g9 ml10"></span>
                </dd>
            <!-- logo -->
            <dd class="res_sch_link_dd">
                店铺Logo:<br/><img width="120px" height="120px" src="/{{ $shop->shop_logo }}" alt="" /><span class="g9 ml10"></span>
            </dd>
             <!-- 执照 -->
            <dd class="res_sch_link_dd">
                营业执照:<br/><img width="120px" height="120px" src="/{{ $shop->shop_zhizhao }}" alt="" /><span class="g9 ml10"></span>
            </dd>
             <!-- 许可证 -->
            <dd class="res_sch_link_dd">
                卫生许可证:<br/><img width="120px" height="120px" src="/{{ $shop->shop_licence }}" alt="" /><span class="g9 ml10"></span>
            </dd>

                </dl>
            </div>
            <!-- -->
            </div>

            

                <!-- 右主体详细 -->
                <div class="cell pl10 pt10 pr10 bld">
                    <!-- 适合神马神马的餐厅 -->
                    <div class="bgfb">
                      </div>         
                        <div class="p5 pl15 bdc mt10 fix">
                        	<span class="l pt2">公告：欢迎光临我们的小铺</span>
                           
                        </div>
                         
        <?php 
                    $status=['上架','下架','火热','优惠'];
        ?>   
                 
                   
                    
                   
                    <!-- 商品列表详细 -->          
        @foreach($foods as $v)           
                        <div class="res_sch_detail">
                        <ul class="fix pb10 pl10 pr30">
                    	   
                            <li class="pct50 l">
                        	    <div class="l mr20">
        <!-- 1.商品照片 -->
                                    <a href="#" class="img_beauty" >
        <img src="/{{$v->foods_piture}}"  height="90" width="90" />
                                    </a>                              
                                </div>
                                <div class="cell">
                                    <h4 class="pb5">
        <!-- 2.商品名臣 -->
        @if($v->foods_status==1)
             <span style='color:#ccc;'>名称:{{$v->foods_name}}</span><span style='color:black;'>　　暂停供应</span>
        @else
             <a class="f14" href="#" title="{{$v->foods_name}}" >名称:{{$v->foods_name}}</a> 　　
        

        <!-- 
        原始版本
         <a href="/home/cart/{{$v->foods_id}}"><button>加入购物车</button></a> -->

         <!-- 弹层版本 -->
          <a href="javascript:;" onclick="admin_edit('加入购物车','/home/addcart/{{$v->foods_id}}','','1250','600')"><button>加入购物车</button><br/> </a>
        @endif

<script type="text/javascript" src="/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
/*
    参数解释：
    title   标题
    url     请求的url
    id      需要操作的数据id
    w       弹出层宽度（缺省调默认值）
    h       弹出层高度（缺省调默认值）
*/
/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}
</script>







       
       
                                          <span class="g9 pl10 n"></span>              
                                    </h4> 
                                    <div class="pt5 fix"> 
        <!-- 3.价格 -->
        <div class="l">价格：</div><div class="cell"><a href="#"  class="mr5">￥: {{$v->foods_price}} </a></div>
                                    </div>
                                    <div class="pb2 pt5">

                                        <div class="l">状态：</div>
                                  
         <!-- 状态   -->
        <div class="cell">{{$status[$v->foods_status]}}</div>
                                    </div>
                                    <div class="pb2 pt2 fix">
        <!-- 描述 -->
        <div class="l">描述：</div>
                                        <div class="cell"> 
                                        {{$v->foods_desc}}                     
                                        </div>
                                         
                                               
                                    </div>
                                </div>
                            </li> 
                        </ul> 
                    
                        <div class="res_sch_fav_bar g9">
                            <span class="l"></span>
                            <span class="r">
                                <a class="g9 tdl ml5 mr5 impressMore" href="/shop/PostAjax/LoadImpression.ashx?resid=F14H02E39610&from=loadall&rank=">网友印象(<span id="impressNum_F14H02E39610" class="g9">0</span>)</a>  |  <u id="resFavIcon_F14H02E39610" class="u mr2"></u>
                                <a href="/shop/postajax/favourites.ashx?resId=F14H02E39610&userid=0&action=favres&from=list" class="g9 tdl mr5 schResFav" data-resid="F14H02E39610">收藏</a> | <a href="/shop/F14H02E39610/review/add/"  target="_blank" class="g9 tdl ml5">发表点评</a>
                            </span>
                        </div>
                        </div>
        @endforeach  <!-- 食品便利结束-->         
                    
                    
                    <!-- 分页 -->           
                     
                </div>
            </div>
        </div>

 @endsection