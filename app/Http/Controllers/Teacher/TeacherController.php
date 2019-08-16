<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherModel;
use App\Model\CurrModel;
use App\Model\CurrChapterModel;
use App\Model\CurrClassHourModel;
/**
 * 讲师模块类
 * class TeacherController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Teacher
 * @date 2019-08-08
 */
class TeacherController extends CommonController
{
	/**
	 * [讲师列表]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function teacherList(Request $request)
    {

        //实例化模型类
        $teacherModel=new TeacherModel();
        //查询所有通过审核的讲师信息
        $teacherInfo=$teacherModel->where('status',2)->orderBy('t_good','desc')->get()->toArray();

        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
        //渲染视图
    	return view('teacher/teacherlist',['userInfo'=>$userInfo,'teacherInfo'=>$teacherInfo]);

    }

    /**
     * [讲师详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function teachercont(Request $request)
    {
        //接收讲师id
        $t_id=$request->get('t_id');
        //实例化模型类
        $teacherModel=new TeacherModel();
        $currModel=new CurrModel();
        $chapterModel=new CurrChapterModel();
        $classHourModel=new CurrClassHourModel();
        //查询讲师信息
        $teacherInfo=$teacherModel->where('t_id',$t_id)->first()->toArray();
        //查询该讲师的所有上架的课程信息
        $currInfo=$currModel->with('chapter')->where('t_id',$t_id)->where('is_show',1)->orderBy('curr_hot','desc')->get()->toArray();
        //计算课程的课时
        foreach ($currInfo as $k => $v) {
            $currInfo[$k]['total_class_hour']=0;
            foreach ($v['chapter'] as $kk => $vv) {
                $count=$classHourModel->where('chapter_id',$vv['chapter_id'])->count();
                $currInfo[$k]['total_class_hour']+=$count;
            }
        }
        //用户信息
        $userInfo=$this->getUserInfo();
        if(isset($userInfo['pwd'])){
            unset($userInfo['pwd']);
        }
    	//渲染视图
    	return view('teacher/teachercont',compact('teacherInfo','currInfo','userInfo'));
    }
}
