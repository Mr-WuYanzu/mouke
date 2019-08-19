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
                <li class="currnav"><a class="mb1 curr" href="javascript:void(0);">我的课程</a></li>
                <li><a class="mb3 collect" href="javascript:void(0);">我的收藏</a></li>
                <li><a class="mb4 subscribe" href="javascript:void(0);">我的订阅</a></li>
                <li><a class="mb12" href="myhomework.html">我的订单</a></li>
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

            $.get(
                '/user/getCurr',
                function(res){
                    if(res.code==2){
                        $('.membcont').html('');
                    }else{
                        $('.membcont').html(res);
                    }
                }
            )

            //我的课程页面
            $('.curr').click(function(){
                $(this).parent('li').prop('class','currnav');
                $(this).parent('li').siblings('li').prop('class','');

                $.get(
                    '/user/getCurr',
                    function(res){
                        if(res.code==2){
                            $('.membcont').html();
                        }else{
                            $('.membcont').html(res);
                        }
                    }
                )
            });

            //我的收藏页面
            $('.collect').click(function(){
                $(this).parent('li').prop('class','currnav');
                $(this).parent('li').siblings('li').prop('class','');

                $.get(
                    '/user/collect',
                    function(res){
                        if(res.code==2){
                            layer.msg(res.font,{icon:res.skin,time:1000});
                        }else{
                           $('.membcont').html(res); 
                        }
                    }
                )
            });

            //我的订阅页面
            $('.subscribe').click(function(){
                $(this).parent('li').prop('class','currnav');
                $(this).parent('li').siblings('li').prop('class','');

                $.get(
                    '/user/subscribe',
                    function(res){
                        if(res.code==2){
                            layer.msg(res.font,{icon:res.skin,time:1000});
                        }else{
                           $('.membcont').html(res); 
                        }
                    },
                )
            });
        });
    });
</script>

<!-- InstanceEnd --></html>
@endsection
