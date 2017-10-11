@extends('layouts.admin')
@section('title','用户列表')
@section('content')
<body> 
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 添加用户
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<!-- <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div> -->
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/taocan')}}" method="post">
            <table class="add_tab">
                <tbody>
                   <!--  <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="">
                                <option value="">==请选择==</option>
                                <option value="19">精品界面</option>
                                <option value="20">推荐界面</option>
                            </select>
                        </td>
                    </tr> -->
                   <!--  <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" class="lg" name="">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr> -->
                    <tr>
                        <th>套餐名称：</th>
                        <td>
                            <input type="text" name="taocan_name" value="最爱柠檬">
                           
                        </td>
                    </tr>
                     <tr>
                        <th>套餐价格：</th>
                        <td>
                            ￥ <input type="text" name="taocan_price"value="100"> 元
                        </td>
                    </tr>
                    
                    <!-- <tr>
                        <th>店铺描述：</th>
                        <td>
                            <textarea name="taocan_desc">新鲜的柠檬,冰镇解暑</textarea>
                        </td>
                    </tr> -->
                    <tr>
                        <th></th>
                        <td>
                        {{csrf_field()}}
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
<!-- </html> -->