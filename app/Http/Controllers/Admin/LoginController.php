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
//use Gregwar\Captcha\CaptchaBuilder;
//use Gregwar\Captcha\PhraseBuilder;
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
        // return app_path();   //测试
        return view('admin.login');  
    }
    
    public function dologin(Request $request)
    {
         //return 'first';   //测试
        // return $request->all();   //返回json对象形式
//          $request->all();
//          $request->only('_token');
//          $input = Input::except('_token');

        // 1.接受数据
        $input = Input::except('_token');
        //dd($input); //manager_pwd manager_pwd
        // 2.表单验证Validator 三种方式了解
        // 对提交过来的数据进行表单验证   位数 非空 (正则)
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
        // Validator::make('要进行表单验证的数据'，‘验证规则’,'设置提示信息')
        $validator = Validator::make($input,$rule,$msg);
        //  如果验证失败(返回)验证通过(继续逻辑验证)
        if ($validator->fails()) {
            return redirect('admin/login')  // 跳转
                ->withErrors($validator)    // 返回错误
                ->withInput();              //数据闪存
        }
        // 3.逻辑验证
        // dd($input['code']);
        

        if($input['code'] != session('code')){
            return redirect('admin/login')->with('errors','验证码错误')->withInput();
        }
        // Manager model

        // 自定义的Model Manager
        $manager = Manager::where('manager_name','=',$input['manager_name'])->first();
         // dd(session('code'));
        if(!$manager){
            return redirect('admin/login')->with('errors','此用户不存在')->withInput();
        }
        //  密码是否正确使用hash哈希加密
        // return Hash::make($input['manager_pwd']);  //$2y$10$OSKZAC/0Uy/PfSndOiZpY../8kVIDSyLt3iedyFQUJ33fcXJI2U2O
        if( Hash::check($input['manager_pwd'],$manager->manager_pwd) ){
             return redirect('admin/login')->with('errors','密码错误')->withInput();
        }

       /* 
        *1.密码加密方式 MD5加密+外延 例如'abs'+md5()
        *2.hash加密 60位秘钥  Hash::check(要被验证的密码,已经加密的密码)
        *3.Crypt 秘钥255位 Crypt:encrypt加密 decrypt解密
        */
       

/*  第一种加密方式:Crypt(255位加密)  */
//Crypt::encrypt()  加密
//Crypt::decrypt()  解密
        /* dd(Crypt::encrypt($manager->manager_pwd));//eyJpdiI6Ild5YlBVQXBaVGVSSTNyMk9jREdYMHc9PSIsInZhbHVlIjoiR01LK0s5U0lEZ3E0aUR0MCtwSm9pUT09IiwibWFjIjoiMGZjMWU3ZjVkMDhkNWRhMTQxZTY5NDQ1N2EyZTI0YTNmYTBjYzlkYTg4NjI4Y2ZiYjJlYTVjMTliMTJiMzM1ZCJ9 数据库不是这种加密的报错 把这个加密后的字符串复制金数据库
         if(Crypt::decrypt($manager->manager_pwd)  !=   $input['manager_pwd']){
             return redirect('admin/login')->with('errors','密码错误')->withInput();
         }*/

/*  第二种加密方式:MD5(32位加密)  */ 
        /*$salt = 'abc';  // md5()加密不够安全已经破解加上前延
        $str = $salt.$input['manager_name'];
        dd(md5($str));
        //b508656c244c20b3c8dd7993d7832f39*/


/*  第三种加密方式:哈希加密(60位加密)  */   
//  Hash::make()   加密
//  Hash::check()  验证被加密密码   
       /* echo Hash::make('123456');   //以密码123456为例
        $str = '$2y$10$G3p/Pc5LpBQ6uTnaxaPO6eycWp15tKobmJzTo7T3ntEN8hwBSHD4W';
        //哈希加密(60位加密)密码是动态变化的 => Hash::check() 检查
        
        // hash验证密码是否正确(每一个出现过的密码都正确)
        // Hash::check(要被验证的密码,经过hash加密后的密码)
        if(Hash::check('123456',$str)) {
            echo "密码正确";
        }else{
            echo '密码错误';
        }
        */

        // 4.session
       
       $managerInfo = DB::table('dc_manager')->where('manager_name',$input['manager_name'])->first();
      
       // 数据存入session
        // 5.后台首页
       return redirect('admin/index');   

        
    }
    public function index( )
    {
        return view('admin.index');

    }

    public function welcome()
    {
       //dd($_SERVER);
        return view('admin.welcome');
    }

    public function quit()
    {
        session()->flush();

//        或者
//        session(['user'=>null]);

        return redirect('admin/login');
   }

    public function yzm( )
    {
        $code = new Code();
        $code->make();
    }

    // composer验证码生成(第二种方式查找手册)
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
