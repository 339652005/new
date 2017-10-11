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
*/
// 根目录
Route::get('/', function () {
    return view('welcome');
});

// 1-1登录的路由
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('admin/yzm','Admin\LoginController@yzm');
//Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');   
//通过composer安装的验证码


// 1-2显示后台首页
Route::get('admin/index','Admin\LoginController@index');
Route::get('admin/welcome','Admin\LoginController@welcome');
// 1-3退出的路由
Route::get('admin/loginput','Admin\LoginController@loginout');
// 1-4修改密码的路由
Route::get('admin/repass','Admin\LoginController@repass');


// 2.官方管理员
Route::resource('admin/manager','Admin\ManagerController');
// 3.商家管理
Route::resource('admin/seller','Admin\SellerController');
// 4.用户管理
Route::resource('admin/user','Admin\UserController');
// 5.店铺管理
Route::resource('admin/shop','Admin\ShopController');
//ajax上传文件
Route::post('admin/uploadLogo','Admin\ShopController@uploadLogo');
Route::post('admin/uploadZhizhao','Admin\ShopController@uploadZhizhao');
Route::post('admin/uploadLicence','Admin\ShopController@uploadLicence');
// 修改信息与上传图片矛盾的解决
Route::post('admin/shop/{id}','Admin\ShopController@update');
// 7.店铺分类
Route::resource('admin/type','Admin\TypeController');
// 8.商品管理
Route::resource('admin/foods','Admin\FoodsController');
Route::post('admin/foods/upload','Admin\FoodsController@uploadLogo');
// 矛盾的解决
Route::post('admin/foods/{id}','Admin\FoodsController@update');

// 6.套餐管理
Route::resource('admin/taocan','Admin\TaocanController');

// 权限管理
	  //  角色路由
    Route::resource('admin/role','admin\RoleController');
    Route::get('admin/role/auth/{id}','admin\RoleController@auth');
    Route::post('admin/role/doauth','admin\RoleController@doAuth');

       //  权限路由
    Route::resource('admin/permission','admin\PermissionController');
  	   // 用户页面的 授权按钮 路由
    Route::get('admin/user/auth/{id}','admin\UserController@auth');
    Route::post('admin/user/doauth','admin\UserController@doAuth');
    //如果没有权限，给一个没有权限的提示页面
	Route::get('admin/nopermission',function(){
	    return view('errors.permission');
	});