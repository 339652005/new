@extends('layouts.admin_two')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">店铺管理</a> &raquo; 修改店铺信息
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
        <form action="{{url('admin/shop/'.$shop->shop_id)}}" method="post">
            <table class="add_tab">
                <tbody>
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                     <tr>
                        <th>店铺名：</th>
                        <td>
                            <input type="text" name="shop_name" value="{{$shop->shop_name}}">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
                        </td>
                    </tr>
                    <tr>
                        <th>店铺类型：</th>
                        <!-- <td>
                            <input type="text" name="shop_name" value="{{$shop->shop_name}}">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> 
                        </td> -->
                    </tr>
                     <tr>
                        <th>店铺地址：</th>
                        <td>
                            <input type="text" name="shop_addr"value="{{$shop->shop_addr}}">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
                        </td>
                    </tr>
                     <tr>
                        <th>地址坐标</th>
                        <td>
                            X: <input type="text" name="shop_x" value="{{$shop->shop_x}}">
                            Y: <input type="text" name="shop_y" value="{{$shop->shop_y}}">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
                        </td>
                    </tr>
                      <tr>
                        <th>店铺描述：</th>
                        <td>
                            <textarea name="shop_desc">{{$shop->shop_desc}}</textarea>
                        </td>
                    </tr>

                      <tr>
                        <th><i class="require">*</i>店铺logo：</th>
                        <td><input type="file" name="shop_logo"></td>
                    </tr>
                       
                     <tr>
                        <th><i class="require">*</i>营业执照：</th>
                        <td><input type="file" name="shop_zhizhao"></td>
                    </tr>


                    <tr>
                        <th><i class="require">*</i>经营许可证：</th>
                        <td><input type="file" name="shop_licence"></td>
                    </tr>

                    <?php 
                    
                    $status=['开店审核','正在营业','休息时间','店铺关闭'];
                    ?>
                    <tr>
                        <th>用户状态：</th>
                        <td>
                            <label for=""><input type="radio" name="shop_status" value="0" 
                            @if($shop->shop_status=='0')
                             checked
                            @endif
                            
                             >开店审核</label>
                            <label for=""><input type="radio" name="shop_status" value="1" 
                            @if($shop->shop_status=='1')
                             checked
                             @endif
                             
                             >正在营业</label>
                             <label for=""><input type="radio" name="shop_status" value="2" 
                             @if($shop->shop_status=='2')
                             checked
                             @endif
                             >休息时间</label>
                            <label for=""><input type="radio" name="shop_status" value="3" 
                            @if($shop->shop_status=='3')
                             checked
                             @endif
                             
                             >店铺关闭</label>
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