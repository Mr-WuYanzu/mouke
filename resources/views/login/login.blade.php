<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <script src="{{asset('js/jquery-1.8.0.min.js')}}"></script>
    <script src="{{asset('layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/rev-setting-1.js')}}"></script>
    <script type="text/javascript" src="{{asset('rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/tab.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}" id="main-css">
    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>
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
            <li><a href="/item_bank" class="link1" >题库</a></li>
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

                 <a class="tkbtn tkreg" href="/register">注册</a>



        <!--登录后-->




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




<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url(/images/12.jpg) right center no-repeat #fff">
<h2>登录</h2>
<form  onsubmit="return check();" method="post" style="width:600px">
<input type="hidden" value="{{csrf_token()}}" id="_token">
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">帐号</label>
    <input type="text" name="user_info" style="margin-top:25px;">
    </p>
    <span class="text-danger">请输入Email地址 / 用户昵称</span>
</div>
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">密码</label>
    <input type="password" name="pwd" style="margin-top:25px;">
    </p>
    <p class="help-block"><span class="text-danger">请输入密码</span></p>
</div>
<div class="loginbtn">
	<label><input type="checkbox"  checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
    <button type="button" id="btn" class="uploadbtn ub1">登录</button>
    
</div>
<div class="loginbtn lb">
   <a href="#" class="link-muted">还没有账号？立即免费注册</a>
   <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>   
   <a href="/getpwd" class="link-muted">找回密码</a>
</div>
</form>
<div class="hezuologo">
    <span class="hezuo">使用合作网站账号登录</span>
    <div class="hezuoimg">
    <img src="images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40"/>
        {{----}}
    <a href="https://api.weibo.com/oauth2/authorize?client_id=2961575350&response_type=code&redirect_uri=http://education.com/callback">
        <img src="images/hezuowb.png" class="hzwb" id="weibo" title="微博" width="40" height="40"/>
    </a>
    </div>
    
  </div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>


<div class="foot">
    <div class="fcontainer">
        <div class="fwxwb">
            <div class="fwxwb_1">
                <span>关注微信</span><img width="95" alt="" src="{{asset('images/num.png')}}">
            </div>
            <div>
                <span>关注微博</span><img width="95" alt="" src="{{asset('images/wb.png')}}">
            </div>
        </div>
        <div class="fmenu">
            <p><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">优秀讲师</a> | <a href="#">帮助中心</a> | <a href="#">意见反馈</a> | <a href="#">加入我们</a></p>
        </div>
        <div class="copyright">
            <div><a href="/">谋刻网</a>所有&nbsp;晋ICP备12006957号-9</div>
        </div>
    </div>
</div>


<!--右侧浮动-->
<div class="rmbar">
	<span class="barico qq" style="position:relative">
	<div  class="showqq">
	   <p>官方客服QQ:<br>335049335</p>
	</div>
	</span>
    <span class="barico em" style="position:relative">
	  <img src="{{asset('images/num.png')}}" width="75" class="showem">
	</span>
    <span class="barico wb" style="position:relative">
	  <img src="{{asset('images/wb.png')}}" width="75" class="showwb">
	</span>
    <span class="barico top" id="top">置顶</span>
</div>

<script>
    function logmine(){
        document.getElementById("lne").style.display="block";
    }
    function logclose(){
        document.getElementById("lne").style.display="none";
    }

    /*右侧客服飘窗*/
    $(".label_pa li").click(function() {
        $(this).siblings("li").find("span").css("background-color", "#fff").css("color", "#666");
        $(this).find("span").css("background", "#fb5e55").css("color", "#fff");
    });
    $(".em").hover(function() {
        $(".showem").toggle();
    });
    $(".qq").hover(function() {
        $(".showqq").toggle();
    });
    $(".wb").hover(function() {
        $(".showwb").toggle();
    });
    $("#top").click(function() {
        if (scroll == "off") return;
        $("html,body").animate({
                scrollTop: 0
            },
            600);
    });
</script>

</body>
</html>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/layui/layui.js"></script>
<script src="/layui/css/layui.css"></script>

<script>
    $(function(){
        layui.use(['layer'],function(){
            var layer = layui.layer;

            $("#btn").click(function(){
                var user_info = $("input[name='user_info']").val();
                var _token = $("#_token").val();
                var pwd = $("input[name='pwd']").val();
                // console.log(pwd);
                var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
                var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
                var reg_pwd = /^[\dA-Za-z_]{5,20}$/;

                var res = user_info.search('@') != -1;
                // console.log(res);
                if(res == true){
                    if(user_info == ''){
                        layer.msg('邮箱必填',{icon:2});
                        return false;
                    }else if(!reg_mail.test(user_info)){
                        layer.msg('您的邮箱格式不正确',{icon:2});
                        return false;
                    }
                }else{
                    if(user_info == ''){
                        layer.msg('用户名或邮箱必填',{icon:2});
                        return false;
                    }else if(!reg_name.test(user_info)){
                        layer.msg('中、英文均可，最长14个英文或7个汉字',{icon:2});
                        return false;
                    }
                }

                if(pwd == ''){
                    layer.msg('密码必填',{icon:7});
                    return false;
                }else if(!reg_pwd.test(pwd)){
                    layer.msg('密码由5-20位数字字母下划线组成',{icon:7});
                    return false;
                }        

                $.post(
                    '/logindo',
                    {_token:_token,user_info:user_info,pwd:pwd},
                    function(res){
                        //200登陆成功 
                        //401冷登录失败 
                        //402 邮箱或用户名不存在  
                        //301 账号或密码错误您还有两次机会 
                        //302 账号已锁定请在规定时间后访问 
                        //303 账号已锁定请在规定时间后访问
                        //304 账号已锁定请在一小时后登录
                        //305 账号已锁定您剩余多少次机会
                        // console.log(res);
                        var code = res.code;
                        if(code == 200){
                            layer.msg(res.msg,{icon:6},function(){
                                location.href = "{{url('/index')}}";
                            })
                        }else if(code == 401){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 402){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 301){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 302){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 303){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 304){
                            layer.msg(res.msg,{icon:2});
                        }else if(code == 305){
                            layer.msg(res.msg,{icon:2});
                        }else if(res == 1){
                            layer.msg('密码错误！',{icon:2})
                        }else if(res == 2){
                            layer.msg('登陆成功，即将进入主页！',{icon:6},function(){
                                location.href = "{{url('/index')}}";
                            })
                        }else if(res == 3){
                            layer.msg('用户名不存在！',{icon:7})
                        }
                    }
                )


            })

            function check(){
                // 验证表单数据是否符合条件，不符合返回false禁止提交
                return false;
            }   
        })
    })
</script>