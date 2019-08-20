@extends('layouts.layouts')

@section('title','章节列表')

@section('content')

    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>
    <script type="text/javascript">
        $(function(){

            $('.demo2').Tabs({
                event:'click'
            });
            $('.demo3').Tabs({
                event:'click'
            });
        });
    </script>

    <!-- InstanceBeginEditable name="EditRegion1" -->


    <div class="coursecont">
        <div class="coursepic1">
            <div class="coursetitle1">
                <h2 class="courseh21">{{$currInfo['curr_name']}}</h2>
                <div  style="margin-top:-40px;margin-right:25px;float:right;">
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
            <div class="course_img1">
                <img src="http://curr.img.com/{{$currInfo['curr_img']}}" height="140">
            </div>
            <div class="course_xq">
                <span class="courstime1"><p>课时<br/><span class="coursxq_num">{{$currInfo['classNum']}}课时</span></p></span>
                <span class="courstime1"><p>学习人数<br/><span class="coursxq_num">{{$currInfo['study_num']}}人</span></p></span>
                <span class="courstime1"><p style="border:none;">课程时长<br/><span class="coursxq_num">不详</span></p></span>
            </div>
            <div class="course_xq2">
                <input type="hidden" value="{{$currInfo['curr_id']}}" id="curr_id">
                <a class="course_learn" href="/curr/video/{{$currInfo['curr_id']}}">开始学习</a>
            </div>
            <div class="clearh"></div>
        </div>

        <div class="clearh"></div>
        <div class="coursetext">
            <div class="box demo2" style="position:relative">
                <ul class="tab_menu">
                    <li class="current course1">章节</li>
                    <li class="course1">评价</li>
                    <li class="course1">问答</li>
                    <li class="course1">资料区</li>
                </ul>
                <!--<a class="fombtn" style=" position:absolute; z-index:3; top:-10px; width:80px; text-align:center;right:0px;" href="#">下载资料包</a>-->
                <div class="tab_box">
                    <div>
                        <dl class="mulu noo">
                            @foreach($chapterInfo as $k=>$v)
                                <div>
                                    <dt class="mulu_title"><span class="mulu_img"></span>第{{$v['chapter_num']}}章&nbsp;&nbsp;{{$v['chapter_name']}}
                                        <span class="mulu_zd">+</span></dt>
                                    <div class="mulu_con">
                                        @foreach($v['son'] as $kk=>$vv)
                                            <a href="/curr/video/{{$currInfo['curr_id']}}"><dd><strong class="cataloglink">课时{{$vv['class_hour_num']}}：{{$vv['class_name']}}</strong><i class="fini nn"></i></dd></a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </dl>
                    </div>


                    <div class="hide">
                        <form method="post">
                            <div>
                                <div id="star">
                                    <span class="startitle">请打分</span>
                                    <ul id="grade">
                                        <li class="num"><a href="javascript:;">1</a></li>
                                        <li class="num"><a href="javascript:;">2</a></li>
                                        <li class="num"><a href="javascript:;">3</a></li>
                                        <li class="num"><a href="javascript:;">4</a></li>
                                        <li class="num"><a href="javascript:;">5</a></li>
                                    </ul>
                                    <span></span>
                                    <p></p>
                                </div>
                                <div class="c_eform">
                                    <textarea rows="7" id="comment_detail" class="pingjia_con" onblur="if (this.value =='') this.value='评价详细内容';this.className='pingjia_con'" onclick="if (this.value=='评价详细内容') this.value='';this.className='pingjia_con_on'">评价详细内容</textarea>
                                    <a style="cursor:pointer;" id="addComment" class="fombtn">发布评论</a>
                                    <div class="clearh"></div>
                                </div>
                        </form>
                        <ul class="evalucourse">
                            @foreach($commentInfo as $v)
                                <li>
                                    <span class="pephead">
                                        <img src="{{asset('images/0-0.JPG')}}" width="50" title="候候">
                                        <p class="pepname">{{$v['user_name']}}</p>
                                    </span>
                                    <span class="pepcont">
                                        <p>{{$v['comment_detail']}}</p>
                                        <p class="peptime pswer">{{date('Y-m-d H:i:s',$v['create_time'])}}</p>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="hide">
                    <div>
                        <h3 class="pingjia">提问题</h3>
                        <div class="c_eform">
                            <input type="text" id="quest_title" class="pingjia_con" placeholder="请输入问题标题"/><br/>
                            <textarea rows="7" id="quest_detail" class="pingjia_con" placeholder="请输入详细内容"></textarea>
                            <a href="javascript:;" class="fombtn" curr_id="{{$currInfo['curr_id']}}" id="quest">发布</a>
                            <div class="clearh"></div>
                        </div>
                        <ul class="evalucourse ul">
                            @if($questInfo == '')

                            @else
                                @foreach($questInfo as $k=>$v)
                                <li>
                                    <span class="pephead"><img src="images/0-0.JPG" width="50" title="" id="img_username">
                                    <p class="pepname" id="username">{{$v->user_name}}</p>
                                    </span>
                                        <span class="pepcont">
                                    <p id="q_title"><a href="#" class="peptitle" target="_blank">{{$v->quest_title}}</a></p>
                                    <p class="peptime pswer">{{$v->create_time}}</p>
                                    </span>
                                </li>
                            @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
                <div class="hide">
                    <div>
                        <ul class="notelist" >
                            <li>
                                <p class="mbm mem_not"><a href="#" class="peptitle">1.rar</a></p>
                                <p class="gray"><b class="coclass">课时：<a href="#" target="_blank">会计的概念与目标1</a></b><b class="cotime">上传时间：<b class="coclass" >2015-05-8</b></b></p>

                            </li>
                            <li>
                                <p class="mbm mem_not"><a href="#" class="peptitle">资料.rar</a></p>
                                <p class="gray"><b class="coclass">课时：<a href="#" target="_blank">会计的概念与目标2</a></b><b class="cotime">上传时间：<b class="coclass" >2015-05-8</b></b></p>



                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="courightext">
        <div class="ctext">
            <div class="cr1">
                <h3 class="righttit">授课讲师</h3>
                <div class="teacher">
                    <div class="teapic ppi">
                        <a href="/teacher/teachercont?t_id={{$teacherInfo['t_id']}}" target="_blank"><img src="http://curr.img.com/{{$teacherInfo['header_img']}}" width="80" class="teapicy" title="{{$teacherInfo['t_name']}}"></a>
                        <h3 class="tname"><a href="/teacher/teachercont?t_id={{$teacherInfo['t_id']}}" class="peptitle" target="_blank">{{$teacherInfo['t_name']}}</a></h3>
                    </div>
                    <div class="clearh"></div>
                    <p>{{$teacherInfo['t_desc']}}</p>
                </div>
            </div>
        </div>

        <div class="ctext">
            <div class="cr1">
                <h3 class="righttit" onclick="reglog_open();">最新学员</h3>
                <div class="teacher zxxy">
                    <ul class="stuul">
                        <li><img src="images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                        <li><img src="images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                        <li><img src="images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                        <li><img src="images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                    </ul>
                    <div class="clearh"></div>
                </div>
            </div>
        </div>

        <div class="ctext">
            <div class="cr1">
                <h3 class="righttit">相关课程</h3>
                <div class="teacher">
                    @foreach($relevant_curr as $k=>$v)
                        <div class="teapic">
                            <a href="#"  target="_blank"><img src="images/c1.jpg" height="60" title="{{$v['curr_name']}}"></a>
                            <h3 class="courh3"><a href="#" class="peptitle" target="_blank">{{$v['curr_name']}}</a></h3>
                        </div>
                        <div class="clearh"></div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    <div id="reglog">
        <span class="close"  onclick="reglog_close();">×</span>
        <div class="loginbox">
            <div class="demo3 rlog">
                <ul class="tab_menu rlog">
                    <li class="current">登录</li>
                    <li>注册</li>
                </ul>
                <div class="tab_box">
                    <div>
                        <form class="loginform pop">
                            <div>
                                <p class="formrow">
                                    <label class="control-label pop" for="register_email">帐号</label>
                                    <input type="text" class="popinput">
                                </p>
                                <span class="text-danger">请输入Email地址 / 用户昵称</span>
                            </div>

                            <div>
                                <p class="formrow">
                                    <label class="control-label pop" for="register_email">密码</label>
                                    <input type="password" class="popinput">
                                </p>
                                <p class="help-block"><span class="text-danger">密码错误</span></p>
                            </div>
                            <div class="clearh"></div>
                            <div class="popbtn">
                                <label><input type="checkbox" checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
                                <button type="submit" class="uploadbtn ub1">登录</button>

                            </div>
                            <div class="popbtn lb">
                                <a href="#" class="link-muted">还没有账号？立即免费注册</a>
                                <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <a href="forgetpassword.html" class="link-muted">找回密码</a>
                            </div>


                            <div class="popbtn hezuologo">
                                <span class="hezuo z1">使用合作网站账号登录</span>
                                <div class="hezuoimg z1">
                                    <img src="images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40">
                                    <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="hide">
                        <div>
                            <form class="loginform pop">
                                <div>
                                    <p class="formrow">
                                        <label class="control-label pop" for="register_email">邮箱地址</label>
                                        <input type="text" class="popinput">
                                    </p>
                                    <span class="text-danger">请输入Email地址 / 用户昵称</span>
                                </div>
                                <div>
                                    <p class="formrow">
                                        <label class="control-label pop" for="register_email">昵称</label>
                                        <input type="text" class="popinput">
                                    </p>
                                    <span class="text-danger">请输入Email地址 / 用户昵称</span>
                                </div>
                                <div>
                                    <p class="formrow">
                                        <label class="control-label pop" for="register_email">密码</label>
                                        <input type="password" class="popinput">
                                    </p>
                                    <p class="help-block"><span class="text-danger">密码错误</span></p>
                                </div>
                                <div>
                                    <p class="formrow">
                                        <label class="control-label pop" for="register_email">确认密码</label>
                                        <input type="password" class="popinput">
                                    </p>
                                    <p class="help-block"><span class="text-danger">密码错误</span></p>
                                </div>


                                <button type="submit" class="uploadbtn ub1">注册</button>



                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>


    <div class="clearh"></div>
    </div>
    <!-- InstanceEndEditable -->


    <div class="clearh"></div>

    <script type="text/javascript">

        $(function(){
            layui.use(['layer'],function(){
                var layer=layui.layer;

                //发布评论
                $('#addComment').click(function(){
                    var curr_id = $('#curr_id').val();
                    var obj={};
                    //获取评论内容
                    obj.comment_detail=$('#comment_detail').val();
                    //获取打分项
                    var curr_grade=$('#grade').children('li.on').last().children('a').text();

                    //非空判断
                    if(curr_grade==''){
                        layer.msg('请先打分',{icon:5,time:1000});
                        return false;
                    }

                    if(obj.comment_detail==''){
                        layer.msg('请输入评论内容',{icon:5,time:1000});
                        return false;
                    }

                    //发送请求提交数据
                    $.post(
                        '/curr/comment/addHandle',
                        {data:obj,curr_grade:curr_grade,curr_id:curr_id},
                        function(res){
                            layer.msg(res.font,{icon:res.skin,time:1000},function(){
                                if(res.code==1){
                                    history.go(0);
                                }
                            });
                        },
                        'json'
                    )

                });
                //问答
                $('#quest').click(function () {
                    //获取问答的标题
                    var quest_title=$("#quest_title").val();
                    if(quest_title == ''){
                        layer.msg('问答的标题不能为空',{icon:2,time:2000});
                        return false;
                    }
                    //获取问答的内容
                    var quest_detail=$("#quest_detail").val();
                    if(quest_detail == ''){
                        layer.msg('问答的内容不能为空',{icon:2,time:2000});
                        return false;
                    }
                    //获取课程的id
                    var curr_id=$(this).attr('curr_id');
                    $.post(
                        "/curr/questionadd",
                        {quest_title:quest_title,quest_detail:quest_detail,curr_id:curr_id},
                        function(res){
                            // console.log(res);
                            if(res.code == 1){
                                layer.msg(res.msg,{icon:res.code,time:1000});
                                //显示用户提出的问题
                                // $("#q_title").text(res.data.quest_title);
                                // $("#username").text(res.data.username);
                                // $("#img_username").text(res.data.username);
                                $('.ul').prepend(
                                    '<li class="li">\n' +
                                    '<span class="pephead"><img src="images/0-0.JPG" width="50" title="" id="img_username">\n' +
                                    '<p class="pepname" id="username">'+res.data.username+'</p>\n' +
                                    '</span>\n' +
                                    '<span class="pepcont">\n' +
                                    '<p id="q_title"><a href="#" class="peptitle" target="_blank">'+res.data.quest_title+'</a></p>\n' +
                                    '<p class="peptime pswer">'+res.data.create_time+'</p>\n' +
                                    '</span>\n' +
                                    '</li>'
                                )
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

            });
        });
    </script>

@endsection