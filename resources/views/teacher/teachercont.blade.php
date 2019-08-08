@extends('layouts.layouts')

@section('title','讲师详情')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic tecti">
	<div class="teaimg">
    <img src="images/teacher.jpg" width="150"> 
    </div>
    <div class="teachtext">
    	<h3>马嫱&nbsp;&nbsp;<strong>会计基础、会计电算化讲师</strong></h3>
        <h4>个人简介</h4>
        <p>资深财会考试与实务操作讲师；拥有五年财税实务及实操经验。 曾在大型连锁超市担任总会计三年，集团公司两年的会计工作经历。</p>
        <h4>授课风格</h4>
        <p>马老师讲授的课程紧扣大纲，重点突出；举例风趣幽默，讲解通俗易懂;传授的学习方法简洁有效；同时，注意与学员进行各种交流，及时解答学员疑惑，反馈学员建议，深受好评。</p>
    </div>
    <div class="clearh"></div>
</div>

<div class="clearh"></div>

<div class="tcourselist">
<h3 class="righttit" style="padding-left:50px;">在教课程</h3>
<ul class="tcourseul">
	<li>
	    <span class="courseimg tcourseimg"><a href="coursecont.html" target="_blank"><img width="230" src="images/c8.jpg"></a></span>
	    <span class="tcoursetext">
	       <h4><a href="/curr/currcont" target="_blank" class="teatt">会计从业资格会计基础</a><a class="state">更新中</a></h4>
	       <p class="teadec">会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础</p>
	       <p class="courselabel clock">30课时 600分钟<span class="courselabel student">2555人学习</span><span class="courselabel pingjia">评价：<img width="71" height="14" src="images/evaluate.png" data-bd-imgshare-binded="1"></span></p>
	   </span>
	   <div style="height:0" class="clearh"></div>
	</li>
	<li>
	     <span class="courseimg tcourseimg"><a href="coursecont.html" target="_blank"><img width="230" src="images/c8.jpg"></a></span>
	     <span class="tcoursetext">
	        <h4><a href="coursecont.html" target="_blank" class="teatt">会计从业资格会计基础会计从业资格会计基础会计础</a><a class="state end">已完结</a></h4>
	        <p class="teadec">会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础</p>
	        <p class="courselabel clock">30课时 600分钟<span class="courselabel student">2555人学习</span><span class="courselabel pingjia">评价：<img width="71" height="14" src="images/evaluate.png" data-bd-imgshare-binded="1"></span></p>
	     </span>
	     <div style="height:0" class="clearh"></div>
	</li>
<div class="clearh"></div>
</ul>
</div>




<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection