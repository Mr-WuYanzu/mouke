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





<form onsubmit="return check();" method="post">
    <input type="hidden" value="{{csrf_token()}}" id="_token">
    <div>
        <p class="formrow">
            <label class="control-label" for="register_email">邮箱地址</label>
            <input type="text" name='user_mail'>
            <span class="text-danger">请输入邮箱地址</span>
        </p>
    </div>

    <div>
        <p class="formrow"><label class="control-label" for="register_email">昵称</label>
            <input type="text" name='user_name' id='name'>
            <span class="text-danger">该怎么称呼你？ 中、英文均可，最长14个英文或7个汉字</span>
        </p>
    </div>

    <div>
        <p class="formrow">
            <label class="control-label" for="register_email">密码</label>
            <input type="password" name='pwd' name='pwd'>
            <span class="text-danger">5-20位英文、数字、符号，区分大小写</span>
        </p>
    </div>

    <div>
        <p class="formrow"><label class="control-label" for="register_email">确认密码</label>
            <input type="password" name='pwd1' id='pwd1'>
            <span class="text-danger">再输入一次密码</span>
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
<script src="/layui/css/layui.css"></script>
<script>

$(function(){
    layui.use(['layer'],function(){
        var layer = layui.layer;
        /*
            $("input[name='user_mail']").blur(function(){
                var user_mail = $(this).val();
                var reg_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
                if(user_mail == ''){
                    layer.msg('邮箱必填',{icon:2});
                    return false;
                }else if(!reg.test(user_mail)){
                    layer.msg('您的邮箱格式不正确',{icon:2});
                    return false;
                }
            })
            //用户性验证
            $("input[name='user_name']").blur(function(){
                var user_name = $("input[name='user_name']").val();
                var reg_name = /^[\u4e00-\u9fa5]{1,7}$|^[\dA-Za-z_]{1,14}$/;
                if(user_name == ''){
                    layer.msg('用户名必填',{icon:2});
                    return false;
                }else if(!reg.test(user_name)){
                    layer.msg('请注意查看用户名规则',{icon:7});
                    return false;
                }
            })
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
                    }else if(res == 4){
                        layer.msg('用户名已存在',{icon:7});
                    }else if(res == 5){
                        layer.msg('邮箱已被注册',{icon:7});
                    }
                }
            )
        
        })
        return false;
    })

    function check(){
        // 验证表单数据是否符合条件，不符合返回false禁止提交
        return false;
    }
   
})

</script>