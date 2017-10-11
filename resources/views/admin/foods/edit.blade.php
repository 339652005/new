@extends('layouts.admin_two')
@section('content') 
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 修改商品信息
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
           <!--  <h3>快捷操作</h3> -->
           <!-- 修改失败的提示 -->
            @if(session('msg'))
                <p>{{session('msg')}}</p>
            @endif

        </div>
       <!--  <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div> -->
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form id="art_form" action="{{url('admin/foods/'.$foods->foods_id)}}" method="post" enctype="multipart/form-data">
            <table class="add_tab">
                <tbody>
                    {{csrf_field()}}
                    <!-- <input type="hidden" name="_method" value="put"> -->
                 
                    <tr>
                        <th>菜品名称：</th>
                        <td>
                            <input type="text" name="foods_name" value="{{ $foods->foods_name }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th>商品销量：</th>
                        <td>
                            <input type="text" name="foods_sales"value="{{ $foods->foods_sales }}"> 份
                        </td>
                    </tr>
                     <tr>
                        <th>商品价格</th>
                        <td>
                           ￥：<input type="text" name="foods_price" value="{{ $foods->foods_price }}"> 元
                        </td>
                    </tr>
                      <tr>
                        <th>商品描述：</th>
                        <td>
                            <textarea name="foods_desc">{{ $foods->foods_desc }}</textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th><i class="require">*</i>商品照片：</th>
                        <td>
                          <input type="hidden" size="50" name="foods_piture" id="shop_logo"> 
<input id="file_upload_logo" name="shop_logo" type="file" multiple="true">
<p><img id="img_logo" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
                        </td>
                    </tr>
                    <tr>
                        <th>商品状态：</th>
                        <td>
                            <label for=""><input type="radio" name="foods_status" value="0" 
                            @if($foods->foods_status=='0')
                             checked
                            @endif
                            
                             >上架</label>
                            <label for=""><input type="radio" name="foods_status" value="1" 
                            @if($foods->foods_status=='1')
                             checked
                             @endif
                             
                             >下架</label>
                             <label for=""><input type="radio" name="foods_status" value="2" 
                             @if($foods->foods_status=='2')
                             checked
                             @endif
                             >火热</label>
                            <label for=""><input type="radio" name="foods_status" value="3" 
                            @if($foods->foods_status=='3')
                             checked
                             @endif
                             >优惠</label>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
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
        $("#file_upload_logo").change(function () {
            uploadImage_logo();
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
                url: "/admin/foods/upload",
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
   </script>
</body>
@endsection