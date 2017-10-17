 
@extends('layouts.admin')
@section('content') 
  
<!-- </head> -->
<body>

<div class="pd-20">
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
  <div class="Huiform">
  
    <form action="{{url('seller/changeSelfInfo/'.$seller->seller_id)}}" method="post">
      <table class="table table-bg">
        <tbody>
          <tr>
            <th width="100" class="text-r"><span class="c-red">*</span> 商家名：</th>
            <td>
            <input type="text" style="width:200px" class="input-text" 
            value="{{$seller->seller_name}}" placeholder="请输入用户名" id="user-name"
             name="seller_name" datatype="*2-16" nullmsg="用户名不能为空">
             </td>
          </tr>
          
          <tr>
            <th class="text-r"><span class="c-red">*</span> 商家密码：</th>
            <td><input type="password" style="width:300px" class="input-text" 
            value="{{$seller->seller_pwd}}" placeholder="" id="user-tel" name="seller_pwd"></td>
          </tr>
          <tr>
            <th class="text-r">确认密码：</th>
            <td><input type="password" style="width:300px" class="input-text"
             value="{{$seller->seller_pwd}}" placeholder="" id="user-email" name="seller_repwd"></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 商家电话：</th>
            <td><input type="text" style="width:300px" class="input-text" 
            value="{{$seller->seller_tell}}" placeholder="" id="user-tel" name="seller_tell"></td>
          </tr>
          <tr>
            <th class="text-r">商家邮箱：</th>
            <td><input type="text" style="width:300px" class="input-text" 
            value="{{$seller->seller_email}}" placeholder="" id="user-email" name="seller_email"></td>
          </tr>
          
        <tr>
            <th class="text-r">状态:</th>
            <input name="seller_status" type="hidden" id="six_1" value="1" checked>
           
       		<td><span>　　　开启状态</span></td>
        </tr>
         <!-- 隐藏域 传递开启状态 -->
         
             
        
<!-- 默认使用最低的权限 -->
         
          <tr>
            <th></th>
            <td>
             {{csrf_field()}}
            <button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 更新信息</button>
            
            <a href="{{url('seller/welcome')}}">
              <button class="btn btn-success radius" type="button" onclick=""><i class="icon-ok"></i> 返回
            </button>
            </a>
                           
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