@extends('layouts.layouts')

@section('title','资讯列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/article.css')}}">
<link rel="stylesheet" href="{{asset('css/page1.css')}}">
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<h3 class="righttit">全部资讯</h3>
    <div class="clearh"></div>
    <span class="bread nob">
        @foreach($cate_Info as $k=>$v)
            <a class="fombtn cur" href="/article/articlelist/?info_cate_id={{$v->info_cate_id}}">{{$v->info_name}}</a>
        @endforeach
    </span>
    
</div>

<div class="coursetext">

    @if($num==0)
        <marquee><h1 style="color:red;">该分类下还没有资讯</h1></marquee>
    @else
        <div class="articlelist">
            @foreach($Info as $k=>$v)
                <h3><a class="artlink" href="/article/articlecont/?info_id={{$v->info_id}}">{{$v->info_title}}</a></h3>
                <p>
                    @if(strlen($v->info_desc)>10)
                        <?php
                            $a=substr($v->info_desc,0,24);
                            $b=$a.".....";
                            echo $b;
                        ?>
                    @else
                        {{$v->info_desc}}
                    @endif
                </p>
                <p class="artilabel">
                     <span class="ask_label">{{$v->info_name}}</span>
                     <b class="labtime">{{date('Y-m-d h:i:s',$v->create_time)}}</b>
                </p>
            @endforeach
        <div class="clearh"></div>
    </div>

    @endif
	<div class="clearh" style="height:20px;"></div>
	<span class="pagejump">
        {{ $Info->appends($info_cate_id)->links() }}
    </span>
    <div class="clearh" style="height:10px;"></div>
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
            <div class="clearh"></div>
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