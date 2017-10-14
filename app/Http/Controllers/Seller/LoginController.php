<?php
// 命名空间加 \Admin 
namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
 
use App\Http\Requests;
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
         // return app_path();   //测试
        // 1.接受数据
        $input = Input::except('_token');
        
        $rule=[
            'seller_name'=>'required|between:1,12',  // 规则:非空 位数
            'seller_pwd'=>'required|between:1,12',
        ];
        $msg = [
            'seller_name.required'=>'用户名为空',  // 错误返回信息
            'seller_name.between'=>'用户名为4-18位',
            'seller_pwd.required'=>'密码为空入',
            'seller_pwd.between'=>'密码为4-18位'
        ];
        
        $validator = Validator::make($input,$rule,$msg);
        //  如果验证失败(返回)验证通过(继续逻辑验证)
        if ($validator->fails()) {
            return redirect('seller/login')  // 跳转
                ->withErrors($validator)    // 返回错误
                ->withInput();              //数据闪存
        }
      
        if($input['code'] != session('code')){
            return redirect('seller/login')->with('errors','验证码错误')->withInput();
        }
        
        // 自定义的Model Manager
        $seller = Seller::where('seller_name','=',$input['seller_name'])->first();
         // dd(session('code'));
        if(!$seller){
            return redirect('seller/login')->with('errors','此用户不存在')->withInput();
        }
        
        if( Hash::check($input['seller_pwd'],$seller->seller_pwd) ){
             return redirect('seller/login')->with('errors','密码错误')->withInput();
        }
       // 通过  数据信息存入 session  用户名唯一 
       // $sellerInfo = DB::table('dc_seller')->where('seller_name',$input['seller_name'])->first();

    // 数据信息存入 session $seller_id 清楚其他的下线
    // $request->session()->flush();
    $seller_id =  $seller->seller_id;
    $request->session()->push('seller_id', $seller_id);
    // print_r( $request->session()->all());
    // 获取测试
    // $data = $request->session()->all();
    // $data = $request->session()->get('seller_id');
    // dd($data[0]);
       // return redirect('seller/index');     
    return redirect('seller/index',compact('seller_id'));     
    }

    public function index( )
    {
        return view('seller.sellerlogin.index');

    }

    public function welcome()
    {
       //dd($_SERVER);
        return view('seller.sellerlogin.welcome');
    }

    public function quit()
    {
        session()->flush();

//        或者
//        session(['user'=>null]);

        return redirect('seller/login');
   }

    public function yzm( )
    {
        $code = new Code();
        $code->make();
    }

    



}  //this is end of the loginController
