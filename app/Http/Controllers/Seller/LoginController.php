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

        // 存在检验密码
        // if( Hash::check($input['seller_pwd'],$seller->seller_pwd) ){
        //      return redirect('seller/login')->with('errors','密码错误')->withInput();
        // }

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
        // $seller_id =  2;

        // $request->session()->forget('seller_id');
        $request->session()->push('seller_id', $seller_id);
        // 获取测试
        $data = $request->session()->all();
        // $data = $request->session()->get('seller_id');
        // print_r($data);  //dd阻止session写入
        return redirect("seller/index");  
    }

    // 显示首页 框架导航 店主信息传递
    public function index( Request $request)
    {
        $seller_id = $request->session()->get('seller_id')[0];
        // dd( $seller_id);
        $self = Sellers::find($seller_id);
        $selfShop = Shop::where('seller_id',$seller_id)->first();
        // dd($self->seller_name);

        return view('seller.sellerlogin.index',compact('self','selfShop'));
    }

    // 显示欢迎页 内嵌ifram界面
    public function welcome(Request $request)
    {
        // dd($_SERVER);
        return view('seller.sellerlogin.welcome');
    }

    // 退出登陆 销毁session
    public function loginout()
    {
        return 'loginout';
        $request->session()->forget('seller_id');
        // 或者 session(['seller_id'=>null]);
        return redirect('seller/login');
    }

    // 个人信息
    public function selfinfo()
    {
        // return 'myselfinfo';
        // 获取session 里的id

        return redirect('seller/login');
    }

    // 店铺信息
    public function shopinfo()
    {
        return 'myselfinfo';
       
        return redirect('seller/login');
    }

    // 登陆界面验证码
    public function yzm( )
    {
        $code = new Code();
        $code->make();
    }


}  //this is end of the loginController
