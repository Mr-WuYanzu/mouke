<?php

namespace App\Http\Controllers\Common;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 *
 * class CommonController
 * @author   <[<email address>]>
 * @package  App\Http\Controllers\Common
 * @date 2019-08-08
 */
class CommonController extends Controller
{
    /**
	 * [跳转页面]
	 * @param  [type] $msg [description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
    public function abort($msg,$url)
    {
    	echo "<script>alert('{$msg}');location.href='{$url}';</script>";
    }

    /**
     * [成功时的响应信息]
     * @param  string  $msg  [description]
     * @param  integer $code [description]
     * @param  integer $skin [description]
     * @return [type]        [description]
     */
    public function json_success($msg='success',$code=1,$skin=6)
    {
    	return $this->_Output($msg,$code,$skin);
    }

    /**
     * [失败时的响应信息]
     * @param  string  $msg  [description]
     * @param  integer $code [description]
     * @param  integer $skin [description]
     * @return [type]        [description]
     */
    public function json_fail($msg='fail',$code=2,$skin=5)
    {
    	return $this->_Output($msg,$code,$skin);
    }

    /**
     * [返回json格式响应信息]
     * @param  [type] $msg  [description]
     * @param  [type] $code [description]
     * @param  [type] $skin [description]
     * @return [type]       [description]
     */
    public function _Output($msg,$code,$skin)
    {
    	$arr=[
    		'font'=>$msg,
    		'code'=>$code,
    		'skin'=>$skin
    	];
    	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    }

    //查找用户信息
    public function getUserInfo(){
       $user_id = session('user_id');
//        $user_id=5;
       $userInfo =  \App\user\User::where(['user_id'=>$user_id,'status'=>1])->first();
       return $userInfo;
    }
}
