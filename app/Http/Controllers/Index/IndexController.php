<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 前台模块类
 * class IndexController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Index
 * @date 2019-08-08
 */
class IndexController extends CommonController
{
    public function index(Request $request)
    {
    	//渲染视图
        $userInfo = $this->getUserInfo();
        if(empty($userInfo)){
            return view('index/index');
        }else {
            return view('index/index', ['user_id' => $userInfo['user_id'], 'user_name' => $userInfo['user_name']]);
        }

    }
}
