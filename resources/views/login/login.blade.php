@extends('layouts.layouts')

@section('title','登录')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url(/images/12.jpg) right center no-repeat #fff">
<h2>登录</h2>
<form  onsubmit="return check();" method="post" style="width:600px">
<input type="hidden" value="{{csrf_token()}}" id="_token">
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">帐号</label>
    <input type="text" name="user_info">
    </p>
    <span class="text-danger">请输入Email地址 / 用户昵称</span>
</div>
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">密码</label>
    <input type="password" name="pwd">
    </p>
    <p class="help-block"><span class="text-danger">密码错误</span></p>
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
    <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40"/>
    </div>
    
  </div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection

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