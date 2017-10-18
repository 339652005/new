﻿
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link href="css/base.v1204100040.css" rel="stylesheet" type="text/css" media="all" /><link href="css/res.v415131610.css" rel="stylesheet" type="text/css" media="all" />
    <title>会员登录</title>
<title>

</title></head> -->
@extends('layouts.home')

@section('content')


<!--首页最新改版-->



    
        <div class="fix p10">
            <span class="l res_gre_bias_tit">
                <b class="gre_v_line1"></b><b class="gre_v_line2"></b>
                <h3 class="res_gre_bias_main">用户个人中心</h3>
                <i class="res_gre_bias_cor"></i>
            </span>
        </div>
        <!-- 注册与绑定 -->
       
                <div class="gtab_body res_mem_gtab_body">
                	<div class="pt10 pl5 pr5 fix">
                    	<form action="{{url('home/changeUserInfo')}}" method="POST">
                            <!--基本资料-->
                            <div class="l tc mr20">
                                <img src="/uploads/logo_201710170724189555.jpg" width="120" height="120" />
                                <a href="javascript:" id="userHeadUp" class="db co mt10" data-url="../dialog/UploadFile.aspx?action=upuserface">更新头像</a>
                            </div>
                            <div class="cell">
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>用户名: </span>
                                    <span class="l w200">
                                        <input type="text" id="nickNameIpt" class="input pct98" name="user_name" value="{{$user->user_name}}" />                                 
                                    </span>
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>电话: </span>
                                    <span class="l w200">
                                        <input type="text" id="nickNameIpt" class="input pct98" name="user_tell" value="13565423675" />                                 
                                    </span>
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>邮箱: </span>
                                    <span class="l w200">
                                        <input type="text" id="nickNameIpt" class="input pct98" name="user_email" value="339652005@qq.com"  />                                 
                                    </span>
                                </div>


                              



                                <!-- 结束 -->
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>真实姓名：</span>
                                    <span class="l w200">

                                        <input type="text" class="input pct98" value="古力娜扎" name="realname" />
                                    
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>性别：</span>
                                    <input class="vn" type="radio" name="sex" id="male" value="true" /><label class="mr20" for="male">男</label>
                                    <input class="vn" type="radio" name="sex" id="famale" value="false" checked='checked'/><label for="famale">女</label>
                                </div>
                                <div class="mb5 fix mb10">
                                    <span class="l tr w70">生日：</span>
                                    <span class="l w200">
                                    
                                        <input type="text" name="birthday" id="myBirthday" class="input pct98" value="1992-08-04" />
                                   
                                    </span>
                                   
                                </div>

                                <!--原来的联系地址不删除，只是隐藏 Start-->
                                <div class="mb15 fix dn">
                                    <span class="l tr w70">邮寄地址：</span>
                                    <span class="l w200"><input type="text" class="input pct98" name="address" value="" /></span>
                                   
                                </div>
                                <div class="mb15 fix dn">
                                    <span class="l tr w70">邮编：</span>
                                    <span class="l w200">
                                        <input type="text" class="input pct98" name="postcode" value="      " />
                                    </span>
                                </div>
                                <!--原来的联系地址 End-->

                                <div class="mb15 fix">
                                    <span class="l tr w70">职业：</span>
                                    <span class="l w200">
                                        <select class="p1" name="job">
                                            
                                              <option value="公职人员" >公职人员</option>
                                              <option value="公职人员" selected >著名演员</option>
                                            
                                              <option value="销售/市场" >销售/市场</option>
                                            
                                              <option value="秘书/行政/助理" >秘书/行政/助理</option>
                                            
                                              <option value="中高级管理人员" >中高级管理人员</option>
                                            
                                              <option value="普通职员" >普通职员</option>
                                            
                                              <option value="个体经营" >个体经营</option>
                                            
                                              <option value="退休/待业" >退休/待业</option>
                                            
                                              <option value="学生" >学生</option>
                                            
                                              <option value="保密" >保密</option>
                                            
                                        </select>
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70">婚姻状态：</span>
                                    <span class="l w200">
                                        <select class="p1 pct40" name="marrystate">
                                            <option value="0">保密</option>
                                            <option value="1" >已婚</option>
                                            <option value="2" selected>未婚</option>
                                        </select>
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70">血型：</span>
                                    <span class="l w200">
                                        <select class="p1 pct40" name="bloodtype">
                                            
                                              <option value="0" selected='selected'>保密</option>
                                            
                                              <option value="1" >A型</option>
                                            
                                              <option value="2" >B型</option>
                                            
                                              <option value="3" >O型</option>
                                            
                                              <option value="4" selected>AB型</option>
                                            
                                              <option value="5" >其它</option>
                                            
                                        </select>
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>家乡：</span>
                                    <span class="l w100">
                                        <select class="p1 pct80 mr10" name="homeprovince" id="selHomeCity" >
                                            <option value="" >省/市</option>
                                            <option value="" selected="selected">北京市</option>
                                        </select>
                                    </span>
                                    <span class="l w100">
                                        <select  id="selHomeRegion" class="p1 pct80 mr10" name="hometown">
                                            <option value="">区/县</option>
                                        </select>
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70"><span class="co mr5">*</span>现居地：</span>
                                    <span class="l w100">
                                        <select id="selLiveCity" class="p1 pct80 mr10" name="livingprovince">
                                            <option value="" selected="selected">省/市</option>
                                               <option value="" selected="selected">北京市</option>
                                        </select>
                                    </span>
                                    <span class="l w100">
                                        <select id="selLiveRegion" class="p1 pct80 mr10" name="livingtown">
                                            <option value="">区/县</option>
                                        </select>
                                    </span>
                                  
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70">MSN：</span>
                                    <span class="l w200">
                                        <input class="input pct98" type="email" name="msn" value="456387654" />
                                    </span>
                                   
                                </div>
                                <div class="mb15 fix">
                                    <span class="l tr w70">QQ：</span>
                                    <span class="l w200">
                                        <input type="text" id="qqInput" class="input pct98" name="qq" value="23435634" />
                                    </span>
                                   
                                </div>
                                  <div class="mb15 fix">
                                    <span class="l tr w70">隐私设置：</span>
                                    <span class="l w200">
                                       <input type="text" id="homeInput" class="input pct98" name="qq" value="个人主页"  disabled/>
                                    </span>
                                   
                                </div>
                                <div class="pt10 lh20 fix">
                                    <div class="l w70">&nbsp;</div>
                                    <span class="grebtn grebtn_s">
                                        <i class="green_line"></i>

                                        {{csrf_field()}}
                                      <!--   <strong class="grebtn_in"><input type="submit" value="保存" /></strong> -->
                                        <i class="green_line"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                   	</div>
                    <!-- end -->
                </div>
          
</body>
<!-- </html> -->
@endsection