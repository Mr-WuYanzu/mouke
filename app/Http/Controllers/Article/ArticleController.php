<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 资讯模块类
 * class ArticleController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Article
 * @date 2019-08-08
 */
class ArticleController extends Controller
{
	/**
	 * [资讯列表]
	 * @return [type] [description]
	 */
    public function articleList(Request $request)
    {
    	//渲染视图
    	return view('article/articlelist');
    }

    /**
     * [资讯详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function articlecont(Request $request)
    {
    	//渲染视图
    	return view('article/articlecont');
    }
}
