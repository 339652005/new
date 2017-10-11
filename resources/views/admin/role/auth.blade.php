@extends('layouts.admin_two')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 添加权限
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
           <!--  <h3>快捷操作</h3> -->
            @if(session('msg'))
                <p>{{session('msg')}}</p>
            @endif
        </div>
        <!-- <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div> -->
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/role/doauth')}}" method="post">
            <table class="add_tab">
                <tbody>
                    {{csrf_field()}}
                    <tr>
                        <th><i class="require">*</i>角色名：</th>
                        <td>
                            {{--获取授权用户--}}
                            <input type="hidden"  name="role_id" value="{{$role->role_id}}">
                            {{$role->role_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>权限：</th>
                        <td>
                            @foreach($permissions as $permission)
                                {{--判断当前的角色ID是不是该用户已经拥有的角色--}}
                                @if(in_array($permission->id,$own_permissions))
                                    <label for=""><input type="checkbox" checked name="permission_id[]" value="{{$permission->id}}">{{$permission->permission_description}}</label>
                                @else
                                    <label for=""><input type="checkbox" name="permission_id[]" value="{{$permission->id}}">{{$permission->permission_description}}</label>
                                @endif
                            @endforeach
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