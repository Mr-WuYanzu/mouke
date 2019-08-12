<?php

namespace App\Http\Controllers\Curr;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\CurrCommentModel;
use Illuminate\Support\Facades\Redis;
/**
 * 课程模块类
 * class CurrController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Curr
 * @date 2019-08-08
 */
class CurrController extends CommonController
{
	/**
	 * [课程列表]
	 * @return [type] [description]
	 */
    public function currList(Request $request)
    {
    	//渲染模版
    	return view('curr/currlist');
    }

    /**
     * [课程内容]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function currcont(Request $request)
    {
    	//渲染模版
    	return view('curr/currcont');
    }

    /**
     * [章节列表]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function chapterlist(Request $request)
    {
        //接收课程id
        $curr_id=1;
        //实例化模型类
        $commentModel=new CurrCommentModel();
        //查询该课程下所有评论信息
        $commentInfo=$commentModel->where('curr_id',$curr_id)->orderBy('create_time','desc')->get()->toArray();
    	//渲染模版
    	return view('curr/chapterlist',compact('commentInfo'));
    }

    /**
     * [开始学习]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function video(Request $request)
    {
        //渲染模版
        return view('curr/video');
    }
}
