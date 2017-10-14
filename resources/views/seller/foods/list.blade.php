@extends('layouts.admin_two')
@section('content')

<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 显示店铺商品
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始--> 
	<div class="search_wrap">
        <form action="{{url('seller/foods')}}" method="get">
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
                        <th style="text-align:center;">菜品名称</th>
                        <th style="text-align:center;">所属套餐类别</th>
                         <th style="text-align:center;">商品销量</th>
                        <th style="text-align:center;">商品价格</th>
                        <th style="text-align:center;">商品描述</th>
                        <th style="text-align:center;">商品照片</th>
                        <th style="text-align:center;">商品状态</th>
                        <th style="text-align:center;">操作</th>
                    </tr>
                    @foreach($foods as $k=>$v)
                    <?php 
                    $status=['上架','下架','火热','优惠'];
                    ?>
                    <tr>
                        <td class="tc">{{$v->foods_id}}</td>
                        <td>{{$v->foods_name}}</td>
                       
                        <td>{{ $arrType[$v->taocan_id] }}</td>
                         <td>{{$v->foods_sales}}</td>
                        <td>{{$v->foods_price}}</td>
                        <td>{{$v->foods_desc}}</td>
                        
                        <td><img style="width:100px;height:120px;" src="/{{$v->foods_piture}}" alt=""></td>
                        <td>{{$status[$v->foods_status]}}</td>
                        <td>
                            <a href="{{url('seller/foods/'.$v->foods_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delUser({{$v->foods_id}})">删除</a>

                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list" style="margin-left: 450px;">
                    {!! $foods->appends(['keywords' => $input])->render() !!}
                    
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

        function delUser(id){
// alert($);
            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//               
                $.post("{{url('seller/foods/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
//                   

                    if(data.status == 0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5});
                    }


                })
//

            });
        }

    </script>

    


</body>
@endsection