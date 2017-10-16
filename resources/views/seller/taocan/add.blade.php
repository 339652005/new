
@extends('layouts.admin') 
@section('content')
  
<!-- </head> -->
<body>
<div class="pd-20"> 
  <div class="Huiform">
    <form action="{{url('seller/taocan')}}" method="post">
      <table class="table table-bg">
        <tbody>
          <tr>
            <th width="100" class="text-r"><span class="c-red">*</span> 套餐名称：</th>
            <td><input type="text" style="width:200px" class="input-text" value="最爱柠檬" placeholder="请输入用户名" id="user-name" name="taocan_name" datatype="*2-16" nullmsg="分类名不能为空"></td>
          </tr>

        <!--   <tr>
            <th width="100" class="text-r"><span class="c-red">*</span> 套餐价格：</th>
            <td>￥ <input type="text" style="width:200px" class="input-text" value="100.00" placeholder="请输入用户名" id="user-name" name="taocan_price" datatype="*2-16" nullmsg="分类名不能为空"> 元</td>
          </tr> -->
          
          
          
         
        
         
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