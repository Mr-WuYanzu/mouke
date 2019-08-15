@extends('layouts.layouts')

@section('title','课程内容')

@section('content')
<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<div class="course_img"><img src="images/c1.jpg" width="500"></div>
    <div class="coursetitle">
   		<a class="state">
            @if($currInfo['status']==1)
                完结
            @else
                更新中
            @endif
        </a>
    	<h2 class="courseh2">{{$currInfo['curr_name']}}</h2>
        <p class="courstime">总课时：<span class="course_tt">{{$currInfo['classNum']}}课时</span></p>
		<p class="courstime">课程时长：<span class="course_tt">不详</span></p>
        <p class="courstime">学习人数：<span class="course_tt">{{$currInfo['study_num']}}人</span></p>
		<p class="courstime">讲师：{{$teacherInfo['t_name']}}</p>
		<p class="courstime">课程评价：<img width="71" height="14" src="images/evaluate5.png">&nbsp;&nbsp;<span class="hidden-sm hidden-xs">5.0分（10人评价）</span></p>
        <!--<p><a class="state end">完结</a></p>-->      
        <span class="coursebtn">
            <a class="btnlink" href="/curr/chapterlist/{{$currInfo['curr_id']}}">加入学习</a>
            <a class="codol fx" href="javascript:void(0);" onClick="$('#bds').toggle();">分享课程</a>
            <a class="codol sc" href="javascript:;" id="btn" curr_id = "{{$currInfo['curr_id']}}">收藏课程</a>
        </span>
            <span class="exambtn_lore">
                <a class="tkbtn tklog" href="javascript:;" curr_id="{{$teacherInfo->curr_id}}" id="subscribe">订阅课程</a>
            </span>
        </span>

		<div style="clear:both;"></div>
		<div id="bds">
            <div class="bdsharebuttonbox">
				<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
				<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
				<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
				<a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
				<a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
				<a href="#" class="bds_more" data-cmd="more"></a>
				<a class="bds_count" data-cmd="count"></a>
			</div>
            <script>
			window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
			</script>
       </div>
    </div>
    <div class="clearh"></div>
</div>

<div class="clearh"></div>
<div class="coursetext">
	<h3 class="leftit">课程简介</h3>
    <p class="coutex">{{$currInfo['curr_detail']}}</p>
	<div class="clearh"></div>
	<h3 class="leftit">课程目录</h3>
    <dl class="mulu">
        @foreach($chapter as $k=>$v)
            <dt><a href="/curr/chapterlist/{{$v['curr_id']}}" class="graylink">第{{$v['chapter_num']}}章&nbsp;&nbsp;{{$v['chapter_name']}}</a></dt>
            <dd>{{$v['chapter_desc']}}</dd>
        @endforeach
    

    </dl>
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">授课讲师</h3>
    <div class="teacher">
    <div class="teapic ppi">
    <a href="teacher.html" target="_blank"><img src="images/teacher.png" width="80" class="teapicy" title="张民智"></a>
    <h3 class="tname"><a href="teacher.html" class="peptitle" target="_blank">张民智</a><p style="font-size:14px;color:#666">会计讲师</p></h3>
    </div>
    <div class="clearh"></div>
    <p>十年以上Linux从业经验， 培训经验超过八年。在各 个知名培训机构做过金牌 讲师、学科负责人，培训 学员过万人。曾获红帽认 证讲师，微软认证讲师等 资质认证。教学以逻辑性 强、教学细致、知识点准 确著称。</p>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">课程公告</h3>
    <div class="gonggao">
	<div class="clearh"></div>
    <p>人所缺乏的不是才干而是志向，不是成功的能力而是勤劳的意志。<br/>
	<span class="gonggao_time">2014-12-12 15:01</span>
	</p>
	<div class="clearh"></div>
	<p>请学习的同学在每节课学习后务必做完当节课的测试！<br/>
	<span class="gonggao_time">2014-12-12 15:01</span>
	</p>
	<div class="clearh"></div>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">相关课程</h3>
    <div class="teacher">
    <div class="teapic">
        <a href="#"  target="_blank"><img src="images/c1.jpg" height="60" title="财经法规与财经职业道德"></a>
        <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
    </div>
    <div class="clearh"></div>
    <div class="teapic">
        <a href="#"  target="_blank"><img src="images/c2.jpg" height="60" title="财经法规与财经职业道德"></a>
        <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
    </div>
    <div class="clearh"></div>
    <div class="teapic">
        <a href="#"  target="_blank"><img src="images/c3.jpg" height="60" title="财经法规与财经职业道德"></a>
        <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
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
    $(function(){
        //点击订阅
        $(document).on('click','#subscribe',function(){
            //获取课程id
            var curr_id=$(this).attr('curr_id');
            $.post(
                "/course/subscribe",
                {curr_id:curr_id},
                function(res){
                    // console.log(res);
                    if(res.code == 100){
                        alert(res.msg);
                    }else if(res.code == 2){
                        alert(res.msg);
                        location.href='/login';
                    }else{
                        alert(res.msg);
                    }
                }
                ,'json '
            )
        })
    })
</script>





@endsection
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/layui/layui.js"></script>
<script src="/layui/css/layui.css"></script>
<script>
    $(function(){
        layui.use(['layer'],function(){
            var layer = layui.layer;

            $("#btn").click(function(){
                var curr_id = $(this).attr('curr_id');
                $.post(
                    '/curr/collectdo',
                    {curr_id:curr_id},
                    function(res){
                        console.log(res);
                        var code = res.code;
                        if(code == 200){
                            layer.msg(res.msg,{icon:6});
                        }else{
                            layer.msg(res.msg,{icon:2});
                        }
                    }
                )

            })

        })
    })

</script>