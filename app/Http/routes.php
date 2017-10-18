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


// 测试数据
// Route::get('test/{id}','Admin\ShopController@shenhe');


// 主后台路由
Route::get('admin/login','Admin\LoginController@login');
Route::get('admin/yzm','Admin\LoginController@yzm');
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('admin/reg','Admin\LoginController@reg');
Route::post('admin/doreg','Admin\LoginController@doreg');
// 主后台路由组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isManagerLogin']],function (){
//通过composer安装的验证码
//Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');  
// 显示后台首页
Route::get('index','LoginController@index');
Route::get('welcome','LoginController@welcome');
// 退出的路由
Route::get('loginout','LoginController@loginout');
// 修改密码的路由
Route::get('repass','LoginController@repass');
// 2.官方管理员
Route::resource('manager','ManagerController');
// 3.商家管理
Route::resource('seller','SellerController');
// 4.用户管理
Route::resource('user','UserController');
// 5.店铺管理(dc_shop)
Route::resource('shop','ShopController');
// admin/shenhe/ 审核店铺
Route::get('shenhe/{id}','ShopController@shenhe');
//ajax上传文件(店铺管理)
Route::post('uploadLogo','ShopController@uploadLogo');
Route::post('uploadZhizhao','ShopController@uploadZhizhao');
Route::post('uploadLicence','ShopController@uploadLicence');
// 修改edit与上传图片upload矛盾的解决
Route::post('shop/{id}','ShopController@update');
// 6.店铺分类( dc_type火锅 早餐 糕点)
Route::resource('type','TypeController');
    // 7.权限管理
    //  7-1角色路由
    Route::resource('role','RoleController');
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    //  7-2权限路由
    Route::resource('permission','PermissionController');
       // 用户页面的 授权按钮 路由
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');
    //如果没有权限，给一个没有权限的提示页面
    Route::get('nopermission',function(){
        return view('errors.permission');
    });
});   





/*分后台路由(商家的后台)*/  
Route::get('seller/login','Seller\LoginController@login');
Route::post('seller/dologin','Seller\LoginController@dologin');
Route::get('seller/yzm','Seller\LoginController@yzm');
Route::get('seller/reg','Seller\LoginController@reg');
Route::post('seller/doreg','Seller\LoginController@doreg');
/*分后台路由组*/
Route::group(['prefix'=>'seller','namespace'=>'Seller','middleware'=>['isSellerLogin']],function (){
// 分控制后台 登录 退出 改密码
Route::get('loginout','LoginController@loginout');
// 显示后台首页
Route::get("index",'LoginController@index');
Route::get('welcome','LoginController@welcome');
// 退出的路由
Route::get('loginout','LoginController@loginout');
// 分后台 店主 店铺信息
Route::get('selfinfo/{id}','LoginController@selfinfo');
// 执行修改
Route::post('changeSelfInfo/{id}','LoginController@changeSelfInfo');
// 店铺信息
Route::get('shopinfo/{id}','LoginController@shopinfo');
// 修改信息
Route::post('changeShopinfo/{id}','LoginController@changeShopinfo');
// 开店
Route::get('addShop/{id}','LoginController@addShop');
// 执行开店
Route::post('doAddShop','LoginController@doAddShop');
// 修改密码的路由
Route::get('repass','LoginController@repass');
// 8.商品管理 
Route::resource('foods','FoodsController');
Route::post('foods/upload','FoodsController@uploadLogo');
// 矛盾的解决
Route::post('foods/{id}','FoodsController@update');
// 9.套餐管理
Route::resource('taocan','TaocanController');
// 订单详情
Route::get('detail', 'OrderController@index');
Route::get('detail/{id}', 'OrderController@detail');
});   // 结束路由主


// isUserLogin


/* 前台的控制器 */
//  路由组1
Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
// 1.显示前台首页
Route::resource('index','IndexController');
// 2.套餐详细商品taocan_id
Route::get('show/{taocan_id}/{shop_id}','IndexController@taocanFoods');
// 3.首页不同类别下的商品
Route::get('index/type/{type_id}','IndexController@typeFoods');
// 1.加入购物车
Route::get('/addcart/{id}', 'ShopController@addcart');
// 3.移除数据
Route::get('removecart/{id}', 'ShopController@getRemovecart');
// 4.清空数据
Route::get('del', 'ShopController@destroy');
// 返回首页 
Route::get('prev', 'IndexController@index');

});

//  路由组2 权限
Route::group(['prefix'=>'home','namespace'=>'Home','middleware'=>['isUserLogin']],function (){
// Route::group(['prefix'=>'home','namespace'=>'Home'],function (){
    // 购物车提交到订单 (判断登录)
Route::get('toorder', 'OrderController@info');
// 收货地址
Route::post('jsy', 'OrderController@jsy');
Route::get('finish', 'OrderController@finish');
Route::get('ok', 'OrderController@ok');
// 订单详情
Route::get('detail', 'DetailController@detail');
// 退出
Route::get('loginout', 'LoginController@loginout');
//改密
Route::get('reg', 'LoginController@reg');
Route::get('repass', 'LoginController@repass');
// 个人中心
Route::get('userinfo', 'InfoController@userinfo');
Route::post('changeUserInfo', 'InfoController@changeUserInfo');

 });  
// 登录
Route::get('home/login', 'Home\LoginController@login');
Route::post('home/dologin', 'Home\LoginController@dologin');

// 注册
Route::post('home/dorepass', 'Home\LoginController@dorepass');
Route::post('home/doreg', 'Home\LoginController@doreg');
// 2.数据处理 addcart跳转过来  =>引入product.cart
Route::get('/cart', 'Home\ShopController@cart')->name('cart'); 
 Route::get('/','Home\IndexController@index');