<!-- <!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
[if lt IE 9]>
<script type="text/javascript" src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
<script type="text/javascript" src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/css3pie/2.0beta1/PIE_IE678.js"></script>
<![endif]
<link type="text/css" rel="stylesheet" href="css/H-ui.css"/>
<link type="text/css" rel="stylesheet" href="css/H-ui.admin.css"/>
<link type="text/css" rel="stylesheet" href="font/font-awesome.min.css"/>
[if IE 7]>
<link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]
<title>修改密码</title>
</head> -->
@extends('layouts.admin')
@section('content')
<body>

 @if (count($errors) > 0)
            <div class="alert alert-danger input-text size-L" style="color:red;">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                @else
                      <li>{{ $errors }}</li>
                @endif
            </ul>
            </div>
        @endif
     <div class="pd-20">   
  <form class="Huiform" action="{{url('admin/user/'.$user->user_id)}}" method="post">
    <table class="table">
      <tbody>
        <tr>
          <th width="100" class="text-r"><span class="c-red">*</span> 用户名：</th>
            <td><input readonly type="text" style="width:200px" class="input-text" value="{{$user->user_name}}" placeholder="请输入用户名" id="user-name" name="user_name" datatype="*2-16" nullmsg="用户名不能为空">* 只读 </td> 
          </tr>
          <!-- <tr>
            <th class="text-r"><span class="c-red">*</span> 性别：</th>
            <td><label>
                <input name="sex" type="radio" id="six_1" value="1" checked>
                男</label>
              <label>
                <input type="radio" name="sex" value="0" id="six_0">
                女</label></td>
          </tr> -->
          <!-- <tr>
            <th class="text-r"><span class="c-red">*</span> 密码：</th>
            <td><input type="password" style="width:300px" class="input-text" value="admin" placeholder="" id="user-tel" name="manager_pwd"></td>
          </tr>
          <tr>
            <th class="text-r">确认密码：</th>
            <td><input type="password" style="width:300px" class="input-text" value="admin" placeholder="" id="user-email" name="manager_repwd"></td>
          </tr> -->
          <tr>
            <th class="text-r"><span class="c-red">*</span> 手机：</th>
            <td><input type="text" style="width:300px" class="input-text" value="{{$user->user_tell}}" placeholder="" id="user-tel" name="user_tell"></td>
          </tr>
          <tr>
            <th class="text-r">邮箱：</th>
            <td><input type="text" style="width:300px" class="input-text" value="{{$user->user_email}}" placeholder="" id="user-email" name="user_email"></td>
          </tr>
          <!-- <tr>
            <th class="text-r">头像：</th>
            <td><input type="file" class="" name="" multiple></td>
          </tr> -->
         <!--  <tr>
            <th class="text-r">地址：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-address" name="user-address"></td>
          </tr>
          <tr>
            <th class="text-r">简介：</th>
            <td><textarea class="input-text" name="user-info" id="user-info" style="height:100px;width:300px;"></textarea></td>
          </tr> -->

          <!-- 状态默认为启用0 -->
           <?php 
    $auth=['青铜会员','白银会员','黄金会员','铂金会员','钻石会员','星耀会员'];
    $status=['禁用','启用'];
    ?>
          
          <tr>
            <th class="text-r"><span class="c-red">*</span> 会员等级：</th>
             <td>
                            <label for=""><input type="radio" name="user_auth" value="0" 
                             @if($user->user_auth=='0')
                             checked
                             @endif
                             >青铜会员　</label>
                            <label for=""><input type="radio" name="user_auth" value="1" 
                            @if($user->user_auth=='1')
                             checked
                             @endif
                             >白银会员　</label>

                             <label for=""><input type="radio" name="user_auth" value="2" 
                            @if($user->user_auth=='2')
                             checked
                             @endif
                             >黄金会员　</label>
                             <label for=""><input type="radio" name="user_status" value="3" 
                            @if($user->user_auth=='3')
                             checked
                             @endif
                             >铂金会员　</label>

                             <label for=""><input type="radio" name="user_auth" value="4" 
                            @if($user->user_auth=='4')
                             checked
                             @endif
                             >钻石会员　</label>
                             <label for=""><input type="radio" name="user_auth" value="5" 
                            @if($user->user_auth=='5')
                             checked
                             @endif
                             >星耀会员　</label>
                        </td>
          </tr> 
           <!-- 状态默认为启用0 -->
          <tr>
            <th class="text-r"><span class="c-red">*</span> 状态：</th>
            <td><label>
                <input name="user_status" type="radio" id="six_1" value="1"    @if($user->user_status=='1')
                             checked
                             @endif>
                启用</label>
              <label>
                <input type="radio" name="user_status" value="0" id="six_0" 
                @if($user->user_status=='0')
                             checked
                             @endif>
                禁用</label></td>
          </tr> 
<!-- 默认使用最低的权限 -->
        
        <tr>
          <th></th>
           {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
          <td><button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
<script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
<!-- </html> -->
@endsection