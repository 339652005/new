@extends('layouts.home')

@section('content')
    <title>收货信息</title>

    <link href='/home/css/jd-reg.css' type='text/css' rel='stylesheet' >
<body style="background-color:#fff;">
<div class="header">
    <div class="logo-con w clearfix">
        <a href="" class="logo">
        </a>
        <div class="logo-title">收 货 信 息 表</div>
        <!-- <div class="have-account">已有账号 <a href="">请登录</a></div> -->
    </div>

</div>
<div class="container w">

    <div class="main clearfix">
        <div class="reg-form fl">
            <form action="{{url('home/jsy')}}" id="register-form" method="post" novalidate="novalidate" style="width:500px;">

                <div class="form-item form-item-account" id="form-item-account">
                    <label>收　货　人</label>
                   <input type="text" id="form-account" style="" name="order_name" class="field" autocomplete="off" maxlength="20" placeholder="收货人姓名" default="&lt;i class=&quot;i-def&quot;&gt;&lt;/i&gt;支持中文、字母、数字、“-”“_”的组合，4-20个字符" value="收货人{{rand(1111,9999)}}">
                    <i class="i-status"></i>
                </div>
                <div class="input-tip">
                    <span></span>
                </div>
                <div class="form-item">
                    <label>联 系 电 话</label>
                    
                    <input type="text" name="order_tell" value="17681278256" id="form-pwd" class="field" maxlength="20" placeholder="联系电话" >
                    <i class="i-status"></i>
                <div class="capslock-tip tips">大写已开启<b class="arrow"></b><b class="arrow-inner"></b></div><div class="capslock-tip tips">大写已开启<b class="arrow"></b><b class="arrow-inner"></b></div></div>
                <div class="input-tip">
                    <span></span>
                </div>
                <div class="form-item" style="width:500px;">
                    <label>收 货 地 址</label>
                    
                  <input type="text" name="order_addr"   id="form-equalTopwd" class="field" placeholder="收货的具体地址" maxlength="120" default="&lt;i class=&quot;i-def&quot;&gt;&lt;/i&gt;请再次输入密码" value="北京市昌平区回龙观地铁站">
                    <i class="i-status"></i>
              
                </div><br/><br/>
              
                  <div class="form-item" style="width:500px;">
                    <label>买 家 留 烟</label>
                    
                  <input type="text" name="order_umsg"   id="form-equalTopwd" class="field" placeholder="买家备注信息" value='快递送来,我饿了'maxlength="120" default="&lt;i class=&quot;i-def&quot;&gt;&lt;/i&gt;">
                    <i class="i-status"></i>
              
                </div>            
                                 
                  
                    
                
                <div class="form-agreen">
                    <div></div>
                    <div class="input-tip">
                        <span></span>
                    </div>
                </div>
                 {{csrf_field()}}
                <div>
                    <button type="submit" class="btn-register">提交信息</button>
                </div>
            </form>
        </div>
       
    </div>
  
</div>
@endsection    
  
<!--     



</body></html> -->