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
    <img src="{{asset('images/teacher.jpg')}}" width="150"> 
    </div>
    <div class="teachtext">
    	<h3>{{$teacherInfo['t_name']}}&nbsp;&nbsp;<strong>会计基础、会计电算化讲师</strong></h3>
        <h4>个人简介</h4>
        <p>{{str_replace(mb_substr($teacherInfo['t_desc'],100,mb_strlen($teacherInfo['t_desc'])),'...',$teacherInfo['t_desc'])}}</p>
        <h4>授课风格</h4>
        <p>马老师讲授的课程紧扣大纲，重点突出；举例风趣幽默，讲解通俗易懂;传授的学习方法简洁有效；同时，注意与学员进行各种交流，及时解答学员疑惑，反馈学员建议，深受好评。</p>
    </div>
    <div class="clearh"></div>
</div>

<div class="clearh"></div>

<div class="tcourselist">
<h3 class="righttit" style="padding-left:50px;">在教课程</h3>
<ul class="tcourseul">
	@foreach($currInfo as $v)
	<li>
	    <span class="courseimg tcourseimg"><a href="/curr/currcont" target="_blank"><img width="230" src="{{asset('images/c8.jpg')}}"></a></span>
	    <span class="tcoursetext">
	       <h4><a href="/curr/currcont" target="_blank" class="teatt">{{$v['curr_name']}}</a><a class="state">@if($v['status']==1) 已完结 @else 更新中 @endif</a></h4>
	       <p class="teadec">{{str_replace(mb_substr($v['curr_detail'],120,mb_strlen($v['curr_detail'])),'...',$v['curr_detail'])}}</p>
	       <p class="courselabel clock">{{$v['total_class_hour']}}课时 600分钟<span class="courselabel student">2555人学习</span><span class="courselabel pingjia">评价：<img width="71" height="14" src="{{asset('images/evaluate.png')}}" data-bd-imgshare-binded="1"></span></p>
	   </span>
	   <div style="height:0" class="clearh"></div>
	</li>
	@endforeach
<div class="clearh"></div>
</ul>
</div>




<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection