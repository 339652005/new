<?php
// 命名空间加 \Admin 
namespace App\Http\Controllers\Admin;

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
// use Gregwar\Captcha\CaptchaBuilder;
// use Gregwar\Captcha\PhraseBuilder;
// Input的使用
use Illuminate\Support\Facades\Input;

// 表单验证
use Illuminate\Support\Facades\Validator;

// 使用自定义Model
use App\Http\Model\Manager;
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
        return view('admin.adminlogin.login');  
    }
    
    public function dologin(Request $request)
    {

        // 1.接受数据
        $input = Input::except('_token');

        // 2.表单验证Validator 三种方式了解
        $rule=[
            'manager_name'=>'required|between:1,12',  // 规则:非空 位数
            'manager_pwd'=>'required|between:1,12',
        ];
        $msg = [
            'manager_name.required'=>'用户名为空',  // 错误返回信息
            'manager_name.between'=>'用户名为4-18位',
            'manager_pwd.required'=>'密码为空入',
            'manager_pwd.between'=>'密码为4-18位'
        ];
        // 2-2进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('admin/login')  // 跳转
                ->withErrors($validator)    // 返回错误
                ->withInput();              //数据闪存
        }

        // 3.逻辑验证
        if($input['code'] != session('code')){
            return redirect('admin/login')->with('errors','验证码错误')->withInput();
        }

        // 检测该登录用户是否存在
        $manager = Manager::where('manager_name','=',$input['manager_name'])->first();
        if(!$manager){
            return redirect('admin/login')->with('errors','此用户不存在')->withInput();
        }

        // 检测是否禁用
        if ($manager->manager_status==0) {
           return redirect('admin/login')->with('errors','账号锁定,禁止登陆')->withInput();
        }
       
        // 3.2 密码是否正确
        if(Crypt::decrypt($manager->manager_pwd)  !=   $input['manager_pwd']){
         
        return redirect('admin/login')->with('errors','密码错误')->withInput();
        }
        // session存数据 管理员
        $manager_id =  $manager->manager_id;
        $request->session()->forget('manager_id');  // 清楚其他的 下线
        $request->session()->push('manager_id', $manager_id);
            // 5.后台首页
        return redirect('admin/index');     
        
    }

    /* 显示登录 */ 
    public function index( )
    {
        return view('admin.adminlogin.index');
    }

    /*首页*/
    public function welcome()
    {
       //dd($_SERVER);  // 服务器信息
        return view('admin.adminlogin.welcome');
    }

    public function quit()
    {
        // session()->flush(); //退出销毁对应session
        $request->session()->forget('manager_id');  //  下线
       // 或者 session(['user'=>null]);
        return redirect('admin/login');
    }

    // 自定义验证码
    public function yzm( )
    {
        $code = new Code();
        $code->make();
    }

    // composer验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

}  //this is end of the loginController
