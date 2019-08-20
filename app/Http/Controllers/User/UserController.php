<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\UserModel;
use App\Model\CurrModel;
use App\Model\CurrCollectModel;
use App\Model\MyCurrModel;
use App\Model\SubscribeCurrModel;

class UserController extends CommonController
{
    /**
     *用户个人中心页面
     */
    public function usercenter()
    {
    	//接收用户id
    	$user_id=session('user_id')??2;
    	//查询用户信息
        $user = UserModel::where(['user_id'=>$user_id])->first();
    	//渲染视图
        return view('user/usercenter',['user'=>$user,'userInfo'=>$user]);
    }

    /**
     * [我的课程页面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCurr(Request $request)
    {
    	//接收用户id
        $user_id = session('user_id')??2;
        //实例化模型类
        $curr_model=new CurrModel();
    	$my_curr_model=new MyCurrModel();
    	//查询用户学过的课程
        $my_curr_id=$my_curr_model
    				->where('user_id',$user_id)
    				->pluck('curr_id');
    	//如果没有课程返回提示
    	if(empty($my_curr_id)){
    		$this->json_fail('您还没有添加课程,请先去添加');return;
    	}
    	$my_curr_id=$my_curr_id->toArray();
    	//查询学过的课程信息
    	$currInfo=$curr_model
    				->where('is_show',1)
    				->where('curr_status',1)
    				->whereIn('curr_id',$my_curr_id)
    				->get()
    				->toArray();
    	echo view('user/currinfo',['currInfo'=>$currInfo]);
    }

    /*
     * [我的收藏页面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function collect(Request $request)
    {
    	//接收用户id
    	$user_id=session('user_id')??2;
    	//实例化模型类
    	$collect_model=new CurrCollectModel();
    	$curr_model=new CurrModel();
    	//查询用户已收藏课程
    	$curr_id=$collect_model
    				->where('user_id',$user_id)
    				->where('status',1)
    				->pluck('curr_id');
    	//如果没有收藏课程返回提示
    	if(empty($curr_id)){
    		return ['code'=>2,'font'=>'您还没有收藏课程,请先收藏'];
    	}
    	$curr_id=$curr_id->toArray();
    	//查询收藏课程信息
    	$collectInfo=$curr_model
    				->where('is_show',1)
    				->where('curr_status',1)
    				->whereIn('curr_id',$curr_id)
    				->get()
    				->toArray();
    	echo view('user/collect',['collectInfo'=>$collectInfo]);
    }

    /**
     * [我的订阅页面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function subscribe(Request $request)
    {
    	//接收用户id
    	$user_id=session('user_id')??2;
    	//实例化模型类
    	$subscribe_model=new SubscribeCurrModel();
    	$curr_model=new CurrModel();
    	//查询用户已订阅课程
    	$curr_id=$subscribe_model
    			->where('user_id',$user_id)
    			->where('status',1)
    			->pluck('curr_id');
    	//如果没有订阅课程返回提示
    	if(empty($curr_id)){
    		return ['code'=>2,'font'=>'您还没有订阅课程,请先去订阅'];
    	}
    	$curr_id=$curr_id->toArray();
//    	dd($curr_id);
    	//查询订阅课程信息
    	$subscribeInfo=$curr_model
	    				->where(['is_show'=>1,'curr_status'=>1])
	    				->whereIn('curr_id',$curr_id)
	    				->get()
	    				->toArray();
    	echo view('user/subscribe',['subscribeInfo'=>$subscribeInfo]);
    }

    /**
     * [取消收藏]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cancelCollect(Request $request)
    {
    	//接收用户id
    	$user_id=session('user_id')??2;
    	//接收课程id
    	$curr_id=$request->post('curr_id');
    	//实例化模型类
    	$collect_model=new CurrCollectModel();
    	//更新订阅收藏信息
    	$res=$collect_model
    			->where('user_id',$user_id)
    			->where('curr_id',$curr_id)
    			->update(['status'=>2]);
    	//判断结果,返回提示
    	if($res){
    		$this->json_success('操作成功');
    	}else{
    		$this->json_fail('操作失败,请检查网络');
    	}
    }

    //我的订单
    public function myOrder(){

    }
}
