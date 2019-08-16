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


                <span class="exambtn_lore">
                 <a class="tkbtn tklog" href="/login">登录</a>

                </span>
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


<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="/css/register-login.css"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="register" style="background:url(images/13.jpg) right center no-repeat #fff">
    <h2>注册</h2>





    <form onsubmit="return check();" method="post" >
        <input type="hidden" value="{{csrf_token()}}" id="_token">
        <div>
            <p class="formrow" style="">
                <label class="control-label" for="register_email">邮箱地址</label>

                <input type="text" name='user_mail' style="margin-top:25px;">

            <div class="text-danger">请输入邮箱地址</div>


            </p>
            <input type="text" name='code'><button type="button" class="uploadbtn" id="code">获取验证码</button>
        </div>

        <div>
            <p class="formrow"><label class="control-label" for="register_email">昵称</label>
                <input type="text" name='user_name' id='name' style="margin-top:25px;">
            <div class="text-danger">该怎么称呼你？ 中、英文均可，最长14个英文或7个汉字</div>
            </p>
        </div>

        <div>
            <p class="formrow">
                <label class="control-label" for="register_email">密码</label>
                <input type="password" name='pwd' name='pwd' style="margin-top:25px;">
            <div class="text-danger">5-20位英文、数字、符号，区分大小写</div>
            </p>
        </div>

        <div>
            <p class="formrow"><label class="control-label" for="register_email">确认密码</label>
                <input type="password" name='pwd1' id='pwd1' style="margin-top:25px;">
            <div class="text-danger">再输入一次密码</div>
            </p>
        </div>

        <div>
            <p class="formrow"><label style="margin-top:50px;" class="control-label" for="register_email">验证码</label>
            <div style="margin-left:130px;" id="captcha"></div>
            </p>
        </div>


        <div class="loginbtn reg">
            <button type="button" class="uploadbtn ub1" id="btn">注册</button>
        </div>

    </form>
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
<!-- <script src="/layui/css/layui.css"></script> -->
<script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
<script>

    $(function() {
        layui.use(['layer'], function () {
                var layer = layui.layer;
                var _flag='';

                //验证码配置
                var myCaptcha = _dx.Captcha(document.getElementById('captcha'), {
                    appId: '32bd9936974b7a6949e648464efca3da', //appId，在控制台中“应用管理”或“应用配置”模块获取
                    style:'inline', //验证码样式
                    // language:'en', //语言
                    width:300, //宽度
                    success: function (token) {
                        _flag=token;
                        // console.log('token:', token)
                    }
                });

                $("input[name='user_mail']").blur(function () {
                    // alert(123123132);
                    var user_mail = $(this).val();
                    // console.log(user_mail);
                    var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
                    $.post(
                        '/checkmail',
                        {user_mail: user_mail},
                        function (res) {
                            // console.log(res);
                            if (res == 1) {
                                layer.msg('邮箱已存在！', {icon: 7});
                            }
                        }
                    )
                });

                //用户性验证
                $("input[name='user_name']").blur(function(){
                    var user_name = $("input[name='user_name']").val();
                    var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
                    if(user_name == ''){
                        layer.msg('用户名必填',{icon:2});
                        return false;
                    }else if(!reg_name.test(user_name)){
                        layer.msg('请注意查看用户名规则',{icon:7});
                        return false;
                    }else{
                        $.post(
                            '/checkname',
                            {user_name:user_name},
                            function (res) {
                                // console.log(res);
                                if(res.code==300){
                                    layer.msg(res.msg,{icon:7});
                                }
                            }
                        )
                    }
                });



                $("#code").click(function () {
                    var user_mail = $("input[name='user_mail']").val();
                    if(user_mail == ''){
                        layer.msg('邮箱必填',{icon:7});
                    }
                    // alert(user_mail);
                    $.post(
                        '/email',
                        {user_mail:user_mail},
                        function(res){
                            // console.log(res)
                            if(res.code == 1){
                                layer.msg(res.msg,{icon:6});
                            }else if(res.code==2){
                                layer,msg(res.msg,{icon:7});
                            }else if(res.code == 3){
                                layer.msg(res.msg,{icon:7});
                            }
                        }
                    )
                });

                $("input[name='code']").blur(function () {
                    // alert(123123123);
                    var code = $(this).val();
                    if(code == ''){
                        layer.msg('验证码必填',{icon:7});
                    }
                    $.post(
                        '/checkcode',
                        {code:code},
                        function (res) {
                            // console.log(res);
                            if(res.code == 1){
                                layer.msg('res.msg',{icon:6});
                            }else if(res.code==2){
                                layer,msg('res.msg',{icon:7});
                            }
                        }
                    )
                })

                //用户性验证
                $("input[name='user_name']").blur(function () {
                    var user_name = $("input[name='user_name']").val();
                    var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
                    if (user_name == '') {
                        layer.msg('用户名必填', {icon: 2});
                        return false;
                    } else if (!reg_name.test(user_name)) {
                        layer.msg('请注意查看用户名规则', {icon: 7});
                        return false;
                    }
                    $.post(
                        '/checkname',
                        {user_name: user_name},
                        function (res) {
                            // console.log(res);
                            if (res.code == 300) {
                                layer.msg(res.msg, {icon: 7});
                            }
                        }
                    )
                });

                /*
                    //密码验证
                    $("input[name='pwd']").blur(function(){
                        var pwd = $("input[name='pwd']").val();
                        var reg_pwd = /^[\dA-Za-z_]{5,20}$/;
                        if(pwd == ''){
                            layer.msg('密码必填',{icon:7});
                            return false;
                        }else if(!reg.test(pwd)){
                            layer.msg('请注意查看密码规则',{icon:7});
                            return false;

                        }
                    })
                    //二次密码验证
                    $("input[name='pwd1']").blur(function(){
                        var pwd1 = $("input[name='pwd1']").val();
                        var pwd = $("input[name='pwd']").val();
                        var reg_pwd1 = /^[\dA-Za-z_]{5,20}$/;
                        if(pwd1 == ''){
                            layer.msg('密码必填',{icon:7});
                            return false;
                        }else if(!reg.test(pwd)){
                            layer.msg('请注意查看密码规则',{icon:7});
                            return false;
                        }else if(pwd1 != pwd){
                            layer.msg('两次密码不一致！',{icon:2});
                            return false;
                        }
                        // return true;

                    })
                */
                $("#btn").click(function () {
                    var _token = $("#_token").val();
                    var user_mail = $("input[name='user_mail']").val();
                    var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
                    var user_name = $("input[name='user_name']").val();
                    var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
                    var pwd = $("input[name='pwd']").val();
                    var reg_pwd = /^[\dA-Za-z_]{5,20}$/;
                    var pwd1 = $("input[name='pwd1']").   val();

                    if (user_mail == '') {
                        layer.msg('邮箱必填', {icon: 2});
                        return false;
                    } else if (!reg_mail.test(user_mail)) {
                        layer.msg('您的邮箱格式不正确', {icon: 2});
                        return false;
                    }

                    if (user_name == '') {
                        layer.msg('用户名必填', {icon: 2});
                        return false;
                    } else if (!reg_name.test(user_name)) {
                        layer.msg('请注意查看用户名规则', {icon: 7});
                        return false;
                    }

                    if (pwd == '') {
                        layer.msg('密码必填', {icon: 7});
                        return false;
                    } else if (!reg_pwd.test(pwd)) {
                        layer.msg('请注意查看密码规则', {icon: 7});
                        return false;

                    }

                    if (pwd1 == '') {
                        layer.msg('确认密码必填', {icon: 7});
                        return false;
                    } else if (!reg_pwd.test(pwd)) {
                        layer.msg('请注意查看密码规则', {icon: 7});
                        return false;
                    } else if (pwd1 != pwd) {
                        layer.msg('两次密码不一致！', {icon: 2});
                        return false;
                    }

                    if(_flag==''){
                        layer.msg('请先验证',{icon:5,time:1000});
                        return false;
                    }


                    $.post(
                        '/registerdo',
                        {user_mail: user_mail, user_name: user_name, pwd: pwd, pwd1: pwd1, _token: _token},
                        function (res) {
                            if (res == 1) {
                                layer.msg('注册成功，即将跳转登陆页面', {icon: 6}, function () {
                                    location.href = "{{url('/login')}}";
                                });
                            } else if (res == 2) {
                                layer.msg('注册失败', {icon: 2});
                            } else if (res == 3) {
                                layer.msg('两次密码不一致！', {icon: 7});
                            }
                        }
                    )
                    return false;
                });


                function check(){
                    // 验证表单数据是否符合条件，不符合返回false禁止提交
                    return false;
                }

            }
        )
    });

</script>