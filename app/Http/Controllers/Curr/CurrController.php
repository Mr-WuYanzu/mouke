<?php

namespace App\Http\Controllers\Curr;

use App\curr\CurrCate;
use App\Model\CurrChapterModel;
use App\Model\CurrClassHourModel;
use App\Model\CurrModel;
use App\Model\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\CurrCommentModel;
use Illuminate\Support\Facades\Redis;
use DB;
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
    	//查询课程
        $currInfo = CurrModel::get();
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo[$k]['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$v['curr_id']])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo[$k]['classNum']+=$val['class_num'];
            }
        }
        //查询分类
        $curr_cate = CurrCate::get();
        $curr_cate_info=$this->curr_cate($curr_cate);
//        dd($curr_cate_info);
    	return view('curr/currlist',['currInfo'=>$currInfo,'curr_cate_info'=>$curr_cate_info]);
    }

    //课程分类搜索
    public function cateSearch(Request $request){
        $cate_id = intval($request->post('cate_id'));
        //获取此分类的所包含分类id
        $cateId = $this->getCateId($cate_id);
        $cateId[]=$cate_id;
        $search = $request->post('search');
        //根据条件搜索课程
        if(!empty($search)){
            $currInfo = CurrModel::where('curr_name','like',"%$search%")->whereIn('curr_cate_id',$cateId)->get();
        }else{
            $currInfo = CurrModel::whereIn('curr_cate_id',$cateId)->get();
        }
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo[$k]['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$v['curr_id']])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo[$k]['classNum']+=$val['class_num'];
            }
        }
        return $currInfo;

    }

    //获取分类子id
    public function getCateId($pid){
        static $cate_id = [];
        $cateInfo = CurrCate::where(['pid'=>$pid])->get();
        foreach ($cateInfo as $k=>$v){
            $cate_id[]=$v['curr_cate_id'];
            $this->getCateId($v['curr_cate_id']);
        }
        return $cate_id;
    }

    //处理课程分类
    public function curr_cate($curr_cate,$pid=0){
        $curr_cate_info=[];
        foreach ($curr_cate as $k=>$v){
            if($v['pid']==$pid){
                $curr_cate_info[$k]=$v;
                $curr_cate_info[$k]['son']=$this->curr_cate($curr_cate,$v['curr_cate_id']);
            }
        }
        return $curr_cate_info;
    }

    /**
     * [课程内容]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function currcont(Request $request,$curr_id)
    {
        $curr_id = intval($curr_id);
        //根据课程id查询课程详情
        $currInfo = CurrModel::where(['curr_id'=>$curr_id])->first();
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$curr_id])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo['classNum']+=$val['class_num'];
            }
        }
        //查询讲师
        $teacherInfo = TeacherModel::where(['t_id'=>$currInfo['t_id']])->first();
        //查询课程章节
        $chapter = CurrChapterModel::where(['curr_id'=>$currInfo['curr_id']])->get();
    	//渲染模版
    	return view('curr/currcont',['currInfo'=>$currInfo,'teacherInfo'=>$teacherInfo,'chapter'=>$chapter]);
    }

    /**
     * [章节列表]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function chapterlist(Request $request,$curr_id)
    {
        //课程id
        $curr_id=intval($curr_id);
        //根据课程id查询课程详情
        $currInfo = CurrModel::where(['curr_id'=>$curr_id])->first();
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$curr_id])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo['classNum']+=$val['class_num'];
            }
        }
        //查询讲师
        $teacherInfo = TeacherModel::where(['t_id'=>$currInfo['t_id']])->first();
        //查询课程章节
        $chapter = CurrChapterModel::where(['curr_id'=>$currInfo['curr_id']])->get();
        $chapterInfo=$this->getClassHour($chapter);
        //实例化模型类
        $commentModel=new CurrCommentModel();
        //查询该课程下所有评论信息
        $commentInfo=$commentModel->where('curr_id',$curr_id)->orderBy('create_time','desc')->get();
    	//渲染模版
    	return view('curr/chapterlist',['commentInfo'=>$commentInfo,'currInfo'=>$currInfo,'teacherInfo'=>$teacherInfo,'chapterInfo'=>$chapterInfo]);
    }


    //查询章节下的课时
    public function getClassHour($chapterInfo){
        $chapter=[];
        foreach ($chapterInfo as $k=>$v){
            $chapter[$k] = $v;
            $chapter[$k]['son']=CurrClassHourModel::where(['chapter_id'=>$v['chapter_id']])->get();
        }
        return $chapter;
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

    /**
     * [订阅课程]
     * @param Request $request
     */
    public function subscribe(Request $request){
        #接受课程id
        $curr_id=$request->curr_id;
        #接受用户id
        $user_id=session('user_id');
        #根据课程id 查询课程表中的 价格
        $curr_price=DB::table('curr')->where(['curr_id'=>$curr_id])->value('curr_price');
        #拼装 存入订单表的数据
        $arr=[
            'user_id'=>$user_id,
            'order_no'=>$this->order_no($user_id),
            'curr_id'=>$curr_id,
            'amount'=>$curr_price
        ];
        #先查询用户是否已经订阅
        $select=DB::table('curr_order')->where(['user_id'=>$user_id,'curr_id'=>$curr_id])->first();
        if($select){
            return ['code'=>1,'msg'=>'您已经订阅---》请勿重复订阅'];
        }else{
            $insert=DB::table('curr_order')->insert($arr);
            if($insert){
                return ['code'=>100,'msg'=>'订阅成功'];
            }else{
                return ['code'=>1,'msg'=>'订阅失败请重试'];
            }
        }
    }

    /**
     * [订单单号]
     * @param $user_id
     */
    public function order_no($user_id){
        $rand=mt_rand(111111,999999).time().$user_id;
        return $rand;
    }

}
