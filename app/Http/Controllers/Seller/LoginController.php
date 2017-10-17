<?php
namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Http\Model\Sellers;
use App\Http\Model\Shop;

// Controller.php所在命名空间
use App\Http\Controllers\Controller;
// 使用验证码的命名空间
/*app_path()  C:\xampp\htdocs\ele_project\app
bash_path()
public_path()
resourse_path()*/

require_once app_path().'/Http/Org/code/Code.class.php';
use App\Http\Org\code\Code;

// composer使用验证码
//use Gregwar\Captcha\CaptchaBuilder;
//use Gregwar\Captcha\PhraseBuilder;
// Input的使用
use Illuminate\Support\Facades\Input;

// 表单验证
use Illuminate\Support\Facades\Validator;

// 使用自定义Model
use App\Http\Model\Seller;
// 密码处理
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Hash;
// session
use Illuminate\Support\Facades\Session;

use DB;
class LoginController extends Controller
{
    /**
     * 返回后台登录视图
     * @author 
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
         
        return view('seller.sellerlogin.login');  
    }
    
    public function dologin(Request $request)
    {
        // 互殴数据
        $input = Input::except('_token');
        // 验证表单
        $rule=[
            'seller_name'=>'required|between:4,12',  
            'seller_pwd'=>'required|between:4,12',
        ];
        $msg = [
            'seller_name.required'=>'用户名为空',  // 错误返回信息
            'seller_name.between'=>'用户名为4-12位',
            'seller_pwd.required'=>'密码为空入',
            'seller_pwd.between'=>'密码为4-12位'
        ];
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('seller/login')  // 跳转
                ->withErrors($validator)     // 返回错误
                ->withInput();               //数据闪存
        }
        
        // 逻辑判断
        if($input['code'] != session('code')){
            return redirect('seller/login')->with('errors','验证码错误')->withInput();
        }

        // 检测该登录用户是否存在
        $seller = Seller::where('seller_name','=',$input['seller_name'])->first();
            if(!$seller){
                return redirect('seller/login')->with('errors','此用户不存在')->withInput();
            }

        // 密码是否正确
        if(Crypt::decrypt($seller->seller_pwd) !=  $input['seller_pwd']){
            return redirect('seller/login')->with('errors','密码错误')->withInput();
        }
      
        // 检测是否被官方禁止登陆
        if ($seller->seller_status==0) {
           return redirect('seller/login')->with('errors','账号锁定,禁止登陆')->withInput();
        }

        // 数据信息存入 session $seller_id 清楚其他的下线
        // $request->session()->flush();
        $seller_id =  $seller->seller_id;
       
        // 清理之前的 seller_id
        $request->session()->forget('seller_id');
        $request->session()->push('seller_id', $seller_id);
        // 获取测试
        // $data = $request->session()->all();
        // $data = $request->session()->get('seller_id');
        // print_r($data);  //dd阻止session写入
        return redirect("seller/index");  
    }  

    // 显示首页 框架导航 店主信息传递
    public function index( Request $request)
    {
        // return 'index';
        $seller_id = $request->session()->get('seller_id')[0];
        // dd( $seller_id);
        $self = Sellers::find($seller_id);
        // dd( $self);
        $selfShop = Shop::where('seller_id',$seller_id)->first();
        // dd($selfShop );
        return view('seller.sellerlogin.index',compact('self','selfShop'));
    }

    // 显示欢迎页 内嵌ifram界面
    public function welcome(Request $request)
    {
        // dd($_SERVER);
        return view('seller.sellerlogin.welcome');
    }
//===========================================================================
     /* 注册 */ 
    public function reg( )
    {
      return view('seller.sellerlogin.reg');
    }

     /* 注册 */ 
    public function doreg(Request $request)
    {
         // return 'reg';
         // 1 接受前台用户传过来的数据
          $input = $request->except('_token');
          
        // 2.表单验证
        $rule=[     // 常用
            'seller_name'=>'required|regex:/^\w{4,12}$/', 
            'seller_pwd'=>'required|regex:/^\w{4,12}$/',
            'seller_repwd'=>'required|same:seller_pwd',
            'seller_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'seller_email'=>'required|email',
            'seller_status'=>'required',
           
        ];
        $msg = [
            // 常用
            'seller_name.required'=>'请输入用户名',  // 错误返回信息
            'seller_pwd.required'=>'请输入密码',
            'seller_repwd.required'=>'请输入密码',
            'seller_name.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'seller_email.required'=>'请输入邮箱',
            'seller_tell.required'=>'请输入电话',
            'seller_tell.regex'=>'手机号码输入不正确',
            'seller_email.email'=>'邮箱输入不正确',
            // 状态权限
            'seller_status.required'=>'请输入状态',

        ];

      
        // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
          // dd();
            return redirect('seller/reg')  // 跳转admin/manager/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
// dd();
      
        // 执行数据库添加操作（向user表添加一条记录）
          // 第一种添加方式（创建一个空模型，给模型的属性赋值，然后执行save方法）
           $seller = new seller();
           $seller->seller_name = $input['seller_name'];
           $seller->seller_tell = $input['seller_tell'];
           $seller->seller_email = $input['seller_email'];
           $seller->seller_status = $input['seller_status'];
           // $seller->seller_auth = $input['seller_auth'];
           // 加密
           $seller->seller_pwd = Crypt::encrypt($input['seller_pwd']) ;

       
        // 新数据存入
        $res = $seller->save();

      //  3 判断执行是否成功->with('errors','账号锁定,禁止登陆')->withInput();
      if($res){
          return redirect('/seller/login')->with('errors','注册信息已经提交,请耐心等待管理员联系');   
      }else{
          return redirect('/seller/login')->with('errors','注册失败');  
      }
    }


    // 退出登陆 销毁session
    public function loginout(Request $request)
    {
        // return 'loginout';
        $request->session()->forget('seller_id');
        // 或者 session(['seller_id'=>null]);
        return redirect('seller/login')->with('errors','您已退出登陆');  ;
    }
//======================================================================
    // 个人信息
    public function selfinfo(Request $request,$id)
    {
        // return 'myselfinfo';
        $seller = Sellers::find($id);
        $seller->seller_pwd = Crypt::decrypt($seller->seller_pwd);
        return view('seller.sellerlogin.selfinfo',compact('seller')); 
    }
//====================================================================
     public function changeSelfInfo(Request $request,$id)
    {
        // return '修改信息';
           $input = $request->except('_token');
           // dd($input);
        // 2.表单验证
        $rule=[     // 常用
            'seller_name'=>'required|regex:/^\w{4,12}$/', 
            'seller_pwd'=>'required|regex:/^\w{4,12}$/',
            'seller_repwd'=>'required|same:seller_pwd',
            'seller_tell'=>'required|regex:/^1[3578]\d{9}$/',
            'seller_email'=>'required|email',
            'seller_status'=>'required'
        ];
        $msg = [
            // 常用
            'seller_name.required'=>'请输入用户名',  // 错误返回信息
            'seller_pwd.required'=>'请输入密码',
            'seller_repwd.required'=>'请输入密码',
            'seller_name.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.regex'=>'请输入4-12位数字,字母,下划线',
            'seller_pwd.same'=>'您两次输入的密码不一致',
            // 邮箱 电话
            'seller_email.required'=>'请输入邮箱',
            'seller_tell.required'=>'请输入电话',
            'seller_tell.regex'=>'手机号码输入不正确',
            'seller_email.email'=>'邮箱输入不正确',
            // 状态权限
            'seller_status.required'=>'请输入状态'
        ];
         // 2-2进行表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return back()  // 跳转admin/user/create
                ->withErrors($validator)             // 返回错误
                ->withInput();                       //数据闪存
        }
        // 检测该登录用户是否存在
        $seller = seller::where('seller_name','=',$input['seller_name'])->get();
        foreach ($seller as $key => $value) {
            //  存在// print_r($value->seller_id); 
            if(!empty($value) && ($value->seller_id!=$id)){
                return back()->with('errors','用户名已经存在');
            }
        }
        $sellers = seller::find($id);
           $sellers->seller_tell = $input['seller_tell'];
           $sellers->seller_email = $input['seller_email'];
           $sellers->seller_name = $input['seller_name'];
           $sellers->seller_status = $input['seller_status'];
           $sellers->seller_pwd = Crypt::encrypt($input['seller_pwd']);
        $re = $sellers->save();  
        if($re){
            return redirect('seller/welcome')->with('errors','信息更新成功'); 
        }else{
            return back()->with('errors','更新失败');  
        }
    }

    // 店铺信息
    public function shopinfo(Request $request ,$id)
    {
        // return 'index';
        $type =  DB::table('dc_type')->get();
        $shop= Shop::where('seller_id',$id)->first();
        // return view('admin.shop.edit',compact('shop','type'));
        // dd( $type);
        // dd($shopinfo);
        return view('seller.sellerlogin.shopinfo',compact('shop','type')); 
    }
    
      public function changeShopinfo(Request $request ,$id)
    {
        // return 'changeShopinfo';  //修改信息
         $input = $request->except('_token','_method');

        // 2 找到要修改的用户记录，
           $shop = Shop::find($id);
           $shop->shop_name = $input['shop_name'];
           $shop->type_id = $input['shop_type'];
           $shop->shop_addr = $input['shop_addr'];
           $shop->shop_x = $input['shop_x'];
           $shop->shop_y = $input['shop_y'];
           $shop->shop_desc = $input['shop_desc'];
           $shop->shop_logo = $input['shop_logo_url'];
           $shop->shop_licence = $input['shop_licence_url'];
           $shop->shop_zhizhao = $input['shop_zhizhao_url'];
           $shop->shop_status = $input['shop_status'];
           $re = $shop->save();   //save()保存数据
        if($re){
            return redirect('seller/welcome')->with('errors','店铺信息修改成功'); 
        }else{
            return redirect('seller/welcome/')->with('errors','店铺信息修改失败');  
        }
    }
//================================================================
    public function addShop(Request $request,$id)
    {
        // return '开店申请';
        // 店铺类型
        $type =DB::table('dc_type')->get();
        return view('seller.sellerlogin.addshop',compact('type')); 
    }
    public function doAddShop(Request $request)
    {
        // return '开店申请';
        // 店铺类型
        $type =  DB::table('dc_type')->get();

        // 1 接受前台用户传过来的数据
        $input = $request->except('_token');
        // 获取session 里的商户id
        $seller_id = $request->session()->get('seller_id')[0];
        // dd( $seller_id);
        // dd($input);
        // 2.第一种添加方式创建一个空模型给模型的属性赋值然后执行save方法）
           $shop = new Shop();
           $shop->shop_name = $input['shop_name'];
           $shop->seller_id = $seller_id;
           $shop->shop_addr = $input['shop_addr'];
           // $shop->shop_type = $input['shop_type'];//下面type_id
            $shop->type_id = $input['shop_type'];
           $shop->shop_x = $input['shop_x'];
           $shop->shop_y = $input['shop_y'];
           $shop->shop_desc = $input['shop_desc'];
           $shop->shop_status = $input['shop_status'];
           $shop->shop_logo = $input['shop_logo_url'];
           $shop->shop_licence = $input['shop_licence_url'];
           $shop->shop_zhizhao = $input['shop_zhizhao_url'];
            // dd($shop);
           $re = $shop->save();
           
          if($re){
              return redirect('seller/welcome')->with('errors','店铺添加成功,请刷新系统');
          }else{
              return redirect('seller/welcome')->with('errors','店铺添加失败');  //添加页
          }
    }

//=================================================================
    // 登陆界面验证码
    public function yzm( )
    {
        $code = new Code();
        $code->make();
    }


}  //this is end of the loginController
