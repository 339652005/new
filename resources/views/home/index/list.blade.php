@extends('layouts.home')

@section('content')
    
<div class="constr">
	<div class="constr_in">
    	<div class="mt10 fix">
            <div class="pct20 l">
                <div class="res_home_sch_out">
                	
                    <!--菜系-->
                    <div class="p15">
                    	<h4 class="cdred f14">菜系</h4>
                        <div class="fix mt20">
                            
                            
                 <!-- home/index/type/type_id 首页具体类别下店铺  -->
                 <!-- 注意加上/ 开始否则路由相对叠加 -->
                    @foreach($type as $v) 
                            <span class="float_two mb10"><a href="/home/index/type/{{$v ->type_id}}" class="g3 tdl" ">{{$v ->type_name}}</a></span>
                     @endforeach       
                             
                              
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell pl10">
            	<div class="bgfb bdc p15">
                	<div class="fix">
                        <div class="res_home_other_ad_x">
                            <div id="resTopAdImage" class="res_home_ad_in loading">
	                        <!--广告部分-->
	                        
<script>
// alert($);
    var resHomeAdJson = [{
	src: "0",
	href: "http://www.xiaomishu.com/square/activity/127/?banner=home&camp=weixin"
    },
{
	src: "/home/picture/1.jpg",
	href: "/shop/add/?banner=allcity&camp=addRes"
    },
{
	src: "/home/picture/2.jpg",
	href: "/Award/IntegralDetail.aspx#Comment"
    }];
</script>

	                        <a href="javascript:" class="res_home_ad_a res_other_ad_a"><img width='953px;' class="res_home_ad_img" src="/home/picture/2.jpg" /></a>
                            </div>
                            <span id="resTopAdIndex" class="res_home_ad_index tdn"></span>
                        </div>                                            	
                    </div>
                    <!--标题栏-->
                    <div class="bdd p1 bgwh mt10">
                    	<div class="res_bg_grad pt2 pb2 pr10 fix">
                        	<span class="l mr5">
                        		<h3 class="res_gre_bias_main ml-1 l">精选餐厅</h3>
                            	<span class="char_corr c08 mt5 pt1 l">◆</span>
                            </span>
                            
                           
                            </span>
                        </div>
                    </div>
                    <!--餐厅列表-->
                    <div class="tj mt15 z res_index_other_list_box">
         @foreach($shops as $value)      
                    	<span class="inline_any res_index_other_list">
             <span class="db bgwh bdc res_index_other_img">
<!-- 商品图片信息 target="_blank" -->
             <a href="/home/index/{{$value->shop_id}}" title="一品捞锅物料理&nbsp;祥源广场店" >

             <img class="imgLazy" width='130px' src="/{{$value->shop_logo}}" width="140" height="140" data-url="http://upload3.95171.cn/albumpicimages/20150615/201506/Small/5216e12b-e951-4166-9b13-5f6f684db1ba.jpg" /></a>
             </span>
            <span class="db bgf0 bbc mt1 pl10 pt5 tl">
 <!-- 商品名臣     target="_blank" 新页面打开       -->
            <a href="/home/index/{{$value->shop_id}}" class="b" title="一品捞锅物料理&nbsp;祥源广场店" >{{$value->shop_name}}</a>
                                
                                <span class="db mb2 z">
                                	<span class="l mt5 pt2">评分：</span>
                                    <span>
                                    	<i class="star_small"><i style="width:80%;" class="star_red"></i></i>
                                        <strong class="co">4.0</strong>
                                    </span>
                                </span>
<!-- 类别 -->
                                <span class="db mb2">
                                	<span>类型：</span><span><a href='/shop/search/?type=res&key=%e6%9b%b4%e5%a4%9a%e7%81%ab%e9%94%85' target='_blank' class='g3' title='更多火锅'>{{$arrType[$value->type_id]}}
                                    </a>&nbsp;</span>
                                </span>

        <span class="db mb2">
            <span>商圈：</span><span><a href='/shop/search/rHF_LY_56' target='_blank' class='g3'>{{$value->shop_addr}}</a></span>
        </span>
                                
        <span class="db mb2"><span>描述:</span><br/>{{$value->shop_desc}}</span>

            </span></span>
                        
         
                     @endforeach              	
                     <span class="inline_any res_index_other_list"></span>
                        

                    	
                                                        
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection