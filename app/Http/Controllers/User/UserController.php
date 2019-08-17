<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Model\UserModel;
use App\Model\CurrModel;
use App\Model\CurrCollectModel;
use App\Model\MyCurrModel;

class UserController extends CommonController
{
    /**
     *用户个人中心页面
     */
    public function usercenter()
    {
        $user_id = session('user_id')??2;
        $user = UserModel::where(['user_id'=>$user_id])->first();
//        $data = CurrCollectModel::join()
       // dd($user);
        return view('user/usercenter',['user'=>$user]);
    }

    /**
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
    	$my_curr_model=new MyCurrModel();
    	//查询用户已收藏课程
    	$curr_id=$collect_model
    				->where('user_id',$user_id)
    				->where('status',1)
    				->pluck('curr_id');
    	//如果没有收藏课程返回提示
    	if(empty($curr_id)){
    		$this->json_fail('您还没有收藏课程,请先收藏');return;
    	}
    	$curr_id=$curr_id->toArray();
    	//查询收藏课程信息
    	$collectInfo=$curr_model
    				->where('is_show',1)
    				->where('curr_status',1)
    				->whereIn('curr_id',$curr_id)
    				->get()
    				->toArray();
    	//查询学过的课程信息
    	$my_curr_id=$my_curr_model
    				->where('user_id',$user_id)
    				->pluck('curr_id')
    				->toArray();
    	$currInfo=$curr_model
    				->where('is_show',1)
    				->where('curr_status',1)
    				->whereIn('curr_id',$my_curr_id)
    				->get()
    				->toArray();
    	echo view('user/collect',['collectInfo'=>$collectInfo,'currInfo'=>$currInfo]);
    }
}
