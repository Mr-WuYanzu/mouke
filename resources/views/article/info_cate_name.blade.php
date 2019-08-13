@if($Info_name == '')
    <div class="coursetext">
        <span>该分类下还没有资讯</span>
    </div>
@else
    <div class="coursetext">
    <div class="articlelist">
            @foreach($Info_name as $k=>$v)
            <h3><a class="artlink" href="/article/articlecont/{{$v->info_id}}">{{$v->info_title}}</a></h3>
            <p>
                @if(strlen($v->info_desc)>10)
                    <?php
                    $a=substr($v->info_desc,0,10);
                    $b=$a.".....";
                    ?>
                    {{$b}}
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
@endif