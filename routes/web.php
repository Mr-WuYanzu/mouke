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
	//课程列表
	Route::get('curr/currlist','Curr\CurrController@currList');
    //课程分类搜索
    Route::post('cateSearch','Curr\CurrController@cateSearch');
	//课程详情
	Route::get('curr/currcont/{curr_id}','Curr\CurrController@currcont');
	//章节列表
	Route::get('curr/chapterlist/{curr_id}','Curr\CurrController@chapterlist');
	//开始学习
	Route::get('curr/video','Curr\CurrController@video');
	//资讯列表
	Route::get('article/articlelist','Article\ArticleController@articleList');
	    // 点击资讯分类切换不同分类下的资讯
        Route::post('article/info_cate_name','Article\ArticleController@info_cate_name');
	//资讯详情
	Route::get('article/articlecont/{id}','Article\ArticleController@articlecont');
	//讲师列表
	Route::get('teacher/teacherlist','Teacher\TeacherController@teacherList');
	//讲师详情
	Route::get('teacher/teachercont','Teacher\TeacherController@teachercont');
	//注册页面
	Route::get('register','Login\LoginController@register');
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

});

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