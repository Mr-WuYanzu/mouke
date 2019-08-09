@extends('layouts.layouts')

@section('title','登录')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url(images/12.jpg) right center no-repeat #fff">
<h2>重置密码</h2>
<div>
    <p class="formrow">
        <input type="hidden" id="mail" value="{{$user_mail}}">
        <input type="hidden" id="data" value="{{$data}}">
    <label class="control-label" for="register_email">密码</label>
    <input type="password" id="pwd">
    </p>
    <span class="text-danger">请输入新的密码</span>
</div>
<div class="loginbtn">
    <button type="submit" class="uploadbtn ub1" id="sub">确定修改</button>
    
</div>
</div>
<!-- InstanceEndEditable -->
<script>
    $('#sub').click(function () {
        var mail = $('#mail').val();
        var data = $('#data').val();
        var pwd = $('#pwd').val();
        $.ajax({
            url:'/setpwd',
            type:'post',
            data:{user_mail:mail,data:data,pwd:pwd},
            success:function (res) {
                alert(res.msg);
                if(res.status==200){
                    location.href="/login";
                }
            }
        })
    })
</script>

<div class="clearh"></div>

@endsection