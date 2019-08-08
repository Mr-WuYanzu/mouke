@extends('layouts.layouts')

@section('title','课程列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="courseleft">
	<span class="select">     	
      <input type="text" value="请输入关键字" class="pingjia_con"/>
      <a href="#" class="sellink"></a>        
    </span>
    <ul class="courseul">
    <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="#" class="whitea">全部课程</a></h3>
    <li>
    <h4>财会金融</h4>
        <ul class="sortul">
        <li class="course_curr"><a href="#">会计从业证</a></li>
        <li><a href="#">初级会计职称</a></li>
        <li><a href="#">中级会计职称</a></li>
        <li><a href="#">会计高级职称</a></li>
        <li><a href="#">注册会计师</a></li>
        <li><a href="#">经济师</a></li>
        </ul>
    <div class="clearh"></div>
    </li>
    <li>
    <h4>计算机</h4>
        <ul class="sortul">
        <li><a href="#">C语言</a></li>
        <li><a href="#">JAVA</a></li>
        <li><a href="#">.NET</a></li>
        <li><a href="#">PHP</a></li>
        
        </ul>
    <div class="clearh"></div>
    </li>
    </ul>
    <div style="height:20px;border-radius:0 0 5px 5px; background:#fff;box-shadow:0 2px 4px rgba(0, 0, 0, 0.1)"></div>
    </div>
    <div class="courseright">
        <div class="clearh"></div>
      <ul class="courseulr">
        <li>
        	<div class="courselist">
            <a href="/curr/currcont" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="images/c1.jpg" title="会计基础"></a>
            <p class="courTit"><a href="coursecont.html" target="_blank">会计基础</a></p>
            <div class="gray">
            <span>30课时 600分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
        <li>
        	<div class="courselist">
            <a href="coursecont.html" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="images/c2.jpg" title="会计基础"></a>
            <p class="courTit"><a href="coursecont.html" target="_blank">HTTP下载课程</a></p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
        </li>
        <li>
        	<div class="courselist">
            <a href="coursecont.html" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="images/c3.jpg" title="会计基础"></a>
            <p class="courTit"><a href="coursecont.html" target="_blank">HTTP下载课程</a></p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c4.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c5.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c6.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c7.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c8.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
       <li>
        	<div class="courselist">
            <img style="border-radius:3px 3px 0 0;" width="240" src="images/c9.jpg" >
            <p class="courTit">HTTP下载课程</p>
            <div class="gray">
            <span>5课时 60分钟</span>
            <span class="sp1">1255555人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
    </ul>
    </div>
    <div class="clearh"></div>
</div>
</div>
<!-- InstanceEndEditable -->

<div class="clearh"></div>
@endsection