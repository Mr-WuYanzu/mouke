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
		// print_r($data);s
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
}
