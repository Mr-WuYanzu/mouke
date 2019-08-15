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
use App\Model\CurrCollectModel;
use Illuminate\Support\Facades\Redis;
use mysql_xdevapi\Collection;
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
        //用户信息
        $userInfo=$this->getUserInfo();
//        dd($curr_cate_info);
    	return view('curr/currlist',['currInfo'=>$currInfo,'curr_cate_info'=>$curr_cate_info,'user_id'=>$userInfo['user_id']??'','user_name'=>$userInfo['user_name']??'']);
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
        //查询相关课程
        $Relevant_curr = $this->relevant_curr($currInfo);
//        dd($Relevant_curr);
        //实例化模型类
        $commentModel=new CurrCommentModel();
        //查询该课程下所有评论信息
        $commentInfo=$commentModel->where('curr_id',$curr_id)->orderBy('create_time','desc')->get();
    	//渲染模版
    	return view('curr/chapterlist',['commentInfo'=>$commentInfo,'currInfo'=>$currInfo,'teacherInfo'=>$teacherInfo,'chapterInfo'=>$chapterInfo,'relevant_curr'=>$Relevant_curr]);
    }

    //查找相关课程
    public function relevant_curr($currInfo){
        $curr_cate_id = $currInfo['curr_cate_id'];//获取分类id
        //查找此分类的相关id
        $pid = CurrCate::where(['curr_cate_id'=>$curr_cate_id])->value('pid');
        $curr_info=[];
        if($pid!==null){
//            获取此分类的所有子类id
            $cate_id=$this->getCateId(3);
            //查询相关课程
            $curr_info = CurrModel::where('curr_id','!=',$currInfo['curr_id'])->whereIn('curr_cate_id',$cate_id)->limit(4)->get();
        }
        return $curr_info;
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
    public function video(Request $request,$curr_id)
    {
        $curr_id = intval($curr_id);
        //根据课程id查询课程详情
        $currInfo = CurrModel::where(['curr_id'=>$curr_id])->first();
        //查询课程章节
        $chapter = CurrChapterModel::where(['curr_id'=>$currInfo['curr_id']])->get();
        $chapterInfo=$this->getClassHour($chapter);
//        dd($chapterInfo);
        //渲染模版
        return view('curr/video',['chapterInfo'=>$chapterInfo,'curr_id'=>$curr_id]);
    }

    //获取点击课时的视频
    public function getVideo(Request $request){
        $teacher_id = 2;

        $class_id = $request->post('class_id');
        //根据课时id查询课时
        $classInfo = CurrClassHourModel::where(['class_id'=>$class_id])->first();
        if($classInfo){
                //判断视频类型
                $video_type='';
                if(!empty($classInfo['class_data'])){
                    $a = substr($classInfo['class_data'],-9);
                    $b = explode('.',$a);
                    switch ($b[1]??''){
                        case 'mp4':
                            $video_type=$b[1];
                            break;
                        case 'webm':
                            $video_type=$b[1];
                            break;
                        case 'ogv':
                            $video_type=$b[1];
                            break;
                    }
                }
                return ['status'=>200,'msg'=>'ok','video_url'=>$classInfo['class_data'],'video_type'=>$video_type];
        }else{
            return ['status'=>107,'msg'=>'课时不存在'];
        }
    }

    public function collectdo(Request $request)
    {
        $curr_id = $request->curr_id;
        $user_id = session('user_id');
        $time = time();
        $data = [
            'curr_id' => $curr_id,
            'user_id' => $user_id,
            'status' => 1,
            'create_time' => $time
        ];
        $res = CurrCollectModel::insert($data);
//        echo $res;die;
        if ($res == 1) {
            return ['code' => 200, 'msg' => '收藏成功'];
        } else {
            return ['code' => 400, 'msg' => '收藏失败'];
        }
//        echo $user_id;die;
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
        if(empty($user_id)){
            return ['code'=>2,'msg'=>'请先登录'];
        }else{
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
