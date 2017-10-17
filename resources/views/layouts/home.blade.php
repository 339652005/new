<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    
   <title>订餐系统</title>
    <meta content="订餐小秘书,合肥特色餐厅,网上订餐,订餐网,合肥饭店,饭店网,合肥特色菜单,合肥餐厅优惠,合肥饭店团购" name="Keywords" />
    <meta content="订餐小秘书,合肥最大最全餐饮指南.合肥特色餐厅360度环视图,合肥中高档饭店一站式网上订餐服务,网上订餐享团购优惠,200万会员的共同选择." name="Description" />

    <link href="/home/css/base.v1204100040.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/home/css/res.v415131610.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{ asset('admin/js/jquery-1.8.3.min.js')}}"></script>
    <style type="text/css">
        a {
            text-decoration:none;
        }
        a:hover {
     text-decoration: underline; 
}
    </style>
</head>
<body>
    
<!-- 头部 -->
<div class="head">
	<div class="constr">
    	<div class="constr_in fix">
            <div class="fix lh20">
                <div class="pb1 r head_a" id="rightNavDiv">个人信息加载中...</div>
            </div>
        	<!-- 头部左侧 -->
            <div class="fix">
                <div class="mt5 nowrap pct74 l">
                	<a href="http://hefei.xiaomishu.com"><img class="logo" src="/home/picture/95_logo_r.v731222600.png" /></a>
                    <div class="head_city">
                    	<h3 class="f20 fw">合肥</h3>
                        <div rel="headCityBox" data-rel="headCityBox" id="headChangeCity">[ <a href="javascript:" class="head_a">更换城市</a><i class="cor corwh ml2"></i> ]</div>
                    </div>
                    
                    <div class="search_area inline_any">                       
                    	<div>
                            <span class="intab_on jsSearchIntab" rel="schRes"><i class="intab_line"></i><a href="javascript:" class="intab">找餐厅</a></span>
                            
                        </div>
                        <span id="schRes" class="">
                        	 <span class="search_box dib" id="searchBox1">
                                <u class="u u08 search_icon"></u><input type="text" id="searchInputRes" class="search_input iptw2 g9" autocomplete="off" x-webkit-speech x-webkit-grammar="builtin:translate" data-url="http://hefei.xiaomishu.com/shop/search/?type=res&key=" />
                            </span><input id="searchBtn1" type="button" value="搜　索" class="search_btn ml5" />
                        </span>
                        
                    </div>
                    
                </div>
                <!-- 顶部右侧 -->
                <div class="r tr head_a">
                    <div class="mt5">
                	    
                    </div>
                    <!--关注新浪微博-->
                    <div id="forAppendApp" class="mt5" data-src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&width=63&height=24&uid=1782958742&style=1&btn=red&dpc=1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 头部城市隐藏层 -->

</div>
<!-- 导航 -->
<div class="nav">
	<div class="constr">
    	<div class="constr_in">
        	<ul class="fix">
                <li class="nav_r">
                    <a href="http://hefei.xiaomishu.com/app/download/" class="b wh mr10 tdn" target="_blank"><u class="u u316 mr5"></u>手机版</a>
                    <div id="appMsgBox" class="rel zx1"></div>
                </li>
            	<li class="nav_first"></li> 

                    <li class="nav_on"><div class="nav_in"><a href="{{url('home/index')}}" class="nav_bg">首页</a></div></li>

                    <li class="nav_off"><div class="nav_in"><a href="{{url('/cart')}}" class="nav_bg">我的购物车</a></div></li>
                    
                    <li class="nav_off"><div class="nav_in"><a href="{{url('/home/detail')}}" class="nav_bg">我的订单</a></div></li>

                    <li class="nav_off "><div class="nav_in"><a href="{{url('home/userinfo')}}" class="nav_bg" target="_blank">个人中心</a></div></li> 
                            
                <li class="nav_last"></li>                
            </ul>
        </div>
    </div>
</div>




@section('content')
<!-- 主体部分 -->
@show


  
<div class="pb28"></div>

    <script type="text/javascript" src="js/mt3.v1014201036.js"  charset="utf-8"></script>
    <script type="text/javascript" src="js/fgcomm.v1020155248.js"  charset="utf-8"></script>
    <script type="text/javascript" src="js/main.v1020154944.js"  charset="utf-8"></script>
    
<script>
    var indexInputFocus = $("searchInputRes");
    indexInputFocus && indexInputFocus.focus();
    $lazyLoading($$(".imgLazy"));
    //上面的图片播放广告位
    var eleAreaImage = $("resTopAdImage"), eleAreaIndex = $("resTopAdIndex"), jsonTopAd = window.resHomeAdJson, jsonLength;
    var htmlImage = "", htmlIndex = "";
    if (eleAreaImage && eleAreaIndex && (jsonLength = ($isArr(jsonTopAd) && jsonTopAd.length))) {
        jsonTopAd.each(function (obj, i) {
            var reg = new RegExp(window.location.host), flagHost = reg.test(obj.href);
            htmlImage = htmlImage + '<a ' + (flagHost ? '' : 'target="_blank"') + 'href="' + obj.href + '" id="resTopAdImg' + i + '" class="res_home_ad_a res_other_ad_a ' + (i && "abs_out") + '" onclick="_gaq.push([\'_setCustomVar\', 2, \'InsiteCampaign\', \'' + obj.href + '\', 2]);"' + (i ? ' data-url="'images/+ obj.src +'"></a>' : ' style="background:url(' + obj.src + ');"></a>');
            if (jsonLength > 1) {
                htmlIndex = htmlIndex + '<a href="javascript:" class="' + (i ? "res_home_ad_off" : "res_home_ad_on") + '" rel="resTopAdImg' + i + '">' + (i + 1) + '</a>';
            }
        });
        eleAreaImage.html(htmlImage);
        eleAreaIndex.html(htmlIndex);

        //自动播放以及些事件绑定
        if (jsonLength > 1) {
            $tabSwitch(eleAreaIndex.getElements("a"), {
                eventType: "hover",
                classAdd: "res_home_ad_on",
                classRemove: "res_home_ad_off",
                timePlay: 4000,
                switchCall: function (target) {
                    var urlBgImg = target.attr("data-url");
                    if (urlBgImg) {
                        target.css("background", "url("images/94d1be392e6b4011b0cba2ef35912e86.gif")").attr("data-url", "");
                    }
                }
            });
        }
    }
    $customTip($$(".tipTrigger"));
</script>


    <script type="text/javascript">
        LOGIN.passportUrl = "http://passport.xiaomishu.com/";
        LOGIN.init();
    </script>

<!-- 底部 -->
<div class="constr">
    <div class="constr_in">

 
<div class="pt1 dot"></div>
<div class="footer">   
    <div class="fs contact">
        <a href="http://www.xiaomishu.com/about/aboutus"  class="g3">关于我们</a>
        |
        <a href="http://www.xiaomishu.com/about/contactus"  class="g3" rel="nofollow">联系我们</a>
        |
        <a href="http://www.xiaomishu.com/about/hr"  class="g3">诚招英才</a>
        |
        <a href="http://hefei.xiaomishu.com/links.aspx"  class="g3">友情链接</a>
        |
        <a href="http://hefei.xiaomishu.com/sitemap/"  class="g3">网站地图</a>
        |
        <a href="http://hefei.xiaomishu.com/chainreslist/"  class="g3">连锁店</a>
        |
        <a href="http://www.xiaomishu.com/merchant/login.aspx"  class="g3" rel="nofollow">商户登录</a>
        |
        <a href="http://hefei.xiaomishu.com/canting/"  class="g3">热门餐厅</a>   
        |        
        <span class="g3">手机：</span>
        <a href="http://hefei.xiaomishu.com/app/download/" class="dib mr5 g3" rel="nofollow">iPhone</a>
        <a href="http://hefei.xiaomishu.com/app/download/" class="dib mr5 g3" rel="nofollow">Android</a>
        <a href="http://hefei.xiaomishu.com/app/download/" class="dib mr5 g3" rel="nofollow">Windows Phone</a>
        <a href="http://m.xiaomishu.com" class="dib mr5 g3" rel="nofollow" target="_blank">Wap</a>
                 
    </div>
    <div class="copyright">
               Copyright &copy; 2005-2017 xiaomishu.com 版权所有.<a class="g6" href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备05062273</a>
        <span class="dib vm">
	        <a href="http://www.sgs.gov.cn/lz/licenseLink.do?method=licenceView&entyId=2012030916554822" rel="nofollow"><img src='/home/picture/gsicon.v312150038.gif' border="0"></a>
        </span>
        <span class="dib vm ml10 mr10">
            <a rel="nofollow" href="http://sh.cyberpolice.cn/infoCategoryListAction.do?act=initjpg" target="_blank"><img border="0" src="/home/picture/police.v1016143220.png" width="90" /></a>
        </span>
        <span class="dib vm mr10">
            <a rel="nofollow" href="http://www.zx110.org" target="_blank"><img border="0" src="/home/picture/zx110.v1016142918.png"  width="75"/></a>
        </span>
        <span class="dib vm">
            <img border="0" src="/home/picture/picp_logo.v1105104202.png" width="50"/>
        </span> 
    </div>
</div> 
 
 

    </div>
</div> 
  
<!--页面底部banner-->

 
<script>

function rankingsPush() {
    var url = String(document.referrer);
    if (url.indexOf("google.") != -1) {
        var urlVars = {};
        var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            urlVars[key] = value;
        });
        _gaq.push(['_setCustomVar', '1', 'Rankings', urlVars["cd"], 2]);
    }
}
var _gaAccount = "UA-3214743-28";
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-3214743-28']);
_gaq.push(['_setDomainName', '.xiaomishu.com']);
_gaq.push(['_addIgnoredRef', 'xiaomishu.com']);
_gaq.push(['_addOrganic', 'soso', 'w']);
_gaq.push(['_addOrganic', 'sogou', 'query']);
_gaq.push(['_addOrganic', 'youdao', 'q']);
_gaq.push(['_addOrganic', 'so.360.cn', 'q']);
_gaq.push(['_addOrganic', 'vnet', 'kw']);
_gaq.push(['_addOrganic', '3721', 'name']);
_gaq.push(['_addOrganic', 'www.baidu.com', 'word']);
_gaq.push(['_addOrganic', 'm.baidu.com', 'word']);
_gaq.push(['_addOrganic', 'wap.baidu.com', 'word']);
_gaq.push(['_addOrganic', 'image.baidu.com', 'word']);
_gaq.push(['_addOrganic', 'cache.baidu.com', 'query']);
_gaq.push(['_addOrganic', 'map.baidu.com','wd']);
_gaq.push(['_addOrganic', 'so.com', 'q']);
_gaq.push(['_addOrganic', 'www.haosou.com', 'q']);
rankingsPush();
//{setCustomVar}
_gaq.push(['_trackPageview']);
(function () {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
setTimeout(function () {
    var urlLocation = location.href;
    var urlRegxp = /banner=(\w+)\&camp=(\w+)/;
    if (urlRegxp.test(urlLocation)) { 
        var firstVal = RegExp.$1;
        var secondVal = RegExp.$2
        var newUrlQuery = "name=" + firstVal + "|campaign=" + secondVal;
        var newCookie = "xms_utmz" + "=" + newUrlQuery;
        document.cookie = newCookie + "; max-age=" + 1800 + "; path=/" + "; domain=xiaomishu.com";
    }
}, 500); 
</script>
<!--网盟-->
<script type="text/javascript"> 
<!--
    (function (d) {
        (window.bd_cpro_rtid = window.bd_cpro_rtid || []).push({ id: "P1R4nH0" });
        var s = d.createElement("script"); s.type = "text/javascript"; s.async = true; s.src = location.protocol + "//cpro.baidu.com/cpro/ui/rt.js";
        var s0 = d.getElementsByTagName("script")[0]; s0.parentNode.insertBefore(s, s0);
    })(document); 
//--> 
</script>
<script src="js/rt.js"></script>
<!--鸿媒体数据-->

<noscript>
    <div style="display:none;">
        <img height="0" width="0" style="border-style:none;" src="picture/rt.jpg" />
    </div>
</noscript>
<!--百度统计-->
<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?841c20a46b714a6ec154c9ba72d0dfdc";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<!--坐席接入-->
 
<script type="text/javascript" src="js/chat.v825171309.js"  charset="utf-8"></script>
<script type="text/javascript">
     function openChat(obj) {
         XmsChat.open();
         var text = obj.innerText || "地三鲜";
         _hmt.push(['_trackEvent', "人工坐席接入", "人工坐席接入", text, 0]);
     }

     window.addEvent('domready', function () {
         var cityId = "230000";
         var isshowIcon = false;
         var date = new Date();
         var hour = date.getHours();
         var min = date.getMinutes();
         if(cityId=="200000" && ((hour>=9 && hour<20) || (hour==20 && min<=30))){
             isshowIcon = true;
         }
         XmsChat.init({
             //用户token
             userToken: "",
             //城市id
             cityId: "230000",
             //纬度
             lon: -1,
             //经度
             lat: -1,
             showIcon: isshowIcon
         });
     });
</script>

    

</body>
</html>