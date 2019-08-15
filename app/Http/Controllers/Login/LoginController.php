<?php

namespace App\Http\Controllers\Login;
use Illuminate\Http\Request;
//use App\Libs\SDK\SaeTOAuthV2;
//use App\Libs\SDK\SaeTClientV2;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
//use SaeTOAuthV2;
/**
 * 登录模块
 * class LoginController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Login
 * $date 2019-08-08
 */
class LoginController extends Controller
{
	/**
	 * [注册页面]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function register(Request $request)
	{
		//渲染视图
		return view('login/register');
	}
	
	/**
	 * [注册执行页面]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function registerdo(Request $request)
	{
		$data = $request->post();
		$user_mail = $data['user_mail'];
		$user_name = $data['user_name'];
		$pwd = $data['pwd'];
		$pwd1 = $data['pwd1'];

		if($pwd != $pwd1){
			echo "3";die;
		}
		unset($data['pwd1']);
		unset($data['_token']);
		$user_pwd = encrypt($pwd);
		$data['pwd'] = $user_pwd;
		$res = UserModel::insert($data);
		if($res){
			echo "1";die;
		}else{
			echo "2";die;
		}
		/*
			$validate =  $request->validate(
				['user_mail'=>"required|unique:user,user_mail|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$",
				'pwd'=>"required|max:20|min:5|regex:/^[\dA-Za-z_]{5,20}$/",
				'user_name'=>"required|unique:user,user_name|regex:/^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/",],
				[
				"user_name.required"=>'用户名不能是空',
				"user_name.unique"=>'用户名已经存在',
				"user_name,regex"=>'请注意查看用户名规则',
				"user_mail.required"=>'邮箱必填',
				"user_mail.unique"=>'邮箱已被注册',
				"user_mail,regex"=>'请注意查看邮箱规则',
				"pwd.required"=>'密码不能是空',
				"pwd.min"=>"密码不能小于5位",
				"pwd.max"=>"密码不能大于20位",
				"pwd.regex"=>"请注意查看密码规则",
			]);
			dd($validate->errors());
		*/
		$res = UserModel::insert($data);

	}

    /**
     * 邮箱唯一性验证
     */
    public function checkmail(Request $request)
    {
        $user_mail = $request->post('user_mail');
        $res = UserModel::where(['user_mail'=>$user_mail])->first();
//        print_r($res);die;
        if($res){
//            echo 1111;die;
            return ['code'=>300,'msg'=>'邮箱已存在！'];
        }
    }
    /**
     * 用户名唯一性验证
     */
    public function checkname(Request $request)
    {
        $user_name = $request->post('user_name');
        $res = UserModel::where(['user_name'=>$user_name])->first();
//        print_r($res);die;
        if($res){
//            echo 1111;die;
            return ['code'=>300,'msg'=>'用户名已存在！'];
        }
    }
	/**
	 * [登录页面]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function login(Request $request)
    {
    	//渲染视图
    	return view('login/login');
	}
	public function logindo(Request $request)
    {
		$data = $request->post();
		$reg='/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
		$user_info = $data['user_info'];
		$login_pwd = $data['pwd'];
		$info = preg_match($reg,$user_info);

		if($info){
			$result = UserModel::where(['user_mail'=>$user_info])->first();
			$pwd = $result['pwd'];
			if($result){
				$time = time();
				$last_error_time = $result['last_error_time'];
				$error_num = $result['error_num'];
				$where = [
					'user_id'=>$result['user_id']
				];
				$pwd = decrypt($pwd);
				//密码错误
				if($login_pwd != $pwd){
					if($time-$last_error_time>3600){
					
						$updInfo = [
							'error_num'=>1,
							'last_error_time'=>$time
						];
						$res = UserModel::where($where)->update($updInfo);
						if($res){
							
							return ['code'=>301,'msg'=>'账号或密码错误您还有两次机会'];
						}
					}else{
						
						if($error_num>=3){
							
							$second = 30 - ceil(($time-$last_error_time)/60);
							return ['code'=>302,'msg'=>"账号已锁定请在{$second}再次访问"];
						}else{
							$num = $error_num + 1;
							$updInfo = [
								'error_num'=>$num,
								'last_error_time'=>$time
							];
							$res = UserModel::where($where)->update($updInfo);
							if($res){
						
								if($num >= 3){
									
									$second = 60-ceil(($time-$last_error_time)/60);
									// echo "账号已经被锁定请在.$second.分钟后重试";
									return ['code'=>303,'msg'=>"账号已锁定请在{$second}再次访问"];
								}else{
									$num = $error_num+1;
									$updInfo = [
										'error_num'=>$num,
										'last_error_time'=>$time,
									];
									// print_r($updInfo);die;
									$res = UserModel::where($where)->update($updInfo);
									// echo $res;die;
									if($res == 0){
									
										if($num == 3){
										
											// echo "账号已经被锁定,请一小时后登录";
											return ['code'=>304,'msg'=>"账号已经被锁定,请一小时后登录"];
										}else{
										
											// echo "账号密码有误你还有.(3-$num).次机会";
											$number = 3-$num;
											return ['code'=>305,'msg'=>"账号密码有误你还有{$number}次机会"];
										}
									}
								}
							}
						}
					}
					//密码正确
				}else{
					if($error_num>=5&&$time-$last_error_time<3600){
						$second = 60 - ceil(($time-$last_error_time)/60);
						echo "账号已锁定";
						return ['code'=>306,'msg'=>"账号已锁定"];
					}
					//将错误次数改为0 错误时间改为null
					$updInfo = [
						'error_num'=>0,
						'last_error_time'=>null
					];
					$res = UserModel::where($where)->update($updInfo);
					// echo $res;die;
					if($res == 0){
						// echo "登陆成功";die;
						// session(['user_id'=>$result['user_id']]);
						$user_id = [
							'user_id'=>$result['user_id'],
						];
						session($user_id);
						// dd($data);
						return ['code'=>200,'msg'=>"登录成功，即将进入主页"];
					}else{
						return ['code'=>401,'msg'=>"登录失败"];
					}
				}
			}else{
				return ['code'=>400,'msg'=>"邮箱或用户名不存在"];
			}
		}else{
			$result = UserModel::where(['user_name'=>$user_info])->first();
			$pwd = $result['pwd'];
			if($result){
				$pwd = decrypt($pwd);
				if($login_pwd != $pwd){
					echo "1";die;
				}else{
					echo "2";die;
				}
			}else{
				echo "3";die;
			}
		}
    }

    /**
     * 微博授权页面
     */

    public function callback(Request $request)
    {
        header("Access-Control-Allow-Origin:*");
        set_time_limit(0);
        $code = $request->code;
//        dd($code);die;

        $url = "https://api.weibo.com/oauth2/access_token?client_id=2961575350&client_secret=c9e9aa201d9558c60ea12f85a898702e&grant_type=authorization_code&redirect_uri=http://education.com/callback&code=".$code;
        $data = $this->curl($url);
//        dd($data);


        //获取微博登陆用户的信息
        $userInfo=json_decode($data,true);
        $token = $userInfo['access_token'];
        $uid = $userInfo['uid'];
//        dd($userInfo);
        $urla="https://api.weibo.com/2/users/show.json?access_token=$token&uid=$uid";
//        dd($urla);
//        $uu = $this->curl($urla);
        $uu = file_get_contents($urla);
//        dd($uu);
        $user = json_decode($uu,true);
        $user_name = $user['screen_name'];
        $data = [
            'user_name'=>$user_name,
            'create_time'=>time()
        ];
        $res = UserModel::insert($data);
//        dd($res);
        if($res){
//            $this->success("登陆成功");
//            echo "11111";die;
            echo "<script>alert('登陆成功');location.href='/index'</script>";
        }else{
//            $this->success("失败");
//            echo "22222";die;
            echo "<script>alert('登录失败，请重新登陆');location.href='/login'</script>";
        }

//        dd($user);
    }

    //失败提示
     public function fail($font){
        $arr=[
            'font'=>$font,
            'code'=>2
        ];
        echo json_encode($arr);exit;
    }
//成功提示
    public function success($font){
        $arr=[
            'font'=>$font,
            'code'=>1
        ];
        echo json_encode($arr);exit;
    }

    protected function curl($url)
    {
        //curl初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }
/*
    protected function get($url)
    {
        //curl初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_GET, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }
*/
}
