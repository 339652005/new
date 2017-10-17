@extends('layouts.admin_two')

@section('content') 
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">我要开店</a> &raquo; 添加店铺
    </div>
   
    
    <div class="result_wrap">
        <form id="art_form" action="{{url('seller/doAddShop')}}" method="post" enctype="multipart/form-data">
        <!-- 隐藏域传递商家id -->
       <!--  <input type="hidden" readonly name="tianjia_id" value="{{--$seller_id--}}"> -->
            <table class="add_tab">
                <tbody>
                        <th>店铺名：</th>
                        <td>
                            <input type="text" name="shop_name" value="面包物语{{rand(1111,9999)}}店">
                        </td>
                    </tr>
                    <tr>
                        <th>店铺类型：</th>
                            <td>
                                <select style="width:150px;" name="shop_type" id="catid" class="required">
                               <!--  <option value="">所有分类</option> -->
                                @foreach($type as $v)    
                                    <option value="{{ $v->type_id }}">　｜－－{{ $v->type_name }}</option>
                                @endforeach  
                                </select>
                            </td>
                    </tr>
                     <tr>
                        <th>店铺地址：</th>
                        <td>
                            <input type="text" name="shop_addr"value="北京市昌平区回龙观">
                        </td>
                    </tr>
                     <tr>
                        <th>地址坐标</th>
                        <td>
                            X: <input type="text" name="shop_x" value="100">
                            Y: <input type="text" name="shop_y" value="100">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
                        </td>
                    </tr>
                      <tr>
                        <th>店铺描述：</th>
                        <td>
                            <textarea name="shop_desc">商家支持开发票，开票订单金额20.0元起，请在下单时填写好发票抬头</textarea>
                        </td>
                    </tr>

        <tr>
        <th><i class="require">*</i>店铺logo：</th>
        <td>     
         <input type="hidden" size="50" name="shop_logo_url" id="shop_logo"> 
       
            <input id="file_upload_logo" name="shop_logo" type="file" multiple="true">
            <p><img id="img_logo" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
        </td>
        </tr>

<tr>
    <th><i class="require">*</i>营业执照：</th>
    <td>    
    <input type="hidden" size="50" name="shop_zhizhao_url" id="shop_zhizhao">  
    <input id="file_upload_zhizhao" name="shop_zhizhao" type="file"  value=''multiple="true">
    <p><img id="img_zhizhao" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
</td>
</tr>                       

<tr>
    <th><i class="require">*</i>经营许可证：</th>
<td>      
    <input type="hidden" size="50" name="shop_licence_url" id="shop_licence">  
    <input id="file_upload_licence" name="shop_licence" type="file" multiple="true">
    <p><img id="img_licence" alt="上传后显示"  style="max-width:350px;max-height:100px;" /></p>
</td>
</tr>
                    <tr>
                        <th>店铺状态：</th>
                        <td>
                        <!-- <span></span> -->
                           <!-- 
                            <label for=""><input type="radio" name="shop_status" value="1" >正在营业</label> -->
                           <!--   -->
                            <!-- <label for=""><input type="radio" name="shop_status" value="3" checked>店铺关闭</label> -->
                            <!--  <label for=""><input type="radio" name="shop_status" value="0" checked>开店审核</label> -->
                             <label for=""><input type="radio" name="shop_status" value="0" checked>开店审核</label>
                        </td>
                    </tr>
                   
                   
                    <tr>
                        <th></th>
                        <td>
                        {{csrf_field()}}
                            <input type="submit" value="提交">
                            <a href="{{url('seller/welcome')}}">
                            	<input type="button" class="back" onclick="" value="返回">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<!-- 图片上传的js代码 -->
<script type="text/javascript">

    $(function () {
        $("#file_upload_logo").change(function () {
            uploadImage_logo();
        })
    })
    $(function () {
        $("#file_upload_zhizhao").change(function () {
            uploadImage_zhizhao();
        })
    })
    $(function () {
        $("#file_upload_licence").change(function () {
            uploadImage_licence();
        })
    })


    function uploadImage_logo() {
    //  判断是否有选择上传文件
        var imgPath = $("#file_upload_logo").val();
        // alert(imgPath)
        if (imgPath == "") {
            alert("请选择上传图片！");
            return;
        }
    //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp') {
            alert("请选择图片文件");
            return;
        }
    // new FormData对象    art_form form表单的id名
        var formData = new FormData($('#art_form')[0]);
        // alert(formData)
            $.ajax({
                type: "POST",
                //ajax对应路由 再对应控制器方法
                url: "/admin/uploadLogo",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //显示图片
                    $('#img_logo').attr('src','/'+data);
                    // id='shop_logo' 的隐藏域的值 用隐藏域
                    // $('#art_thumb_logo').val(data);
                    $('#shop_logo').val(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }

        // 执照上传
        function uploadImage_zhizhao() {
    //  判断是否有选择上传文件
        var imgPath = $("#file_upload_zhizhao").val();
        // alert(imgPath)
        if (imgPath == "") {
            alert("请选择上传图片！");
            return;
        }
    //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp') {
            alert("请选择图片文件");
            return;
        }
    // new FormData对象    art_form form表单的id名
        var formData = new FormData($('#art_form')[0]);
        // alert(formData)
            $.ajax({
                type: "POST",
                //ajax对应路由 再对应控制器方法
                url: "/admin/uploadZhizhao",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //显示图片
                    $('#img_zhizhao').attr('src','/'+data);
                    $('#shop_zhizhao').val(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }

        // 许可证
         function uploadImage_licence() {
    //  判断是否有选择上传文件
        var imgPath = $("#file_upload_licence").val();
        // alert(imgPath)
        if (imgPath == "") {
            alert("请选择上传图片！");
            return;
        }
    //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp') {
            alert("请选择图片文件");
            return;
        }
    // new FormData对象    art_form form表单的id名
        var formData = new FormData($('#art_form')[0]);
        // alert(formData)
            $.ajax({
                type: "POST",
                //ajax对应路由 再对应控制器方法
                url: "/admin/uploadLicence",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //显示图片
                    $('#img_licence').attr('src','/'+data);
                    $('#shop_licence').val(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }

    </script>

</body>

@endsection
<!-- </html> -->
