<?php

namespace App\Http\Controllers\Curr;

use App\curr\CurrCate;
use App\Model\CurrChapterModel;
use App\Model\CurrClassHourModel;
use App\Model\CurrModel;
use App\Model\TeacherModel;
use App\MyCurrModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\CurrCommentModel;
use App\Model\CurrCollectModel;
use Illuminate\Support\Facades\Redis;
use mysql_xdevapi\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;

/**
 * 课程模块类
 * class CurrController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Curr
 * @date 2019-08-08
 */
class CurrController extends CommonController
{
    //课程分页每页显示条数
    protected $page_size=2;
	/**
	 * [课程列表]
	 * @return [type] [description]
	 */
    public function currList(Request $request)
    {
    	//查询课程
        $currInfo = CurrModel::where(['curr_status'=>1,'is_show'=>1])->paginate($this->page_size);
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
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
//        dd($curr_cate_info);
        #最后一页的页码
        $lastPage = $currInfo->lastPage();
        #当前页码
        $currentPage = $currInfo->currentPage();
    	return view('curr/currlist',[
    	    'currInfo'=>$currInfo,
            'curr_cate_info'=>$curr_cate_info,
            'userInfo'=>$userInfo,
            'lastPage'=>$lastPage,
            'currentPage'=>$currentPage
        ]);
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
            $currInfo = CurrModel::where([['curr_name','like',"$search%"],'is_show'=>1,'curr_status'=>1])->whereIn('curr_cate_id',$cateId)->paginate($this->page_size);
        }else{
            $currInfo = CurrModel::where(['is_show'=>1,'curr_status'=>1])->whereIn('curr_cate_id',$cateId)->paginate($this->page_size);
        }
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo[$k]['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$v['curr_id']])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo[$k]['classNum']+=$val['class_num'];
            }
        }
        #最后一页的页码
        $lastPage = $currInfo->lastPage();
        #当前页码
        $currentPage = $currInfo->currentPage();

        return ['currInfo'=>$currInfo,'lastPage'=>$lastPage,'currentPage'=>$currentPage];

    }

    //课程分页数据查找
    public function getPageData(Request $request){
        $cate_id = intval($request->post('cate_id'));

        if($cate_id!=0){
            //获取此分类的所包含分类id
            $cateId = $this->getCateId($cate_id);
            $cateId[]=$cate_id;
        }
        //搜索关键字
        $search = $request->post('search');
        //根据条件搜索课程
        if(!empty($search) && $cate_id !== 0){#根据分类id和搜索关键字搜索
            $currInfo = CurrModel::where([['curr_name','like',"$search%"],'is_show'=>1,'curr_status'=>1])->whereIn('curr_cate_id',$cateId)->paginate($this->page_size);
        }else if(!empty($search)){#根据搜索关键字查找
            $currInfo = CurrModel::where([['curr_name','like',"$search%"],'is_show'=>1,'curr_status'=>1])->paginate($this->page_size);
        }else if($cate_id!=0){#根据分类进行查找
            $currInfo = CurrModel::where(['is_show'=>1,'curr_status'=>1])->whereIn('curr_cate_id',$cateId)->paginate($this->page_size);
        }else{#查找所有
            $currInfo = CurrModel::where(['curr_status'=>1,'is_show'=>1])->paginate($this->page_size);
        }
        //获取课时个数
        foreach ($currInfo as $k=>$v){
            $currInfo[$k]['classNum']=0;
            $chapterInfo = CurrChapterModel::where(['curr_id'=>$v['curr_id']])->get();
            foreach ($chapterInfo as $key=>$val){
                $currInfo[$k]['classNum']+=$val['class_num'];
            }
        }
        #最后一页的页码
        $lastPage = $currInfo->lastPage();
        #当前页码
        $currentPage = $currInfo->currentPage();

        return ['currInfo'=>$currInfo,'lastPage'=>$lastPage,'currentPage'=>$currentPage];
//return $currInfo;
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
        $chapter=[];
        if($currInfo['curr_type']==2){
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
        }else{
            //查询讲师
            $teacherInfo = TeacherModel::where(['t_id'=>$currInfo['t_id']])->first();
        }

        #处理收藏样式
        #获取用户ID
        $user_id=session('user_id');
//        $user_id=8;
        if($user_id){
            #查询收藏表中的状态
            $collect_status=DB::table('curr_collect')->where(['user_id'=>$user_id,'curr_id'=>$curr_id,'status'=>1])->value('status');
            #查询订阅表的状态
            $sub_status=DB::table('subscribe_curr')->where(['user_id'=>$user_id,'curr_id'=>$curr_id,'status'=>1])->value('status');
        }else{
            $sub_status='';
            $collect_status='';
        }
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
        //渲染模版
        return view('curr/currcont',
                ['currInfo'=>$currInfo,
                    'teacherInfo'=>$teacherInfo,
                    'chapter'=>$chapter,
                    'collect_status'=>$collect_status,
                    'sub_status'=>$sub_status,
                    'userInfo'=>$userInfo
                ]
            );

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
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
    	//渲染模版
    	return view('curr/chapterlist',
            [
                'commentInfo'=>$commentInfo,
                'currInfo'=>$currInfo,
                'teacherInfo'=>$teacherInfo,
                'chapterInfo'=>$chapterInfo,
                'relevant_curr'=>$Relevant_curr,
                'userInfo'=>$userInfo
            ]
        );
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
        $userInfo = $this->getUserInfo();
        if(empty($userInfo)){
            return redirect('/login/login');
        }
        $user_id = $userInfo['user_id'];
        $curr_id = intval($curr_id);
        //根据课程id查询课程详情
        $currInfo = CurrModel::where(['curr_id'=>$curr_id])->first();
        //查询课程章节
        $chapter = CurrChapterModel::where(['curr_id'=>$currInfo['curr_id']])->get();
        $chapterInfo=$this->getClassHour($chapter);
        //加入我的课程表
        $data=[
            'curr_id'=>$curr_id,
            'user_id'=>$user_id,
        ];
        #先查找此用户有没有学过此课程
        $my_currInfo = MyCurrModel::where($data)->first();
        if(empty($my_currInfo)){
            $data['ctime']=time();
            $my_curr_result = MyCurrModel::insert($data);
            $study_num = CurrModel::where('curr_id',$curr_id)->value('study_num');
            $curr_result = CurrModel::where('curr_id',$curr_id)->update(['study_num'=>$study_num['study_num']+1]);
        }
//        dd($chapterInfo);
        //渲染模版
        return view('curr/video',['chapterInfo'=>$chapterInfo,'curr_id'=>$curr_id]);
    }

    //获取点击课时的视频
    public function getVideo(Request $request){
        $class_id = $request->post('class_id');
        //根据课时id查询课时
        $classInfo = CurrClassHourModel::where(['class_id'=>$class_id])->first();
        if($classInfo){
                //判断视频类型
                $video_type='';
                if($classInfo['video_status']==1){
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
                }
            return ['status'=>201,'msg'=>'video faild'];


        }else{
            return ['status'=>107,'msg'=>'课时不存在'];
        }
    }

    /**
     * [订阅课程]
     * @param Request $request
     */
    public function subscribe(Request $request){
        #接受课程id
        $curr_id=$request->post('curr_id');
        if(empty($curr_id)){
            return ['code'=>5,'msg'=>'请勿非法操作'];
        }
        #接受用户id
        $user_id=session('user_id');
        if(empty($user_id)){
            return ['code'=>2,'msg'=>'请先登录'];
        }else{
            #先查询用户是否已经订阅
            $select=DB::table('subscribe_curr')->where(['user_id'=>$user_id,'curr_id'=>$curr_id])->first();
            if(empty($select)){
                #为空证明 第一次订阅 做第一次添加【将用户 和 课程信息 存入订阅表中】
                $insert=DB::table('subscribe_curr')->insert(
                    [
                        'user_id'=>$user_id,
                        'curr_id'=>$curr_id,
                        'create_time'=>time()
                    ]
                );
                if($insert){
                    return ['code'=>1,'msg'=>'订阅成功'];
                }else{
                    return ['code'=>5,'msg'=>'订阅失败'];
                }
            }else{
                #不为空 证明不是第一次订阅 修改状态
                $update=DB::table('subscribe_curr')->where(['user_id'=>$user_id,'curr_id'=>$curr_id])->update(
                    [
                        'status'=>1,
                        'update_time'=>time()
                    ]
                );
                if($update){
                    return ['code'=>1,'msg'=>'订阅成功'];
                }else{
                    return ['code'=>5,'msg'=>'订阅失败'];
                }
            }
        }
    }
    #取消订阅
    public function subscribe_no(Request $request){
        #接受课程id
        $curr_id=$request->post('curr_id');
        if(empty($curr_id)){
            return ['code'=>5,'msg'=>'请勿非法操作'];
        }
        #接受用户id
        $user_id=session('user_id');
        if(empty($user_id)){
            return ['code'=>2,'msg'=>'请先登录'];
        }else{
            #先查询用户是否已经订阅
            $select=DB::table('subscribe_curr')->where(['user_id'=>$user_id,'curr_id'=>$curr_id])->first();
            if(!empty($select)){
                #不为空证明 以订阅【修改订阅表中的 状态】
                $update=DB::table('subscribe_curr')->where(['user_id'=>$user_id,'curr_id'=>$curr_id])->update(
                    [
                        'status'=>2,
                        'update_time'=>time()
                    ]
                );
                if($update){
                    return ['code'=>1,'msg'=>'取消订阅成功'];
                }else{
                    return ['code'=>5,'msg'=>'取消订阅失败'];
                }
            }else{
                return ['code'=>5,'msg'=>'该课程未订阅请先订阅'];
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

    /**
     * [收藏课程]
     * @param Request $request
     * @return array
     */
    public function collectdo(Request $request)
    {
        #接受 课程id
        $curr_id = $request->post('curr_id');
        #获取用户id
        $user_id = session('user_id');
//        $user_id=8;
        if(empty($user_id)){
            return ['code' => 2, 'msg' => '请先登录'];
        }else{
            #先查询收藏表中 是否已经收藏该课程
            $Info=CurrCollectModel::where(['user_id'=>$user_id,'curr_id'=>$curr_id,'status'=>2])->first();
            if(empty($Info)){
                #为空 走第一次添加
                #组装数据
                $data = [
                    'curr_id' => $curr_id,
                    'user_id' => $user_id,
                    'create_time' =>time()
                ];
                #将数组 存入收藏表中
                $res = CurrCollectModel::insert($data);
                if ($res) {
                    return ['code' => 1, 'msg' => '收藏成功'];
                } else {
                    return ['code' => 5, 'msg' => '收藏失败---》请重试'];
                }
            }else{
                #不为空 证明是 已收藏状态
                $res=CurrCollectModel::where(['user_id'=>$user_id,'curr_id'=>$curr_id])->update(['status'=>1,'update_time'=>time()]);
                if ($res) {
                    return ['code' => 1, 'msg' => '收藏成功'];
                } else {
                    return ['code' => 5, 'msg' => '收藏失败---》请重试'];
                }
            }
        }
    }
    #取消收藏课程
    public function collectdo_no(Request $request){
        #接受 课程id
        $curr_id = $request->curr_id;
        #获取用户id
        $user_id = session('user_id');
//        $user_id=8;
        if(empty($user_id)){
            return ['code' => 2, 'msg' => '请先登录'];
        }else {
            #根据用户ID 和 课程id 修改收藏表的状态
            $update = CurrCollectModel::where([
                 'user_id'=>$user_id,
                 'curr_id' =>$curr_id
            ])->update(['status'=>2,'update_time'=>time()]);
            if($update){
                return ['code' => 1, 'msg' => '取消收藏成功'];
            }else{
                return ['code' => 5, 'msg' => '取消收藏失败--》请重试'];
            }
        }


    }

}
