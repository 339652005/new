@extends('layouts.home')

@section('content')
    
<div class="constr">
	<div class="constr_in">
    	<div class="mt10 fix">
        <!--1.菜系-->
            <div class="pct20 l">
                <div class="res_home_sch_out">
                    <div class="p15">
                    	<h4 class="cdred f14">菜系</h4>
                    <div class="fix mt20">
                    @foreach($type as $v) 
                        <span class="float_two mb10">
                            <a href="/home/index/type/{{$v ->type_id}}" class="g3 tdl">{{$v ->type_name}}</a>
                        </span>
                    @endforeach       
                    </div>
                    </div>
                </div>
            </div>

            <div class="cell pl10">
            	<div class="bgfb bdc p15">
                <!--广告部分-->
                	<div class="fix">
                        <div class="res_home_other_ad_x">
                            <div id="resTopAdImage" class="res_home_ad_in loading">
	                        <a href="javascript:" class="res_home_ad_a res_other_ad_a"><img width='953px;' class="res_home_ad_img" src="/home/picture/2.jpg" /></a>
                            </div>
                            <span id="resTopAdIndex" class="res_home_ad_index tdn"></span>
                        </div>                                            	
                    </div>
                    <!--精选餐厅 标题栏-->
                    <div class="bdd p1 bgwh mt10">
                    	<div class="res_bg_grad pt2 pb2 pr10 fix">
                        	<span class="l mr5">
                        		<h3 class="res_gre_bias_main ml-1 l">精选餐厅</h3>
                            	<span class="char_corr c08 mt5 pt1 l">◆</span>
                            </span>
                        </div>
                    </div>

                    <!--餐厅列表-->
        <div class="tj mt15 z res_index_other_list_box">
        @foreach($shops as $value)      
        <span class="inline_any res_index_other_list">
        <!-- 商品图片信息 target="_blank" -->
            <span class="db bgwh bdc res_index_other_img">
                <a href="/home/index/{{$value->shop_id}}" title="{{$value->shop_name}}&nbsp;欢迎您来品尝!" >
                    <img class="imgLazy" width='130px' src="/{{$value->shop_logo}}" width="140" height="140" data-url="##" />
                </a>
            </span>
        <!-- 商品名臣     target="_blank" 新页面打开       -->   
            <span class="db bgf0 bbc mt1 pl10 pt5 tl">
            <a href="/home/index/{{$value->shop_id}}" class="b" title="{{$value->shop_name}}&nbsp;欢迎您来品尝!" >{{$value->shop_name}}</a>
            </span>
        <!-- 评分 -->                       
            <span class="db mb2 z">
                <span class="l mt5 pt2">评分：</span>
                    <span>
                        <i class="star_small"><i style="width:80%;" class="star_red"></i></i>
                    <strong class="co">4.0</strong>
                </span>
            </span>
        <!-- 类别 -->
            <span class="db mb2">
                <span>类型：</span>
                <span><a  class='g3' title='更多火锅'>{{$arrType[$value->type_id]}}</a>&nbsp;
                </span>
            </span>
        <!-- 商圈 -->
        <span class="db mb2">
            <span>商圈：</span>
            <span><a  class='g3'>{{$value->shop_addr}}</a></span>
        </span>
        <!-- 描述 -->                     
        <span class="db mb2"><span>描述:</span><br/>{{$value->shop_desc}}</span>

        </span>
        </span>
        @endforeach              	
        <span class="inline_any res_index_other_list"></span>
                        

                    	
                                                        
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection