<?php

namespace App\Http\Controllers\Curr;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\CurrCommentModel;
use App\Model\UserModel;
use App\Model\CurrModel;
use Illuminate\Support\Facades\Redis;
use DB;
/**
 * 课程留言模块类
 * class CurrCommentController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Curr
 * @date 2019-08-10
 */
class CurrCommentController extends CommonController
{
	/**
	 * [课程留言评论处理]
	 * @param Request $request [description]
	 */
    public function addHandle(Request $request)
    {
    	//接收留言信息
    	$data=$request->post('data');
    	//接收评价分数
    	$curr_grade=$request->post('curr_grade');
    	//获取用户id
    	$user_id=session('user_id');
    	$user_id=5;
    	$data['user_id']=$user_id;
    	//课程id
    	$data['curr_id']=1;
    	//实例化模型类
    	$userModel=new UserModel();
    	$commentModel=new CurrCommentModel();
    	$currModel=new CurrModel();
    	//获取用户名
    	$data['user_name']=$userModel->where('user_id',$user_id)->value('user_name');
    	//获取当前课程原分数
    	$old_curr_grade=$currModel->where('curr_id',$data['curr_id'])->value('curr_grade');
    	//设置评论时间
    	$data['create_time']=time();
    	//开启事务
    	DB::beginTransaction();
    	//写入评论相关数据
    	try{
    		//写入评论表
    		$commentModel->insert($data);
    		//修改课程分数
    		$currModel->where('curr_id',$data['curr_id'])->update(['curr_grade'=>$old_curr_grade+$curr_grade]);
    		//提交事务
    		DB::commit();
    		//返回响应
    		echo $this->json_success('评论成功');
    	}catch(\Exception $e){
    		//回滚事务
    		DB::rollBack();
    		//返回响应
    		echo $this->json_fail('评论失败,请重试');
    	}
    }
}
