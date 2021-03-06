
@extends('layouts.admin')
@section('content')
  
<!-- </head> -->
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
  <div class="Huiform">
   

    <form action="{{url('admin/user')}}" method="post">
      <table class="table table-bg">
        <tbody>
          <tr>
            <th width="100" class="text-r"><span class="c-red">*</span> 用户名：</th>
            <td><input type="text" style="width:200px" class="input-text" value="user{{rand(1111,9999)}}" placeholder="请输入用户名" id="user-name" name="user_name" datatype="*2-16" nullmsg="用户名不能为空"></td>
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
          <tr>
            <th class="text-r"><span class="c-red">*</span> 用户密码：</th>
            <td><input type="password" style="width:300px" class="input-text" value="user" placeholder="" id="user-tel" name="user_pwd"></td>
          </tr>
          <tr>
            <th class="text-r">确认密码：</th>
            <td><input type="password" style="width:300px" class="input-text" value="user" placeholder="" id="user-email" name="user_repwd"></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 手机：</th>
            <td><input type="text" style="width:300px" class="input-text" value="176{{rand(11111111,99999999) }}" placeholder="" id="user-tel" name="user_tell"></td>
          </tr>
          <tr>
            <th class="text-r">邮箱：</th>
            <td><input type="text" style="width:300px" class="input-text" value="{{rand(111111111,999999999)}}@qq.com" placeholder="" id="user-email" name="user_email"></td>
          </tr>
          <tr>
            <th class="text-r">头像：</th>
            <td><input type="file" class="" name="user_face" multiple></td>
          </tr>
          <!-- <tr>
            <th class="text-r">地址：</th>
            <td><input type="text" style="width:300px" class="input-text" value="" placeholder="" id="user-address" name="user-address"></td>
          </tr> -->
          <tr>
            <th class="text-r">会员等级</th>
            <td>
<label for=""><input type="radio" checked name="user_auth" value="0" >青铜会员　</label>
<label for=""><input type="radio" name="user_auth" value="1" >白银会员　</label>
<label for=""><input type="radio" name="user_auth" value="2"  >黄金会员　</label>
<label for=""><input type="radio" name="user_auth" value="3">铂金会员　</label>
<label for=""><input type="radio" name="user_auth" value="4">钻石会员　</label>
<label for=""><input type="radio" name="user_auth" value="5" >星耀会员　</label>
            </td>
          </tr>

          <!-- 状态默认为启用0 -->
          <tr>
            <th class="text-r"><span class="c-red">*</span> 状态：</th>
    <td><label><input name="user_status" type="radio" id="six_1" value="1" checked >启用</label>
    <label><input type="radio" name="user_status" value="0" id="six_0">
                禁用</label></td>
          </tr> 
<!-- 默认使用最低的权限 -->
         
          <tr>
            <th></th>
            <td>
             {{csrf_field()}}
            <button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 提交</button>
            
            <button class="btn btn-success radius" type="button" onclick="history.go(-1)"><i class="icon-ok"></i> 返回
            </button>
                           
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="/js/Validform_v5.3.2_min.js"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui/js/H-ui.js')}}"></script> 
<script type="text/javascript" src="{{asset('/admin/hui/static/h-ui.admin/js/H-ui.admin.js')}}"></script> 
<script type="text/javascript">
$(".Huiform").Validform(); 
</script>
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
@endsection
<!-- </html>