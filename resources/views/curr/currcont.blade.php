@extends('layouts.layouts')

@section('title','课程内容')

@section('content')
<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('layui/css/layui.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<div class="course_img"><img src="http://curr.img.com/{{$currInfo['curr_img']}}" width="500"></div>
    <div class="coursetitle">
   		<a class="state">
            @if($currInfo['status']==1)
                完结
            @else
                更新中
            @endif
        </a>
    	<h2 class="courseh2">{{$currInfo['curr_name']}}</h2>
        <p class="courstime">总课时：<span class="course_tt">{{$currInfo['classNum']??'直播'}}课时</span></p>
		<p class="courstime">课程时长：<span class="course_tt">不详</span></p>
        <p class="courstime">学习人数：<span class="course_tt">{{$currInfo['study_num']}}人</span></p>
		<p class="courstime">讲师：{{$teacherInfo['t_name']}}</p>
		<p class="courstime">课程评价：<img width="71" height="14" src="/images/evaluate5.png">&nbsp;&nbsp;<span class="hidden-sm hidden-xs">5.0分（10人评价）</span></p>
        <!--<p><a class="state end">完结</a></p>-->      
        <span class="coursebtn">
            @if($currInfo['curr_type']==1)
                @if($currInfo['live_status']==2)
                    <a class="btnlink" href="http://zhibo.mk.com/curr?curr_id={{$currInfo['curr_id']}}&t_id={{$teacherInfo['t_id']}}">观看直播</a>&nbsp&nbsp&nbsp&nbsp
                @else
                    <a class="btnlink" href="JavaScript:;">还未开播</a>&nbsp&nbsp&nbsp&nbsp
                @endif
            @else
                <a class="btnlink" href="/curr/chapterlist/{{$currInfo['curr_id']}}">加入学习</a>&nbsp&nbsp&nbsp&nbsp
            @endif

            @if($collect_status == '')
                <a class="layui-btn layui-btn-normal" href="javascript:;" id="btn" curr_id = "{{$currInfo['curr_id']}}">收藏课程</a>
            @elseif($collect_status == 1)
                <a class="layui-btn layui-btn-normal" href="javascript:;" id="btn_no" curr_id = "{{$currInfo['curr_id']}}">取消收藏</a>
            @elseif($collect_status == 2)
                <a class="layui-btn layui-btn-normal" href="javascript:;" id="btn" curr_id = "{{$currInfo['curr_id']}}">收藏课程</a>
            @endif

            <a class="layui-btn layui-btn-normal" href="javascript:;" curr_id="{{$teacherInfo->curr_id}}" id="subscribe">订阅课程</a>



            <a class="codol fx" href="javascript:void(0);" onClick="$('#bds').toggle();">分享课程</a>
        </span>
		<div style="clear:both;"> </div>
		<div id="bds">
            <div class="bdsharebuttonbox">
				<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone" id="zone"></a>
				<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
				<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq" id="blog"></a>
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
    <a href="teacher.html" target="_blank"><img src="http://curr.img.com/{{$teacherInfo['header_img']}}" width="80" class="teapicy" title="{{$teacherInfo['t_name']}}"></a>
    <h3 class="tname"><a href="teacher.html" class="peptitle" target="_blank">{{$teacherInfo['t_name']}}</a><p style="font-size:14px;color:#666">{{$teacherInfo['teacher_direction']}}</p></h3>
    </div>
    <div class="clearh"></div>
    <p>{{$teacherInfo['t_desc']}}</p>
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
        layui.use(['layer'],function() {
            var layer = layui.layer;
            //点击订阅
            $(document).on('click', '#subscribe', function () {
                //获取课程id
                var curr_id = $(this).attr('curr_id');
                $.post(
                    "/course/subscribe",
                    {curr_id: curr_id},
                    function (res) {
                        // console.log(res);
                        layer.msg(res.msg,{icon:res.code,time:2000},function(){
                            if (res.code == 1) {

                            }else if(res.code == 2) {
                                location.href='/login';
                            }
                        });

                    }
                    , 'json '
                )
            })
            //点击收藏
            $(document).on('click','#btn',function () {
                var curr_id = $(this).attr('curr_id');
                var _save = $(this);
                $.post(
                    '/curr/collectdo',
                    {curr_id:curr_id},
                    function(res){
                        // console.log(res);
                        if(res.code == 1){
                            layer.msg(res.msg,{icon:res.code,time:2000});
                                _save.text('取消收藏');
                                _save.prop('id','btn_no');
                        }else if(res.code == 2){
                            layer.msg(res.msg,{icon:res.code,time:2000},function(){
                                location.href='/login';
                            });
                        }
                    }
                )

            })
            //取消收藏
            $(document).on('click','#btn_no',function () {
                var curr_id = $(this).attr('curr_id');
                var _save = $(this);
                $.post(
                    '/curr/collectdo_no',
                    {curr_id:curr_id},
                    function(res){
                        // console.log(res);
                        if(res.code == 1){
                            layer.msg(res.msg,{icon:res.code,time:2000});
                            _save.text('收藏课程');
                            _save.prop('id','btn');
                        }else if(res.code == 2){
                            layer.msg(res.msg,{icon:res.code,time:2000},function(){
                                location.href='/login';
                            });
                        }else{
                            layer.msg(res.msg,{icon:res.code,time:2000});
                        }
                    }
                )

            })


            //分享到新浪微博
            $('#blog').click(function(){
                window.sharetitle = '<%$info.title%>';//标题
                window.shareUrl = '__IMG__<%$info.img.0.url%>';//缩略图
                share();
            });
            //分享到微博
            function share(){
                //d指的是window
                (function(s,d,e){try{}catch(e){}var f='http://v.t.sina.com.cn/share/share.php?',
                    u=d.location.href,
                    p=['url=',
                    e(u),
                    '&title=',
                    e(window.sharetitle),
                    '&appkey=2924220432',
                    '&pic=',
                    e(window.shareUrl)].join('');
                    function a(){if(!window.open([f,p].join(''),
                        'mb',
                        [
                        'toolbar=0,' +
                        'status=0,' +
                        'resizable=1,' +
                        'width=620,' +
                        'height=450,' +
                        'left=',
                        (s.width-620)/2,
                        ',top=',
                        (s.height-450)/2].join('')))u.href=[f,p].join('');
                    };
                    if(/Firefox/.test(navigator.userAgent)){
                        setTimeout(a,0)
                    }else{
                        a()
                    }
                })
                (screen,document,encodeURIComponent);
            }

            //分享到QQ空间
            $("#zone").click(function(){
                var p = {
                    url:location.href,
                    showcount:'1',/*是否显示分享总数,显示：'1'，不显示：'0' */
                    desc:'',/*默认分享理由(可选)*/
                    summary:'我在【空间家】上找到一个好位置，地段好又划算，快来看看吧！',/*分享摘要(可选)*/
                    title:'<%$info.title%>',/*分享标题(可选)*/
                    site:'空间家',/*分享来源 如：腾讯网(可选)*/
                    pics:'__IMG__<%$info.img.0.url%>', /*分享图片的路径(可选)*/
                    style:'203',
                    width:98,
                    height:22
                };
                var s = [];
                for(var i in p){
                    s.push(i + '=' + encodeURIComponent(p[i]||''));
                }
                window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?"+s.join('&'));
            });



        })
    })
</script>
@endsection
