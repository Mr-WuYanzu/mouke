<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class TestController extends Controller
{
    #题库视图
    public function item_bank(Request $request){
        #判用户是否点击了 科目
        $c_id=$request->c_id;
        if(empty($c_id)){
            #查询所有科目
            $cate_name=DB::table('topic_cate')->get();
            return view('test.item_bank',compact('cate_name'));
        }else{
            $paperInfo=DB::table('paper')->where(['c_id'=>$c_id])->get();
            $paperInfo=json_decode($paperInfo,true);
            $c_name=DB::table('topic_cate')->where(['c_id'=>$c_id])->value('c_name');
            if($paperInfo){
                return view('test.item_bank_list',compact('c_name','paperInfo'));
            }else{
                echo "<script>alert('该科目下还没有试题');location.href='/item_bank';</script>";exit;
            }
        }

    }
}
