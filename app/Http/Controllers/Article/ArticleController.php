<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
/**
 * 资讯模块类
 * class ArticleController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Article
 * @date 2019-08-08
 */
class ArticleController extends CommonController
{
	/**
	 * [资讯列表]
	 * @return [type] [description]
	 */
    public function articleList(Request $request)
    {
        //查询 资讯分类
        $cate_Info=DB::table('information_cate')->get();
        //查询所有资讯
        $Info=DB::table('infomation')->get();
        foreach($Info as $k=>$v){
            //查询出每个资讯对应的资讯分类名称
            $Info[$k]->info_name=DB::table('information_cate')->where(['info_cate_id'=>$v->info_cate_id])->value('info_name');
        }
        //热门资讯
        $hot=DB::table('infomation')->where(['info_hot'=>2])->get();
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
    	//渲染视图
    	return view('article/articlelist',['cate_Info'=>$cate_Info,'Info'=>$Info,'hot'=>$hot,'userInfo'=>$userInfo]);
    }

    /**
     * [资讯详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function articlecont(Request $request,$id)
    {
        //根据资讯的id 展示该资讯的详细数据
        $Info=DB::table('infomation')->where(['info_id'=>$id])->first();
        //根据资讯分类的id 查询资讯分类的名称
        $info_name=DB::table('information_cate')->where(['info_cate_id'=>$Info->info_cate_id])->value('info_name');
        //热门资讯
        $hot=DB::table('infomation')->where(['info_hot'=>2])->get();
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
    	//渲染视图
    	return view('article/articlecont',['info_name'=>$info_name,'Info'=>$Info,'hot'=>$hot,'userInfo'=>$userInfo]);
    }

    /*
     * [点击资讯分类切换不同分类下的资讯]
     * */
    public function info_cate_name(Request $request){
        //接受资讯分类的id
        $info_cate_id=$request->info_cate_id;
        //根据资讯分类id 查询该分类下的资讯信息
        $Info_name=DB::table('infomation')->where(['info_cate_id'=>$info_cate_id])->get();
        foreach($Info_name as $k=>$v){
            $Info_name[$k]->info_name=DB::table('information_cate')->where(['info_cate_id'=>$v->info_cate_id])->value('info_name');
        }
        return view('article.info_cate_name',compact('Info_name'));
    }






}
