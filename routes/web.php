<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

//前台模块
Route::prefix('/')->group(function(){
	//前台首页
	Route::get('index','Index\IndexController@index');
	//获取分类下的课程信息
	Route::post('/getCurrInfo','Index\IndexController@getCurrInfo');
	//课程列表
	Route::get('curr/currlist','Curr\CurrController@currList');
	//课程收藏
	Route::post('curr/collectdo','Curr\CurrController@collectdo');
	#取消收藏
    Route::post('curr/collectdo_no','Curr\CurrController@collectdo_no');
    //课程分类搜索
    Route::post('cateSearch','Curr\CurrController@cateSearch');
    //课程分页数据查找
    Route::post('/getPageData','Curr\CurrController@getPageData');
	//课程详情
	Route::get('curr/currcont/{curr_id}','Curr\CurrController@currcont');
	//章节列表
	Route::get('curr/chapterlist/{curr_id}','Curr\CurrController@chapterlist');
	//开始学习
	Route::get('curr/video/{curr_id}','Curr\CurrController@video');
    //获取点击课时的视频
    Route::post('curr/getvideo','Curr\CurrController@getVideo');
	//资讯列表
	Route::get('article/articlelist','Article\ArticleController@articleList');
	//资讯详情
	Route::get('article/articlecont','Article\ArticleController@articlecont');
	//讲师列表
	Route::get('teacher/teacherlist','Teacher\TeacherController@teacherList');
	//讲师详情
	Route::get('teacher/teachercont','Teacher\TeacherController@teachercont');
	//注册页面
	Route::get('register','Login\LoginController@register');
	//注册邮箱唯一性验证
    Route::post('checkmail','Login\LoginController@checkmail');
    //邮箱验证码
    Route::post('email','Login\LoginController@email');
    //验证邮箱验证码是否正确
    Route::any('checkcode','Login\LoginController@checkcode');
    //用户名唯一性验证
    Route::post('checkname','Login\LoginController@checkname');
	//注册执行页面
	Route::post('registerdo','Login\LoginController@registerdo');
	//登录页面
	Route::get('login','Login\LoginController@login');

	//课程留言评论处理
	Route::post('curr/comment/addHandle','Curr\CurrCommentController@addHandle');
	#题库
    Route::get('/item_bank/{id?}','Test\TestController@item_bank');

	//登录页面
	Route::post('logindo','Login\LoginController@logindo');
	//微博登录
	Route::any('callback','Login\LoginController@callback');

});
//个人中心页面
Route::get('/center','user\UserController@usercenter');
//我的课程页面
Route::get('/user/getCurr','user\UserController@getCurr');
//我的收藏页面
Route::get('/user/collect','user\UserController@collect');
//个人中心取消收藏
Route::post('/user/cancelCollect','user\UserController@cancelCollect');
//我的订阅页面
Route::get('/user/subscribe','user\UserController@subscribe');
//用户找回密码功能
Route::get('/getpwd','pwd\RetrieveController@getpwd');
//用户找回密码执行
Route::post('/getpwdDo','pwd\RetrieveController@getpwdDO');
//用户找回密码验证通过，修改密码页面
Route::get('/updpwd','pwd\RetrieveController@updpwd');
//用户重置密码
Route::post('/setpwd','pwd\RetrieveController@setpwd');

//后台模块
Route::prefix('/admin')->group(function(){
	//后台首页
	Route::get('index','Admin\AdminController@index');
});

#订阅课程
Route::post('/course/subscribe','Curr\CurrController@subscribe');
#取消订阅
Route::post('/course/subscribe_no','Curr\CurrController@subscribe_no');