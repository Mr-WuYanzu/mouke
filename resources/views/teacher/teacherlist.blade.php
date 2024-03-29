@extends('layouts.layouts')

@section('title','讲师列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont" style="background: none repeat scroll 0 0 #fff;border-radius: 3px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" >

    <h3 class="righttit" style="padding-left:50px;">优秀讲师</h3>
    @foreach($teacherInfo as $v)


	<div class="coursepic tecti">
		<div class="teaimg">
		<a href="/teacher/teachercont?t_id={{$v['t_id']}}" target="_blank"><img src="http://curr.img.com/{{$v['header_img']}}" width="150"></a>
		</div>
		<div class="teachtext">
			<h3><a href="/teacher/teachercont?t_id={{$v['t_id']}}" target="_blank" class="teatt">{{$v['t_name']}}</a>&nbsp;&nbsp;<strong>{{$v['teacher_direction']}}</strong></h3>
			<h4>个人简介</h4>
			<p>{{str_replace(mb_substr($v['t_desc'],100,mb_strlen($v['t_desc'])),'...',$v['t_desc'])}}</p>
			<h4>授课风格</h4>
			<p>马老师讲授的课程紧扣大纲，重点突出；举例风趣幽默，讲解通俗易懂;传授的学习方法简洁有效；同时，注意与学员进行各种交流，及时解答学员疑惑，反馈学员建议，深受好评。</p>
		</div>
		<div class="clearh"></div>
	</div>
	@endforeach
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection