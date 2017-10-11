@extends('layouts.admin_two')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">角色管理</a> &raquo; 角色列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="{{url('admin/role')}}" method="get">
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
           
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>角色名称</th>
                        <th>角色描述</th>
                        <th>操作</th>
                    </tr>

                    @foreach($roles as $k=>$v)
                    <tr>
                        <td class="tc">{{$v->role_id}}</td>
                        <td>
                            <a href="#">{{$v->role_name}}</a>
                        </td>
                        <td>
                            <a href="#">{{$v->role_descriptin}}</a>
                        </td>
                        <td>
                <!-- 给这个角色(如研发经理)授权 -->
                            <a href="{{url('admin/role/auth/'.$v->role_id)}}">授权</a>
                            <a href="{{url('admin/role/'.$v->role_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->role_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
<div class="page_list" style="margin-left: 450px;">
                    {!! $roles->appends(['keywords' => $input])->render() !!}
                    
                </div>


            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->


    <script>

        function delCate(id){
            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{url('admin/role/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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