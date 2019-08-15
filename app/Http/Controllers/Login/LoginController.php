<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
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
		
		$mail = UserModel::where(['user_mail'=>$user_mail])->first();
		$name = UserModel::where(['user_name'=>$user_name])->first();
		if($mail){
			echo "5";die;
		}else if($name){
			echo "4";die;
		}else if($pwd != $pwd1){
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
}
