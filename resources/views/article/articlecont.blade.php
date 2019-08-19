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
        <a class="ask_link" href="/article/articlelist">{{$info_name}}</a>&nbsp;/&nbsp;
        {{$Info->info_title}}
    </span>
    
</div>
<div class="clearh"></div>
<div class="coursetext">
	<span class="articletitle">
        <h2>{{$Info->info_title}}</h2>
        <p class="gray">{{date('Y-m-d h:i:s',$Info->create_time)}}</p>
    </span>
    <p class="coutex">{{$Info->info_detail}}</p>
	<div class="clearh" style="height:30px;"></div>
	<span class="pagejump">
    	<a class="pagebtn lpage" title="上一篇" href="#">上一篇</a>
        <a class="pagebtn npage" title="下一篇" href="#">下一篇</a>
    </span>
    
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">热门资讯</h3>
    <div class="gonggao">
	<ul class="hotask">
        @foreach($hot as $k=>$v)
        	<li><a class="ask_link" href="/article/articlecont/{{$v->info_id}}"><strong>●</strong>{{$v->info_title}}</a></li>
        @endforeach
    </ul>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">推荐课程</h3>
    <div class="teacher">
        @foreach($currInfo as $k=>$v)
            <div class="teapic">
                <a href="/curr/chapterlist/{{$v['curr_id']}}"  target="_blank"><img src="http://curr.img.com/{{$v['curr_img']}}" height="60" title="{{$v['curr_name']}}"></a>
                <h3 class="courh3"><a href="/curr/chapterlist/{{$v['curr_id']}}" class="ask_link" target="_blank">{{$v['curr_name']}}</a></h3>
            </div>
        @endforeach
    </div>
    </div>
</div>
   
</div>



<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection