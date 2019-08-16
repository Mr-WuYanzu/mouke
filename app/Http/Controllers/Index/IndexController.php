<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CurrModel;
use App\Model\CurrCateModel;
/**
 * 前台模块类
 * class IndexController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Index
 * @date 2019-08-08
 */
class IndexController extends CommonController
{
    /**
     * [前台首页]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
    	//渲染视图
        $userInfo = $this->getUserInfo();
        //实例化模型类
        $currCateModel=new CurrCateModel();
        $currModel=new CurrModel();
        //获取顶级分类
        $cate=$currCateModel->where('pid',0)->limit(4)->select('curr_cate_id','cate_name')->get()->toArray();
        $curr_cate_id=[];
        foreach ($cate as $k => $v) {
            // $cate[$k]['num']=$k+1;
            $curr_cate_id[]=$v['curr_cate_id'];
            break;
        }
        $cate_son=$currCateModel->whereIn('pid',$curr_cate_id)->pluck('curr_cate_id')->toArray();
        // var_dump($cate_son);
        // var_dump($curr_cate_id);
        $curr_cate_id=array_merge($cate_son,$curr_cate_id);
        // var_dump($curr_cate_id);
        // var_dump($cate);
        //获取课程信息
        $currInfo=$currModel->where('is_show',1)->where('curr_status',1)->where('curr_good',2)->whereIn('curr_cate_id',$curr_cate_id)->get()->toArray();
        // var_dump($currInfo);
        // die;
        if(empty($userInfo)){
            return view('index/index',compact('cate','currInfo'));
        }else {
            return view('index/index', ['user_id' => $userInfo['user_id'], 'user_name' => $userInfo['user_name'],'cate'=>$cate,'currInfo'=>$currInfo]);
        }
    }

    public function getCurrInfo(Request $request)
    {
        //获取要替换的课程分类
        $data=$request->post('data');
        $cate_id=[intval($data['curr_cate_id'])];
        //实例化模型类
        $currCateModel=new CurrCateModel();
        $currModel=new CurrModel();
        //获取该分类下的子分类id
        $cate_son=$currCateModel->whereIn('pid',$cate_id)->pluck('curr_cate_id')->toArray();
        $curr_cate_id=array_merge($cate_id,$cate_son);
        //获取课程信息
        $currInfo=$currModel->where('is_show',1)->where('curr_status',1)->where('curr_good',2)->whereIn('curr_cate_id',$curr_cate_id)->get()->toArray();
        echo view('index/div',compact('currInfo','data'));
    }
}
