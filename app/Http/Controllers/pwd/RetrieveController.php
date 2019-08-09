<?php

namespace App\Http\Controllers\pwd;

use App\user\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RetrieveController extends Controller
{
    protected $url='http://1810.mk.com/updpwd';
    protected $email='';
    //找回密码
    public function getpwd(){
        return view('pwd.getpwd');
    }
//  验证邮箱，发送连接至用户邮箱
    public function getpwdDO(Request $request){
        $email = $request->post('email');
        if(empty($email)){
            return ['status'=>101,'msg'=>'请输入邮箱'];
        }
        $reg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/';
        if(!preg_match($reg,$email)){
            return ['status'=>101,'msg'=>'请输入正确的邮箱'];
        }
        //查询数据库有无此用户
        $where=[
            'user_mail'=>$email
        ];
        $userInfo = User::where($where)->first();
        if(empty($userInfo)){
            return ['status'=>101,'msg'=>'请输入正确的邮箱账号'];
        }
        $data = encrypt($userInfo['pwd'].env('PWD'));
        //查到此用户,发送邮件
        $this->url .= '?user_email='.$email.'&data='.$data;
        $emails = [$email];
        Mail::send('email.email', ['data'=>$this->url], function($message) use ($emails)
        {
            $message->to($emails)->subject('This is test e-mail');
        });
        if(empty(Mail:: failures())){
            return ['status'=>200,'msg'=>'连接已发送至您的邮箱，请注意查收'];
        }
    }

    //用户验证通过修改密码页面
    public function updpwd(Request $request){
        $user_mail = $request->get('user_email');
        $data = $request->get('data');
        if(empty($user_mail) || empty($data)){
            echo '无法访问';die;
        }
        //查询数据库有无此用户
        $where=[
            'user_mail'=>$user_mail
        ];
        $userInfo = User::where($where)->first();
        if(empty($userInfo)){
            echo '无法访问';die;
        }
        $encrypt = decrypt($data);
        if($userInfo['pwd'].env('PWD') != $encrypt){
            echo '无法访问';
        }
        //验证通过展示设置密码页面
        return view('pwd.setpwd',['user_mail'=>$user_mail,'data'=>$data]);
    }

    //用户重置密码
    public function setpwd(Request $request){
        $user_mail = $request->post('user_mail');
        $data = $request->post('data');
        $pwd = $request->post('pwd');
        if(empty($user_mail) || empty($data || empty($pwd))){
            return ['status'=>102,'msg'=>'缺少参数'];
        }
        //查询数据库有无此用户
        $where=[
            'user_mail'=>$user_mail
        ];
        $userInfo = User::where($where)->first();
        if(empty($userInfo)){
            return ['status'=>102,'msg'=>'参数发生了变化'];
        }
        //验证用户的加密参数
        $encrypt = decrypt($data);
        if($userInfo['pwd'].env('PWD') != $encrypt){
            return ['status'=>102,'msg'=>'参数发生了变化'];
        }
        //验证用户修改的密码是否和当前密码一样
        if($userInfo['pwd']==$pwd){
            return ['status'=>102,'msg'=>'新密码不能和旧密码相同'];
        }
        //验证通过
        $result = User::where(['user_id'=>$userInfo['user_id']])->update(['pwd'=>$pwd]);
        if($result){
            return ['status'=>200,'msg'=>'重置成功'];
        }else{
            return ['status'=>102,'msg'=>'重置失败'];
        }
    }
}
