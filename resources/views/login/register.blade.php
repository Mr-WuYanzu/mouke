@extends('layouts.layouts')

@section('title','注册')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
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




@endsection


<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/layui/layui.js"></script>
<!-- <script src="/layui/css/layui.css"></script> -->
<script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
<script>

$(function(){
    layui.use(['layer'],function(){
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

            $("input[name='user_mail']").blur(function(){
                var user_mail = $(this).val();
                var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
                $.post(
                    '/checkmail',
                    {user_mail:user_mail},
                    function (res) {
                        // console.log(res);
                        if(res.code==300){
                            layer.msg(res.msg,{icon:7});
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
        $("#btn").click(function(){
            var _token = $("#_token").val();
            var user_mail = $("input[name='user_mail']").val();
            var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
            var user_name = $("input[name='user_name']").val();
            var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
            var pwd = $("input[name='pwd']").val();
            var reg_pwd = /^[\dA-Za-z_]{5,20}$/;
            var pwd1 = $("input[name='pwd1']").val();

            if(user_mail == ''){
                layer.msg('邮箱必填',{icon:2});
                return false;
            }else if(!reg_mail.test(user_mail)){
                layer.msg('您的邮箱格式不正确',{icon:2});
                return false;
            }

            if(user_name == ''){
                layer.msg('用户名必填',{icon:2});
                return false;
            }else if(!reg_name.test(user_name)){
                layer.msg('请注意查看用户名规则',{icon:7});
                return false;
            }

            if(pwd == ''){
                layer.msg('密码必填',{icon:7});
                return false;
            }else if(!reg_pwd.test(pwd)){
                layer.msg('请注意查看密码规则',{icon:7});
                return false;
                
            }        

            if(pwd1 == ''){
                layer.msg('确认密码必填',{icon:7});
                return false;
            }else if(!reg_pwd.test(pwd)){
                layer.msg('请注意查看密码规则',{icon:7});
                return false;
            }else if(pwd1 != pwd){
                layer.msg('两次密码不一致！',{icon:2});
                return false;
            }

            if(_flag==''){
                layer.msg('请先验证',{icon:5,time:1000});
                return false;
            }


            $.post(
                '/registerdo',
                {user_mail:user_mail,user_name:user_name,pwd:pwd,pwd1:pwd1,_token:_token},
                function(res){
                    if(res == 1){
                        layer.msg('注册成功，即将跳转登陆页面',{icon:6},function(){
                            location.href="{{url('/login')}}";
                        });
                    }else if(res == 2){
                        layer.msg('注册失败',{icon:2});
                    }else if(res == 3){
                        layer.msg('两次密码不一致！',{icon:7});
                    }
                }
            )
            return false;
        });

        function check(){
            // 验证表单数据是否符合条件，不符合返回false禁止提交
            return false;
        }
        
    });
});

</script>