<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 前台模块类
 * class IndexController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Index
 * @date 2019-08-08
 */
class IndexController extends Controller
{
    public function index(Request $request)
    {
    	//渲染视图
    	return view('index/index');
    }
}
