<?php

namespace App\Http\Controllers\Curr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class QuestionController extends Controller
{
    #课程问答添加
    public function questionadd(Request $request){
        $data=$request->post();
        //获取用户ID
        $user_id=session('user_id');
//        $user_id=5;
        if(empty($user_id)){
            return ['code'=>2,'msg'=>'请先登录'];
        }
        $data['user_id']=$user_id;
        $data['create_time']=time();
        $quest_id=DB::table('question')->insertGetId($data);
        if($quest_id){
            //根据用户ID 查询用户的名称
            $username=DB::table('user')->where(['user_id'=>$user_id])->value('user_name');
            $arr=[
                'username'=>$username,
                'quest_title'=>$data['quest_title'],
                'create_time'=>DB::table('question')->where('quest_id',$quest_id)->value('create_time')
            ];
            return ['code'=>1,'msg'=>'添加问答成功','data'=>$arr];
        }else{
            return ['code'=>5,'msg'=>'添加问答失败'];
        }
    }
}
