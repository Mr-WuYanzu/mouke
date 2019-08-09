@extends('layouts.layouts')

@section('title','找回密码')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url(images/12.jpg) right center no-repeat #fff">
<h2>找回密码</h2>

{{--<form style="width:600px" onsubmit="false">--}}
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">帐号</label>
    <input type="text"  id="email">
    </p>
    <span class="text-danger">请输入Email地址</span>
</div>

<div class="loginbtn">
    <button type="submit" class="uploadbtn ub1" id="sub">确定</button>

</div>

{{--</form>--}}

</div>
<!-- InstanceEndEditable -->
<script>
    $('#sub').click(function () {
        var email = $('#email').val();
        $.ajax({
            url:'/getpwdDo',
            type:'post',
            data:{email:email},
            dataType:'json',
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