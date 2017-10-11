@extends('layouts.admin')
@section('content')
<body>
    <!--面包屑导航 开始--> 
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 修改用户
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
           <!--  <h3>快捷操作</h3> --> 
           <!-- 修改失败的提示 -->
            @if(session('msg'))
                <p>{{session('msg')}}</p>
            @endif

        </div>
       <!--  <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div> -->
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/taocan/'.$taocan->taocan_id)}}" method="post">
            <table class="add_tab">
                <tbody>
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <tr>
                        <th>套餐名称：</th>
                        <td>
                            <input type="text" name="taocan_name" value="{{ $taocan ->taocan_name }}">
                           
                        </td>
                    </tr>
                     <tr>
                        <th>套餐价格：</th>
                        <td>
                            ￥ <input type="text" name="taocan_price"value="{{ $taocan ->taocan_price }}"> 元
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>
@endsection