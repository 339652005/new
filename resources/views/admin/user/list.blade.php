
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

<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  
<!--结果页快捷搜索框 开始-->
  <div class="search_wrap">
        <form action="{{url('admin/user')}}" method="get">
            <table class="search_tab">
                <tr>

                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" value="{{$input}}" placeholder="关键字"></td>
                    <td><input type="submit" id="mysubmit" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
   
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
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
    $auth=['青铜会员','白银会员','黄金会员','铂金会员','钻石会员','星耀会员'];
    $status=['禁用','启用'];
    ?>

    
 @foreach($user as $k=>$v)
      <tr class="text-c">
        <!-- <td><input type="checkbox" value="1" name=""></td> -->
        
        <td>{{$v->user_id}}</td>
       
        <td><u style="cursor:pointer" class="text-primary" onclick="user_show('10001','360','','张三','user-show.html')">{{$v->user_name}}</u></td>
        <td>{{$v->user_email}}</td>
        <td>{{$v->user_tell}}</td>
        
        <td>{{$auth[$v->user_auth]}}</td>

         @if($v->user_status==0)
                <td>
                <a  class="ml-5" onClick="changeStatus({{$v->user_id}})" href="javascript:;" title="修改状态"><span class="btn btn-danger radius">{{ $status[$v->user_status]}}</span></a> 
                </td>
            @else
                <td>
                <a  class="ml-5" onClick="changeStatus({{$v->user_id}})" href="javascript:;" title="修改状态"><span class="btn btn-success radius">{{ $status[$v->user_status]}}</span></a>
                </td>
            @endif
        
      
        
        <td class="f-14 user-manage">

      

         <a title="编辑" href="{{url('admin/user/'.$v->user_id.'/edit')}}" onclick="user_edit('4','550','','编辑','user-add.html')" class="ml-5" style="text-decoration:none"><span class="label label-success">编辑</span><i class="icon-edit"></i></a> 
        
       
          <a href="javascript:;" onclick="delUser({{$v->user_id}})"><span class="label label-success">删除</span></a>
        </td>


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
                $.post("{{url('admin/user/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
//                    需要将json字符串变成json对象
                    //var data = JSON.parse(data);

//                    JSON.parse(jsonstr); //可以将json字符串转换成json对象
//                    JSON.stringify(jsonobj); //可以将json对象转换成json对符串


                    if(data.status == 0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6,time:4000});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5,time:4000});
                    }


                })
//

            });
        }

/*2.to show()修改状态*/
    function changeStatus(id){
        layer.confirm('确认要修改状态吗？',function(index){
            $.ajax({
                type: 'GET',
                // to show 
                url: 'user/'+id,
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
                $.post("{{url('admin/user/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
                    {!! $user->appends(['keywords' => $input])->render() !!}
                    <!-- {--!! $user->render() !!--}  -->
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
