<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title')</title>

<script src="{{asset('js/jquery-1.8.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/rev-setting-1.js')}}"></script>
<script type="text/javascript" src="{{asset('rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/tab.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}" id="main-css">
<!--课程选项卡-->
<script type="text/javascript">
function nTabs(thisObj,Num){
    if(thisObj.className == "current")return;
    var tabObj = thisObj.parentNode.id;
    var tabList = document.getElementById(tabObj).getElementsByTagName("li");
    for(i=0; i <tabList.length; i++)
        {
        if (i == Num)
        {
           thisObj.className = "current"; 
           document.getElementById(tabObj+"_Content"+i).style.display = "block";
        }else{
           tabList[i].className = "normal"; 
           document.getElementById(tabObj+"_Content"+i).style.display = "none";
        }
        } 
}


</script>


</head>

<body>

<div class="head" id="fixed">
    <div class="nav">
        <span class="navimg"><a href="/index"><img border="0" src="{{asset('images/logo.png')}}"></a></span>
        <ul class="nag">
            <li><a href="/curr/currlist" class="link1">课程</a></li>
            <li><a href="/article/articlelist" class="link1">资讯</a></li>
            <li><a href="/teacher/teacherlist" class="link1">讲师</a></li>
            <li><a href="exam_index.html" class="link1" target="_blank">题库</a></li>
            <li><a href="askarea.html" class="link1" target="_blank">问答</a></li>
        </ul>
        
        <span class="massage">
        <!--<span class="select">
            <a href="#" class="sort">课程</a>
            <input type="text" value="关键字"/>
            <a href="#" class="sellink"></a>
            <span class="sortext">
                <p>课程</p>
                <p>题库</p>
                <p>讲师</p>
            </span>
        </span>-->

        <!--未登录-->
            <span class="exambtn_lore">
                 <a class="tkbtn tklog" href="/login">登录</a>
                 <a class="tkbtn tkreg" href="/register">注册</a>
            </span>
            <!--登录后-->
            <!--<div class="logined">
                <a href="mycourse.html"  onMouseOver="logmine()" style="width:70px" class="link2 he ico" target="_blank">sherley</a>
                <span id="lne" style="display:none" onMouseOut="logclose()" onMouseOver="logmine()">
                    <span style="background:#fff;">
                        <a href="mycourse.html" style="width:70px; display:block;" class="link2 he ico" target="_blank">sherley</a>
                    </span>
                    <div class="clearh"></div>
                    <ul class="logmine" >
                        <li><a class="link1" href="#">我的课程</a></li>
                        <li><a class="link1" href="#">我的题库</a></li>
                        <li><a class="link1" href="#">我的问答</a></li>
                        <li><a class="link1" href="#">退出</a></li>
                    </ul>
                </span>
            </div>-->
            
            
            
            <!-- <a href="mycourse.html"  onMouseOver="logmine()" style="width:70px" class="link2 he ico" target="_blank">sherley</a>
            <span id="lne" style="display:none" onMouseOut="logclose()" onMouseOver="logmine()">
                <span style="background:#fff;">
                    <a href="mycourse.html" style="width:70px; display:block;" class="link2 he ico" target="_blank">sherley</a>
                </span>
                <div class="clearh"></div>
                <ul class="logmine" >
                    <li><a class="link1" href="#">我的课程</a></li>
                    <li><a class="link1" href="#">我的题库</a></li>
                    <li><a class="link1" href="#">我的问答</a></li>
                    <li><a class="link1" href="#">退出</a></li>
                </ul>
            </span> -->
        </span>
    </div>
</div>
