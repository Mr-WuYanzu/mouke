<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Common\CommonController;
use App\Model\CurrModel;
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
        //接收分类id
        $info_cate_id=intval($request->get('info_cate_id'));
        //判断用户是否点击 分类模块[未点击 展示全部的资讯信息]
        if(empty($info_cate_id)){
            //查询所有资讯
            $Info=DB::table('infomation')->paginate(3);
            foreach($Info as $k=>$v){
                //查询出每个资讯对应的资讯分类名称
                $Info[$k]->info_name=DB::table('information_cate')->where(['info_cate_id'=>$v->info_cate_id])->value('info_name');
            }
//            $Info=json_decode(json_encode($Info),true);
        }else{
            //[当用户点击分类按钮 展示对应的分类下的资讯信息]
            //根据资讯分类id 查询该分类下的资讯信息
            $Info=DB::table('infomation')->where(['info_cate_id'=>$info_cate_id])->paginate(3);
            foreach($Info as $k=>$v){
                $Info[$k]->info_name=DB::table('information_cate')->where(['info_cate_id'=>$v->info_cate_id])->value('info_name');
            }
        }
        //查询 资讯分类
        $cate_Info=DB::table('information_cate')->get();
        //热门资讯
        $hot=DB::table('infomation')->where(['info_hot'=>2])->get();
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
        //获取 数据中的条数
        $num = $Info->count();

        //查询推荐课程
        $currInfo = $this->_getRecommend();
        //获取 数据中的条数
        $num = $Info->count();
    	//渲染视图
    	return view('article/articlelist',
            [
                'cate_Info'=>$cate_Info,
                'Info'=>$Info,
                'hot'=>$hot,
                'userInfo'=>$userInfo,
                'currInfo'=>$currInfo,
                'info_cate_id'=>['info_cate_id'=>$info_cate_id],
                'num'=>$num,
                'Info_cate_id'=>['info_cate_id'=>$info_cate_id],
            ]
        );
    }


    /**
     * [资讯详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function articlecont(Request $request)
    {
        //接受 用户列表页传过来的 资讯的id
        $info_id=intval($request->get('info_id'));
        //判断资讯id是否 为空
        if(!empty($info_id)){
            //根据资讯的id 展示该资讯的详细数据
            $Info=DB::table('infomation')->where(['info_id'=>$info_id])->first();
            $Info=json_decode(json_encode($Info),true);
            //根据资讯分类的id 查询资讯分类的名称
            $Info_cate=DB::table('information_cate')->where(['info_cate_id'=>$Info['info_cate_id']])->first();
            //根据 资讯ID给该资讯 的点击量加一
            $info_hot=$Info['info_hot']+1;
            $update=DB::table('infomation')->where(['info_id'=>$info_id])->update(['info_hot'=>$info_hot]);
            //热门资讯 [根据用户的点击量展示]
            $hot=DB::table('infomation')->orderBy('info_hot','desc')->limit(2)->get();
            //用户信息
            $userInfo=$this->getUserInfo();
            if(isset($userInfo['pwd'])){
                unset($userInfo['pwd']);
            }
            //根据当前的 分类id 查询该分类下面的资讯
            $arr_info_id=DB::table('infomation')
                ->where('info_cate_id',$Info['info_cate_id'])
                ->select('info_id')
                ->get();
            $info_id=[];
            //将查出来分类下的资讯 转换成一维数组
            foreach ($arr_info_id as $k=>$v){
                $info_id[]=$v->info_id;
            }
            //将当前的分类id 赋到数组里面
            $info_id[]=$Info['info_cate_id'];
            if($arr_info_id){
                //上一篇
                //查询 小于当前id 并且最大的id
                    $top_id = DB::table('infomation')
                        ->where('info_id','<',$Info['info_id'])
                        ->whereIn('info_cate_id',$info_id)
                        ->orderBy('info_id','desc')
                        ->value('info_id');
                    if(empty($top_id)){
                        $top_id = '';
                    }
                //下一篇
                //查询 大于当前id 并且最小的id
                $lower_id = DB::table('infomation')
                    ->where('info_id', '>', $Info['info_id'])
                    ->whereIn('info_cate_id',$info_id)
                    ->orderBy('info_id','asc')
                    ->value('info_id');
                if(empty($lower_id)){
                    $lower_id = '';
                }
            }
            //查询推荐课程
            $currInfo = $this->_getRecommend();
            //渲染视图
            return view('article/articlecont',
                [
//                    'info_name'=>$info_name,
                    'Info_cate'=>$Info_cate,
                    'Info'=>$Info,
                    'hot'=>$hot,
                    'userInfo'=>$userInfo,
                    'top_id'=>$top_id,
                    'lower_id'=>$lower_id,
                    'currInfo'=>$currInfo,
                    'info_cate_id'=>$Info['info_cate_id']
                ]
            );
        }else{
            echo "<script>alert('请勿非法操作');location.href='/article/articlelist';</script>";
        }
    }

    //获取推荐课程
    private function _getRecommend(){
        //根据课程学习人数排序进行推荐
        $currInfo = CurrModel::orderBy('study_num','desc')->limit(2)->get();
        return $currInfo;
    }





}
