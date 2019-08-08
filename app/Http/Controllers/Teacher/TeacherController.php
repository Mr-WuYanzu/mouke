<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 讲师模块类
 * class TeacherController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Teacher
 * @date 2019-08-08
 */
class TeacherController extends Controller
{
	/**
	 * [讲师列表]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function teacherList(Request $request)
    {
    	//渲染视图
    	return view('teacher/teacherlist');
    }

    /**
     * [讲师详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function teachercont(Request $request)
    {
    	//渲染视图
    	return view('teacher/teachercont');
    }
}
