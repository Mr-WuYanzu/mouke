@extends('layouts.layouts')

@section('title','登录')

@section('content')

<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>
    <link rel="stylesheet" href="css/course.css"/>
    <link rel="stylesheet" href="css/member.css"/>
    <script src="/js/jquery-1.8.0.min.js"></script>
    <link rel="stylesheet" href="/css/tab.css" media="screen">
    <script src="/js/jquery.tabs.js"></script>
    <script src="/js/mine.js"></script>
    <script type="text/javascript">
        $(function(){


            $('.demo2').Tabs({
                event:'click'
            });



        });
    </script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="clearh"></div>
<div class="membertab">
    <div class="memblist">
        <div class="membhead">
            <div style="text-align:center;"><img src="images/0-0.JPG" width="80" ></div>
            <div style="width:220px;text-align:center;">
                <p class="membUpdate mine">{{$user->user_name}}</p>
                <p class="membUpdate mine"><a href="mysetting.html">修改信息</a>&nbsp;|&nbsp;<a href="myrepassword.html">修改密码</a></p>
                <div class="clearh"></div>
            </div>
        </div>
        <div class="memb">

            <ul>
                <li class="currnav"><a class="mb1" href="mycourse.html">我的课程</a></li>
                <li><a class="mb3" href="myask.html">我的问答</a></li>
                <li><a class="mb4" href="mynote.html">我的笔记</a></li>
                <li><a class="mb12" href="myhomework.html">我的作业</a></li>
                <li><a class="mb2" href="training_list.html" target="_blank">我的题库</a></li>
            </ul>

        </div>


    </div>


    <div class="membcont">
        <h3 class="mem-h3">我的课程</h3>
        <div class="box demo2" style="width:820px;">
            <ul class="tab_menu" style="margin-left:30px;">
                <li class="current">学习中</li>
                <li>已学完</li>
                <li>收藏</li>
            </ul>
            <div class="tab_box">
                <div>
                    {{--学习中课程--}}
                    <ul class="memb_course">
                        <li>
                            <div class="courseli">
                                <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon"><a href="video.html"><span>继续学习</span></a></p>
                            </div>
                        </li>
                        <li>
                            <div class="courseli">
                                <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon"><a href="video.html"><span>继续学习</span></a></p>
                            </div>
                        </li>
                        <li>
                            <div class="courseli">
                                <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon"><a href="video.html"><span>继续学习</span></a></p>
                            </div>
                        </li>
                        <div style="height:10px;" class="clearfix"></div>
                    </ul>
                </div>

                <div class="hide">
                    <div>
                        {{--已学完课程--}}
                        <ul class="memb_course">
                            <li>
                                <div class="courseli">
                                    <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                    <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:100%;"></div>
                                    </div>
                                    <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="courseli">
                                    <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                    <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:100%;"></div>
                                    </div>
                                    <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                </div>
                            </li>
                            <div class="clearfix" style="height:10px;"></div>
                        </ul>

                    </div>
                </div>
                <div class="hide">
                    <div>
                        {{--收藏的课程--}}
                        <ul class="memb_course">
                            <li>
                                <div class="courseli mysc">
                                    <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg" class="mm"></a>
                                    <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:20%;"></div>
                                    </div>
                                    <p class="goon"><a href="#"><span>继续学习</span></a></p>
                                    <div class="mask"><span class="qxsc"  title="移除收藏">▬</span></div>
                                </div>
                            </li>
                            <div class="clearfix" style="height:10px;"></div>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="clearh"></div>
</div>

<!-- InstanceEndEditable -->


<div class="clearh"></div>


<!-- InstanceEnd --></html>
@endsection
