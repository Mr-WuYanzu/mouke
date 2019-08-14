<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>开始学习</title>
<script src="{{asset('js/jquery-1.8.0.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/tab.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
  		<!-- video.js must be in the <head> for older IEs to work. -->
<link rel="stylesheet" href="{{asset('js/video-js.css')}}" >
<script src="{{asset('js/video.js')}}"></script>
<script>
        videojs.options.flash.swf = "video-js.swf";
		
</script>
<script type="text/javascript">
	$(function(){

		$('.demo2').Tabs({
			event:'click'
		});
	});
</script>
<style>
      body { overflow:hidden;
	  		 scrollbar-base-color:#fff;
			 scrollbar-arrow-color:#fff; /*三角箭头的颜色*/
			 scrollbar-face-color: #333; /*立体滚动条的颜色（包括箭头部分的背景色）*/
			 scrollbar-3dlight-color: #fff; /*立体滚动条亮边的颜色*/
			 scrollbar-highlight-color: #fff; /*滚动条的高亮颜色（左阴影？）*/
			 scrollbar-shadow-color: #fff; /*立体滚动条阴影的颜色*/
			 scrollbar-darkshadow-color:#fff; /*立体滚动条外阴影的颜色*/
			 scrollbar-track-color: #fff; /*立体滚动条背景颜色*/
			 
			 
			
	  }
	   /* 设置滚动条的样式 */
			::-webkit-scrollbar {
				width: 10px;
			}
			/* 滚动槽 */
			::-webkit-scrollbar-track {
				border-radius:0
			}
			/* 滚动条滑块 */
			::-webkit-scrollbar-thumb {
				background: #333;
				
			}
			::-webkit-scrollbar-thumb:window-inactive {
				background: rgba(255,0,0,0.4);
			}
</style>
</head>

<body>
   <div class="linevideo" style="overflow-x:hidden">
    	<span class="returnindex"><a class="gray" href="/curr/chapterlist/{{$curr_id}}" style="font-size:14px;">返回课程</a></span>
        <span class="taskspan"><span class="ts">课时100</span>&nbsp;&nbsp;<b class="tasktit">会计的概念与目标1</b></span> 
        <div style="width:100%;margin-top:20px;">
			<video width="auto" id="example_video_1" class="video-js vjs-default-skin  vjs-big-play-centered vvi " controls preload="none"  poster="images/c8.jpg" data-setup="{}"><!--poster是视频未播放前的展示图片-->
			<source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
			<source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
			<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />    
			</video>
			<p class="signp"><span class="sign">学过了</span><span class="nextcourse" title="下一课时">∨</span></p>
        </div>       
    </div>    
  <div class="interact">
   		<span class="ii" title="展开或收起">></span>
        <div class="clearh"></div>
        <!--<div class="coursmall">
        
        <img class="csimg" src="images/121.png" width="153" height="75">
        <span class="lineevalue">
        <p>计算机等级考试二级C语言</p>
            <!--<p class="graytext"><img src="images/evaluate.png" width="71" height="14">(181份评价)</p>
            <p class="graytext">讲师：王老师</p>
            <p><a class="dowork" target="_blank" href="#">去做作业→</a></p>
         </span>
         <div class="clearh"></div>
        </div>-->
  
          <div class="box1 demo2">
			<ul class="tab_menu vmulu">
				<li class="current">目录</li>
				<li>笔记</li>
				<li>问答</li>
                <li>作业</li>
            </ul>
			<div class="tab_box tabcard">
				<div style="padding-bottom:30px;">
					<dl class="mulu noo1">
						@foreach($chapterInfo as $k=>$v)
                        <dt>第{{$v['chapter_num']}}章&nbsp;&nbsp;{{$v['chapter_name']}}</dt>
						@foreach($v['son'] as $kk=>$vv)
                        <a href="#"><dd><i class="forwa nn"></i><strong class="cataloglink" class_hour_id="{{$vv['class_id']}}">课时{{$vv['class_hour_num']}}：{{$vv['class_name']}}</strong></dd></a>
							@endforeach
						@endforeach
                   </dl>	
				   <div class="clearh"></div>
				</div>
				
				<div class="hide">
					<div style="padding-left:25px;">
                    <div class="c_eform" style="width:280px;margin-left:10px;">
                        <div class="clearh" ></div>
                        <textarea rows="7" class="pingjia_con" style="width:100%;height:500px;" onblur="if (this.value =='') this.value='记下课程笔记';this.className='pingjia_con'" onclick="if (this.value=='记下课程笔记') this.value='';this.className='pingjia_con_on'">记下课程笔记</textarea>
                       <a href="#" class="fombtn">提交</a>
                       <div class="clearh"></div>
                    </div>					
				</div>
				</div>
                <div class="hide">
					<div style="padding-left:15px;">                   
                    <div class="c_eform veform">
                    <div class="clearh" ></div>
                        <input class="inputitle pingjia_con" type="text"  value="请输入问题标题" onblur="if (this.value =='') this.value='请输入问题标题';this.className='inputitle pingjia_con'" onclick="if (this.value=='请输入问题标题') this.value='';this.className='inputitle pingjia_con_on'"/>
                        <textarea rows="7" class="pingjia_con" style="width:90%;"  onblur="if (this.value =='') this.value='请输入问题的详细内容';this.className='pingjia_con'" onclick="if (this.value=='请输入问题的详细内容') this.value='';this.className='pingjia_con_on'"></textarea><br/>
                       <a href="#" class="fombtn" style="margin-right:30px;">发布</a>
                       <div class="clearh"></div>
                    </div>
					<ul class="evalucourse" style="width:280px;">
                    	<li>
                        	<p class="vptext"><a target="_blank" class="peptitle" href="#">2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年?</a></p>         <p class="peptime pswer"><span style="float:left;"><b class="coclass">候候&nbsp;&nbsp;</b>发表于 2015-05-8 </span><span class="pepask" style="float:right;">回答(<strong style="color:#3eb0e0;"><a href="#" class="bluelink" target="_blank">10</a></strong>)&nbsp;&nbsp;&nbsp;&nbsp;浏览(<strong style="color:#3eb0e0;"><a href="#" class="bluelink" target="_blank">10</a></strong>)</span>					
                            </p>                           
                        </li>
                        <li>
                        	<p class="vptext"><a target="_blank" class="peptitle" href="#">2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年?</a></p>         <p class="peptime pswer"><span style="float:left;"><b class="coclass">候候&nbsp;&nbsp;</b>发表于 2015-05-8 </span><span class="pepask" style="float:right;">回答(<strong style="color:#3eb0e0;"><a href="#" class="bluelink" target="_blank">10</a></strong>)&nbsp;&nbsp;&nbsp;&nbsp;浏览(<strong style="color:#3eb0e0;"><a href="#" class="bluelink" target="_blank">10</a></strong>)</span>					
                            </p>                           
                        </li>                       
                    </ul>
                    
				</div>
				</div>
				<div class="hide">
                    <div class="c_eform veform" style="margin-top:15px;margin-left:35px;">
					   <!--四种状态-->
					   <p>此课时暂无作业</p>
					   <p>共4道作业题<a href="homework.html" target="_blank"><span class="star_zy">继续做题</span></a></p>
					   <p>共4道作业题<a href="homework_jiexi.html" target="_blank"><span class="star_zy">查看解析</span></a></p>
					   <p>共4道作业题<a href="homework.html" target="_blank"><span class="star_zy">开始作业</span></a></p>                                 
				</div>
				</div>				
			</div>
		</div> 
    </div>
</body>
</html>
<script>
	$(function () {
		$(document).on('click','.cataloglink',function () {
			var class_id = $(this).attr('class_hour_id');
			var example_video_1 = $('#example_video_1');
			$.ajax({
				url:'/curr/getvideo',
				type:'post',
				data:{class_id:class_id},
				dataType:'json',
				success:function (res) {
					if(res.status==200){
						if(res.video_type=='mp4'){
							example_video_1.empty();
							example_video_1.append('<source src="'+res.video_url+'" type="video/mp4" />');
						}else if(res.video_type=='webm'){
							example_video_1.empty();
							example_video_1.append('<source src="'+res.video_url+'" type="video/webm" />');
						}else if(res.video_type=='ogv'){
							example_video_1.empty();
							example_video_1.append('<source src="'+res.video_url+'" type="video/ogg" />');
						}
					}else if(res.status==201){
						a=confirm('这是一个直播课时，是否跳转至直播页面');
						if(a){
							location.href=res.live_url;
						}else{
							a.close();
						}
					}else{
						alert(res.msg);
					}
				}
			})
		})
	})
</script>
