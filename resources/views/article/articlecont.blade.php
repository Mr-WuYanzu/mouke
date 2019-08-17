@extends('layouts.layouts')

@section('title','资讯详情')

@section('content')

<link rel="stylesheet" href="{{asset('css/article.css')}}">
<script src="{{asset('js/mine.js')}}"></script>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<h3 class="righttit">全部资讯</h3>
    <div class="clearh"></div>
    <span class="bread">
        <a class="ask_link" href="/article/articlelist">全部资讯</a>&nbsp;/&nbsp;
        <a class="ask_link" href="/article/articlelist/?info_cate_id={{$Info_cate->info_cate_id}}">{{$Info_cate->info_name}}</a>&nbsp;/&nbsp;
        {{$Info['info_title']}}
    </span>
    
</div>
<div class="clearh"></div>
<div class="coursetext">
	<span class="articletitle">
        <h2>{{$Info['info_title']}}</h2>
        <p class="gray">{{date('Y-m-d h:i:s',$Info['create_time'])}}</p>
    </span>
    <p class="coutex">{{$Info['info_detail']}}</p>
	<div class="clearh" style="height:30px;"></div>
	<span class="pagejump">
        @if($top_id != '')
    	    <a class="pagebtn lpage" title="上一篇" href="/article/articlecont/?info_id={{$top_id}}">上一篇</a>
        @else

        @endif

        @if($lower_id != '')
            <a class="pagebtn npage" title="下一篇" href="/article/articlecont/?info_id={{$lower_id}}">下一篇</a>
        @else

        @endif


    </span>
    
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">热门资讯</h3>
    <div class="gonggao">
	<ul class="hotask">
        @foreach($hot as $k=>$v)
        	<li><a class="ask_link" href="/article/articlecont/?info_id={{$v->info_id}}"><strong>●</strong>{{$v->info_title}}</a></li>
        @endforeach
    </ul>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">推荐课程</h3>
    <div class="teacher">
    <div class="teapic">
        <a href="#"  target="_blank"><img src="images/c3.jpg" height="60" title="财经法规与财经职业道德"></a>
        <h3 class="courh3"><a href="#" class="ask_link" target="_blank">财经法规与财经职业道德</a></h3>
    </div>
    </div>
    </div>
</div>
   
</div>



<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>
@endsection
