@extends('layouts.admin_two')

@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">店铺管理</a> &raquo; 添加店铺
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<!-- <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div> -->
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form id="art_form" action="{{url('admin/shop')}}" method="post" enctype="multipart/form-data">
            <table class="add_tab">
                <tbody>
                   <!--  <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="">
                                <option value="">==请选择==</option>
                                <option value="19">精品界面</option>
                                <option value="20">推荐界面</option>
                            </select>
                        </td>
                    </tr> -->
                   <!--  <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" class="lg" name="">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr> -->
                    <tr>
                        <th>店铺名：</th>
                        <td>
                            <input type="text" name="shop_name" value="面包物语{{rand(1111,9999)}}店">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
                        </td>
                    </tr>
                     <tr>
                        <th>店铺地址：</th>
                        <td>
                            <input type="text" name="shop_addr"value="北京市昌平区回龙观">
                            <!-- <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span> -->
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
<!-- 第一部分 -->

 <!--  前端部分图片刹车带吗代码 -->
<!-- <form id="art_form" action="{{url('admin/pic')}}" method="post" enctype="multipart/form-data">
{{--csrf_field()--}}

<input type="text" size="50" name="art_thumb" id="art_thumb"> 
<input id="file_upload" name="file_upload" type="file" multiple="true">
<p><img id="img1" alt="上传后显示图片" style="max-width:350px;max-height:100px;" /></p>

<input type="submit" value="提交">
</form> -->                     

<!-- 第二部分 js代码-->

<!-- 
<script type="text/javascript">
        $(function () {
            $("#file_upload").change(function () {
                uploadImage();
            })
        })
        function uploadImage() {
//  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            var formData = new FormData($('#art_form')[0]);
            $.ajax({
                type: "POST",
                url: "/admin/upload",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#img1').attr('src','http://lamp189.oss-cn-shanghai.aliyuncs.com/'+data);
                    $('#art_thumb').val(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }
    </script>
 -->


<td>      
   <!--  <input type="text" size="50" name="art_thumb" id="art_thumb"> -->
    <input id="file_upload" name="shop_logo" type="file" multiple="true">
    <p><img id="img1" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
</td>


                    </tr>

                   
                       
                     <tr>
                        <th><i class="require">*</i>营业执照：</th>
                        <td>      
   <!--  <input type="text" size="50" name="art_thumb" id="art_thumb"> -->
    <input id="file_upload" name="shop_zhizhao" type="file" multiple="true">
    <p><img id="img1" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
</td>
                       <!--  <td><input type="file" name="shop_zhizhao"></td>
                    </tr> -->


                    <tr>
                        <th><i class="require">*</i>经营许可证：</th>
<td>      
   <!--  <input type="text" size="50" name="art_thumb" id="art_thumb"> -->
    <input id="file_upload" name="shop_licence" type="file" multiple="true">
    <p><img id="img1" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
</td>

                        <!-- <td><input type="file" name="shop_licence"></td> -->
                    </tr>
                    <tr>
                        <th>店铺状态：</th>
                        <td>
                            <label for=""><input type="radio" name="shop_status" value="0" checked>开店审核</label>
                            <label for=""><input type="radio" name="shop_status" value="1" >正在营业</label>
                             <label for=""><input type="radio" name="shop_status" value="2" checked>休息时间</label>
                            <label for=""><input type="radio" name="shop_status" value="3" >店铺关闭</label>
                        </td>
                    </tr>
                   
                    <!-- <tr>
                        <th>复选框：</th>
                        <td>
                            <label for=""><input type="checkbox" name="">复选框一</label>
                            <label for=""><input type="checkbox" name="">复选框二</label>
                        </td>
                    </tr> -->
                  
                    <!-- <tr>
                        <th>详细内容：</th>
                        <td>
                            <textarea class="lg" name="content"></textarea>
                            <p>标题可以写30个字</p>
                        </td>
                    </tr> -->
                    <tr>
                        <th></th>
                        <td>
                        {{csrf_field()}}
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<!-- 图片上传的js代码 -->
<script type="text/javascript">

    $(function () {
        $("#file_upload").change(function () {
            uploadImage();
        })
    })

    function uploadImage() {
    //  判断是否有选择上传文件

        var imgPath = $("#file_upload").val();
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
    // new FormData对象    
        var formData = new FormData($('#art_form')[0]);
        // alert(formData)
            $.ajax({
                type: "POST",
                //ajax对应路由 再对应控制器方法
                url: "/admin/upload",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                   
                    $('#img1').attr('src','/'+data);
                    // $('#art_thumb').val(data);
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
