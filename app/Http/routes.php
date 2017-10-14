<?php

/*  
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
| 说明:后台登录模块路由  
|      =>主模块admin/login  
|      =>分模块admin/login_seller
|
*/
// 根目录
Route::get('/', function () {
    return view('welcome');
});

// 测试数据
// Route::get('seller/test/','Seller\TaocanController@destroy');

/*主后台控制路由*/
// 1.登录 退出 改密码
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('admin/yzm','Admin\LoginController@yzm');
//通过composer安装的验证码
//Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');   
// 显示后台首页
Route::get('admin/index','Admin\LoginController@index');
Route::get('admin/welcome','Admin\LoginController@welcome');
// 退出的路由
Route::get('admin/loginput','Admin\LoginController@loginout');
// 修改密码的路由
Route::get('admin/repass','Admin\LoginController@repass');
// 2.官方管理员
Route::resource('admin/manager','Admin\ManagerController');
// 3.商家管理
Route::resource('admin/seller','Admin\SellerController');
// 4.用户管理
Route::resource('admin/user','Admin\UserController');
// 5.店铺管理(dc_shop)
Route::resource('admin/shop','Admin\ShopController');
//ajax上传文件(店铺管理)
Route::post('admin/uploadLogo','Admin\ShopController@uploadLogo');
Route::post('admin/uploadZhizhao','Admin\ShopController@uploadZhizhao');
Route::post('admin/uploadLicence','Admin\ShopController@uploadLicence');
// 修改edit与上传图片upload矛盾的解决
Route::post('admin/shop/{id}','Admin\ShopController@update');
// 6.店铺分类( dc_type火锅 早餐 糕点)
Route::resource('admin/type','Admin\TypeController');
// 7.权限管理
    //  7-1角色路由
    Route::resource('admin/role','admin\RoleController');
    Route::get('admin/role/auth/{id}','admin\RoleController@auth');
    Route::post('admin/role/doauth','admin\RoleController@doAuth');
    //  7-2权限路由
    Route::resource('admin/permission','admin\PermissionController');
       // 用户页面的 授权按钮 路由
    Route::get('admin/user/auth/{id}','admin\UserController@auth');
    Route::post('admin/user/doauth','admin\UserController@doAuth');
    //如果没有权限，给一个没有权限的提示页面
    Route::get('admin/nopermission',function(){
        return view('errors.permission');
    });



/*分后台路由(商家的后台)*/  
// ,'middleware'=>'isLogin'  中间件
Route::group(['prefix'=>'seller','namespace'=>'Seller'],function (){
// 分控制后台 登录 退出 改密码
Route::get('login','LoginController@login');
Route::post('dologin','LoginController@dologin');
Route::get('yzm','LoginController@yzm');
//通过composer安装的验证码
//Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');   
// 显示后台首页
Route::get('index','LoginController@index');
Route::get('welcome','LoginController@welcome');
// 退出的路由
Route::get('loginput','LoginController@loginout');
// 修改密码的路由
Route::get('repass','LoginController@repass');

// 8.商品管理
Route::resource('foods','FoodsController');
Route::post('foods/upload','FoodsController@uploadLogo');
// 矛盾的解决
Route::post('foods/{id}','FoodsController@update');
// 9.套餐管理
Route::resource('taocan','TaocanController');
// 10.购物车
Route::resource('cart','CartController');
// 11.订单
Route::resource('Order','OrderController');



});


/* 前台的控制器 */
Route::get('/','Home\IndexController@index');



// ,'middleware'=>'isLogin'  中间件
Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
// 1.显示前台首页
Route::resource('index','IndexController');
// 2.套餐详细商品taocan_id
Route::get('show/{taocan_id}/{shop_id}','IndexController@taocanFoods');
// 3.首页不同类别下的商品
Route::get('index/type/{type_id}','IndexController@typeFoods');
// 4.购物车资源理由
// Route::resource('cart','ShopController');


});
//模块二 购物车相关路由  start
// Route::resource('/home/shop', 'Home\ShopController');
//Route::controller('shop', 'Home\ShopController');
// 1.加入购物车
Route::get('/home/addcart/{id}', 'Home\ShopController@addcart');
// 2.数据处理 addcart跳转过来  =>引入product.cart
Route::get('/cart', 'Home\ShopController@cart')->name('cart');
// 3.移除数据
Route::get('/home/removecart/{id}', 'Home\ShopController@getRemovecart');
// 4.清空数据
Route::get('/home/del', 'Home\ShopController@destroy');
// 返回首页 
Route::get('/home/prev', 'Home\IndexController@index');

// 购物车提交到订单 (判断登录)
Route::get('/home/toorder', 'Home\OrderController@info');
// 收货地址
Route::post('/home/jsy', 'Home\OrderController@jsy');
Route::get('/home/finish', 'Home\OrderController@finish');
Route::get('home/ok', 'Home\OrderController@ok');


/*区域一  登录木块*/
// 登录  对应视图 view/home/login  样式public/home/css
// 引入登录界面
Route::get('home/login', 'Home\LoginController@login');
Route::post('home/dologin', 'Home\LoginController@dologin');
// 注册 

//修改密码

/* 区域二 个人中心 */
// 对应视图 view/home/user  样式public/home/css
// 用户信息的显示(修改界面显示)

/* 区域二 静态页面 */
// 底部友情链接 + 手机版 a 链接 get方式普通路由 如/home/app

// 说明:命名空间/home/功能木块/参数