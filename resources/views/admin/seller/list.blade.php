<!-- <!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]
<title>用户管理</title>
</head> -->
@extends('layouts.admin')
@section('content')
<!-- 分页样式 -->

<link rel="stylesheet" href="{{ asset('admin/css/ch-ui.admin.css') }}">
 <style>
        /*.result_content ul li.disabled{*/

            /*background:blue;*/
        /*}*/
        .result_content ul li span{
            padding:6px 12px;

        }

        #mysubmit{
          margin-right: 500px;
        }
    </style>
<!-- <link rel="stylesheet" href="{{-- asset('admin/css/font-awesome.min.css') --}}"> -->
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商家中心 <span class="c-gray en">&gt;</span> 商家管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <!-- <div class="text-c"> 日期范围：
    <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
    -
    <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
    <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name=""><button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜用户</button>

  </div> -->
<!--结果页快捷搜索框 开始-->
  <div class="search_wrap">
        <form action="{{url('admin/seller')}}" method="get">
            <table class="search_tab">
                <tr>

                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" value="{{$input}}" placeholder="关键字"></td>
                    <td><input type="submit" id="mysubmit" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

  <!-- <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
    <a href="javascript:;" onclick="user_add('550','','添加用户','user-add.html')" class="btn btn-primary radius"><i class="icon-plus"></i> 添加用户</a></span>
    <span class="r">共有数据：<strong>88</strong> 条</span>
  </div> -->
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
        <th width="40">ID</th>
        <th width="60">商家名</th>
        <th width="40">邮箱</th>
        <th width="90">手机</th>
        <th width="30">状态</th>
        <th width="80">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $status=['禁用','启用'];
    ?>
 @foreach($seller as $k=>$v)
      <tr class="text-c">
    
        <td>{{$v->seller_id}}</td>
       
        <td><u style="cursor:pointer" class="text-primary" onclick="user_show('10001','360','','张三','user-show.html')">{{$v->seller_name}}</u></td>
        <td>{{$v->seller_email}}</td>
        <td>{{$v->seller_tell}}</td>
        
        
        
        <td class="user-status"><span class="label label-success">{{ $status[$v->seller_status]}}</span></td>
        
        <td class="f-14 user-manage">

        <!-- <a style="text-decoration:none" onClick="user_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-hand-down"></i>停用</a> -->

         <a title="编辑" href="{{url('admin/seller/'.$v->seller_id.'/edit')}}" onclick="user_edit('4','550','','编辑','user-add.html')" class="ml-5" style="text-decoration:none"><span class="label label-success">编辑</span><i class="icon-edit"></i></a> 
         <!-- <a style="text-decoration:none" class="ml-5" onClick="user_password_edit('10001','370','228','修改密码','user-password-edit.html')" href="javascript:;" title="修改密码"><i class="icon-key"></i>修改密码</a> -->
          <!-- <a title="删除" href="javascript:;"  onclick="delUser({{--$v->user_id--}}" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i>删除</a> -->
          
          <!-- <a href="javascript:;" onclick="delUser({{$v->user_id}})">删除</a> -->
          <a href="javascript:;" onclick="delUser({{$v->seller_id}})"><span class="label label-success">删除</span></a>
        </td>


        <!-- <td>
            <a href="{{--url('admin/user/'.$v->user_id.'/edit')--}}">修改</a>
            
                        </td> -->
      </tr>
 @endforeach
<script>

        function delUser(id){
// alert($);
            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                通过ajax 向服务器发送一个删除请求

//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{url('admin/seller/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
//                    需要将json字符串变成json对象
                    //var data = JSON.parse(data);

//                    JSON.parse(jsonstr); //可以将json字符串转换成json对象
//                    JSON.stringify(jsonobj); //可以将json对象转换成json对符串


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
    </tbody>
<script>

        function delUser(id){

            //询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                通过ajax 向服务器发送一个删除请求

//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{url('admin/seller/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
//                    需要将json字符串变成json对象
                    //var data = JSON.parse(data);

//                    JSON.parse(jsonstr); //可以将json字符串转换成json对象
//                    JSON.stringify(jsonobj); //可以将json对象转换成json对符串


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
  </table>
  <!-- 修改后的分页 -->
  <div class="page_list result_content" style="margin-left: 450px;">
                    {!! $seller->appends(['keywords' => $input])->render() !!}
                    <!-- {--!! $user->render() !!--} 
                </div>

  <div id="pageNav" class="pageNav">
     

  </div>

</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('/admin/hui/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui/js/H-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
window.onload = (function(){
    // optional set
    pageNav.pre="&lt;上一页";
    pageNav.next="下一页&gt;";
    // p,当前页码,pn,总页面
    pageNav.fn = function(p,pn){$("#pageinfo").text("当前页:"+p+" 总页: "+pn);};
    //重写分页状态,跳到第三页,总页33页
    pageNav.go(1,13);
});
$('.table-sort').dataTable({
	"lengthMenu":false,//显示数量选择 
	"bFilter": false,//过滤功能
	"bPaginate": false,//翻页信息
	"bInfo": false,//数量信息
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
	]
});
</script>
</body>
@endsection
<!-- </html> -->
