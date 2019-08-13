@extends('layouts.layouts')

@section('title','资讯列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/article.css')}}">
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<h3 class="righttit">全部资讯</h3>
    <div class="clearh"></div>
    <span class="bread nob">
        @foreach($cate_Info as $k=>$v)
            <a class="fombtn cur" href="javascript:;" info_cate_id="{{$v->info_cate_id}}">{{$v->info_name}}</a>
        @endforeach
    </span>
    
</div>
<div class="clearh"></div>

<div class="coursetext">
	<div class="articlelist">
        @foreach($Info as $k=>$v)
            <h3><a class="artlink" href="/article/articlecont/{{$v->info_id}}">{{$v->info_title}}</a></h3>
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
    
    
	<div class="clearh" style="height:20px;"></div>
	<span class="pagejump">
    	<p class="userpager-list">
       	   <a href="#" class="page-number">首页</a>
           <a href="#" class="page-number">上一页</a>
           <a href="#" class="page-number">1</a>
           <a href="#" class="page-number pageractive">2</a>
           <a href="#" class="page-number">3</a>
            <a href="#" class="page-number">...</a>
            <a href="#" class="page-number">10</a>
           <a href="#" class="page-number">下一页</a>
           <a href="#" class="page-number">末页</a>
        </p>
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
    <div class="teapic">
        <a href="#"  target="_blank"><img src="images/c1.jpg" height="60" title="财经法规与财经职业道德"></a>
        <h3 class="courh3"><a href="#" class="ask_link" target="_blank">财经法规与财经职业道德</a></h3>
    </div>
    <div class="clearh"></div>
    </div>
    </div>
</div>
   
</div>



<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->
<div class="clearh"></div>

<script>
    $(function () {
        $('.fombtn').click(function(){
            //获取当前点击的 分类id
            var info_cate_id=$(this).attr('info_cate_id');
            $.post(
                '/article/info_cate_name',
                {info_cate_id:info_cate_id},
                function(res){
                    // console.log(res);
                    if(res){
                        $('.coursetext').html(res);
                    }
                }
            )
        })
    })
</script>

@endsection