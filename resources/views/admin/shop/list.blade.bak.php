@extends('layouts.admin_two')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">店铺管理</a> &raquo; 显示店铺
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="{{url('admin/shop')}}" method="get">
            <table class="search_tab">
                <tr>

                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" value="{{$input}}" placeholder="关键字"></td>
                    <td><input type="submit"  value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <!-- <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增用户</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div> -->
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr >
                        <th class="tc" style="text-align:center;">ID</th>
                       
                        <th style="text-align:center;">店铺名称</th>
                         <th style="text-align:center;">店铺类型</th>
                        <th style="text-align:center;">店铺地址</th>
                        <th style="text-align:center;">店铺坐标</th>
                        <!-- <th style="text-align:center;">用户权限</th> -->
                        <th style="text-align:center;">店铺图片</th>
                        <th style="text-align:center;">店铺执照</th>
                        <th style="text-align:center;">许可证</th>
                        <th width="100" style="text-align:center;">店铺描述</th>
                        

                        <th style="text-align:center;">操作</th>
                    </tr>

                    @foreach($shop as $k=>$v)
                    <?php 
                    // $auth=['普通管理员','高级管理员','超级管理员'];
                    $status=['启用','禁用'];
                    ?>
                     
                    <tr>
                        <td class="tc">{{$v->shop_id}}</td>
                        <td>
                            <a href="#">{{$v->shop_name}}</a>
                        </td>
                         <td>
                            店铺类型{{--$v->type_id--}}
                        </td>
                        <td>{{$v->shop_addr}}</td>
                        <td>{{$v->shop_x}},{{$v->shop_y}}</td>
                        
                        <td>{{$v->shop_logo}}</td>
                        <td>{{$v->shop_zhizhao}}</td>
                        <td>{{$v->shop_licence}}</td>
                        <td>{{$v->shop_desc}}</td>

                        
                        
                        <td>
                            <a href="{{url('admin/shop/'.$v->shop_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delshop({{$v->shop_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list" style="margin-left: 450px;">
                    {!! $shop->appends(['keywords' => $input])->render() !!}
                    <!-- {--!! $shop->render() !!--} -->
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span{
            padding:6px 12px;
        }
    </style>
    <script>
        function delshop(id){
// alert($);
            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                $.post("{{url('admin/shop/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                    if(data.status == 0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5});
                    }
                })
            });
        }
    </script>


</body>
@endsection