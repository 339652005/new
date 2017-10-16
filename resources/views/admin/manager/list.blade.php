<!-- <!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" /> -->
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->

<!--[if IE 6]> 
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('/admin/hui/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/hui/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/hui/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/hui/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/hui/static/h-ui.admin/css/style.css')}}" />



@extends('layouts.admin')
@section('content')
 
<!-- </head> -->
<title>管理员列表</title>
<!-- </head> -->


<link rel="stylesheet" type="text/css" href="/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/hui/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/hui/static/h-ui.admin/css/style.css" />

<script type="text/javascript" src="{{asset('/admin/hui/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui/js/H-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/hui/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/hui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/hui/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/admin/js/jquery-1.8.3.min.js"></script>

 <!-- 分页样式 -->
<link rel="stylesheet" href="{{ asset('admin/css/ch-ui.admin.css') }}">
<style>
        /*.result_content ul li.disabled{*/

            /*background:blue;*/
        /*}*/
        .result_content ul li span{
            padding:6px 12px;

        }

      
    </style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<!-- <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button> -->
	<!--  <span class="select-box inline">
		<select name="" class="select">
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> 日期范围： -->
		<!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		- -->
		<!-- <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;"> -->
		
		
	</div>
	<!-- <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加资讯" data-href="article-add.html" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div> -->

	<!--结果页快捷搜索框 开始-->
  <div class="search_wrap">
        <form action="{{url('admin/manager')}}" method="get">
            <table class="search_tab">
                <tr>

                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" id="" value="{{$input}}" placeholder=" 管理员名称" style="width:250px" class="input-text">
                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜管理员</button>
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>

	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<!-- <th width="25"><input type="checkbox" name="" value=""> --><!-- </th>
					<th width="80">ID</th> -->

  
		<th width="40">ID</th>
        <th width="60">用户名</th>
        <th width="40">邮箱</th>
       
        <th width="90">手机</th>
         
        <th width="40">权限</th>
        <th width="30">状态</th>
       
        <th width="80">操作</th>
				</tr>
			</thead>
			<tbody>
	<?php 
    	$auth=['普通管理员','高级管理员','超级管理员'];
    	$status=['禁用','正常'];
    ?>

    
	@foreach($manager as $k=>$v)
				<tr class="text-c">

					<!-- <td><input type="checkbox" value="" name=""></td> -->

					<td>
					{{$v->manager_id}}
					</td>

					<td class="text-l">
					{{$v->manager_name}}
					<u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看"></u>
					</td>

					<td>{{$v->manager_email}}</td>

					<td>{{$v->manager_tell}}</td>
	<!-- 管理员权限laber颜色 -->
	@if($v->manager_auth == '0') 
	<!-- 颜色不对laber-success -->
		<td><span class="label laber-success radius">{{ $auth[$v->manager_auth]}}</span></td>
	@elseif($v->manager_auth == '1') 
	<!-- 蓝色 -->
		<td><span class="label label-primary radius">{{ $auth[$v->manager_auth]}}</span></td>
	@elseif($v->manager_auth == '2') 
	<!-- 红色 -->
		<td><span class="label label-danger radius">{{ $auth[$v->manager_auth]}}</span></td>
	@endif

		
<!-- 状态按钮颜色处理 说明:self在无权利大条件下(等权) -->
		@if($v->manager_auth >= $self->manager_auth )
			<!-- isSelf -->
			@if($v->manager_id == $self->manager_id)
				<td><span class="label  radius" >当前用户</span></td>
				<td><span class="label  radius" >当前用户</span></td>
			@else
				<!-- 1-1 无权利改状态 -->
				<td><span class="btn  radius" style='cursor:text;background-color: #999;display: inline-block;font-size: 11.844px;font-weight: bold;color: #fff;overflow: hidden;padding: 2px 4px;vertical-align: middle;white-space: nowrap;line-height:25px;'>　{{ $status[$v->manager_status]}}&nbsp;&nbsp;&nbsp;</span></td>
				<!-- 1-2 无权利操作 -->
				<td><span class="label  radius" >&nbsp;无&nbsp;操&nbsp;作&nbsp;</span></td>
			@endif  <!-- end of the isSelf -->
		@elseif($v->manager_auth < $self->manager_auth )
		<!-- 2-1 有权利改状态 to show()-->
			@if($v->manager_status==0)
				<td>
				<a  class="ml-5" onClick="changeStatus({{$v->manager_id}})" href="javascript:;" title="修改状态"><span class="btn btn-danger radius">{{ $status[$v->manager_status]}}</span></a> 
				</td>
			@else
				<td>
				<a  class="ml-5" onClick="changeStatus({{$v->manager_id}})" href="javascript:;" title="修改状态"><span class="btn btn-success radius">{{ $status[$v->manager_status]}}</span></a>
				</td>
			@endif
		<!-- 2-2 有权操作 -->
			<td class="f-14 td-manage">
					<a  class="ml-5" onClick="article_edit('修改管理员信息','{{url('admin/manager/'.$v->manager_id.'/edit')}}',{{$v->manager_id}})" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
					
					<a style="text-decoration:none" class="ml-5" onClick="delUser({{$v->manager_id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>

			</td>
		@endif
		</tr>
 @endforeach
			</tbody>
		</table>

	<script type="text/javascript">
		/* 1. 删除数据 */
        function delUser(id){
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] 
            }, function(){
                $.post("{{url('admin/manager/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                    if(data.status == 0){
                    	// 定时刷新
                    	setInterval(function(){
                    		location.href = location.href;
                    	}, 2000);
                        // 显示提示
                        layer.msg(data.msg, {icon: 6,time:2000});
                    }else{
                    	setInterval(function(){
                    		location.href = location.href;
                    	}, 2000);
                        layer.msg(data.msg, {icon: 5});
                    }
                });  // 方法体
            });      // ajax
        }
     /*2.to show()修改状态*/
	function changeStatus(id){
		layer.confirm('确认要修改状态吗？',function(index){
			$.ajax({
				type: 'GET',
				// to show 
				url: 'manager/'+id,
				dataType: 'json',
				success: function(data){
					// 定时刷新
					layer.msg(data.msg,{icon:1,time:1000});
	                setInterval(function(){
	                    location.href = location.href;
					// layer.msg(data.msg, {icon: 1,time:3000});
	                }, 1000);
				},
				error:function(data) {
					// 定时刷新
					 layer.msg(data.msg,{icon:2,time:1000});
	                setInterval(function(){
	                    location.href = location.href;
					    // layer.msg(data.msg,{icon:2,time:3000});
	                }, 1000);
					
				},
			});		
		});
	}
	// 3.修改管理员信息
	function article_edit(title,url,id,w,h){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	</script>		

		
		
 <!-- 修改后的分页 -->
    <div class="page_list result_content" style="margin-left: 450px;">
                    {!! $manager->appends(['keywords' => $input])->render() !!}
    </div>


	</div>
</div>

<script type="text/javascript">
// alert($);
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"pading":false,
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);

}

/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				// $(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				// console.log(data.msg);
			},
		});		
	});
}

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}



    

</script> 
</body>
<!-- </html> -->
@endsection
<!-- </html>