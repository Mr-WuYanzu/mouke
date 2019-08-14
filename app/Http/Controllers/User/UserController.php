<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\Model\CurrModel;
use App\Model\CurrCollectModel;

class UserController extends Controller
{
    /**
     *用户个人中心页面
     */
    public function usercenter()
    {
        $user_id = session('user_id');
        $user = UserModel::where(['user_id'=>$user_id])->first();
//        $data = CurrCollectModel::join()
//        dd($user);
        return view('user/usercenter',['user'=>$user]);
    }
}
