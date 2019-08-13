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
	//课程详情
	Route::get('curr/currcont','Curr\CurrController@currcont');
	//章节列表
	Route::get('curr/chapterlist','Curr\CurrController@chapterlist');
	//开始学习
	Route::get('curr/video','Curr\CurrController@video');
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
	//注册执行页面
	Route::post('registerdo','Login\LoginController@registerdo');
	//登录页面
	Route::get('login','Login\LoginController@login');
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

