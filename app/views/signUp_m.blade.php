@extends('_layouts.login_general')
<!-- get config file to check signup status -->
@if( Config::get('site.signup_enable'))
<?php $key = md5(Session::get('mcode'))?>
@section('content')
<div class="login-container">
 <div class="login-header blue">
    <h4><i class="icon-user"></i>  注册用户 </h4>
    <!-- **********测试用 -->
    <!-- <div>{{Session::get('mcode')}}</div> -->
    <!-- ***************** -->
</div>
{{Form::open()}}

<!-- Email -->

@if ($errors->has('phone'))
<div class="alert alert-error">{{ $errors->first('phone', ':message') }}</div>
@elseif($errors->has('username'))
<div class="alert alert-error">{{ $errors->first('username', ':message') }}</div>
@elseif($errors->has('password'))
<div class="alert alert-error">{{ $errors->first('password', ':message') }}</div>
@elseif($errors->has('re-password'))
<div class="alert alert-error">{{ $errors->first('re-password', ':message') }}</div>
@elseif($errors->has('authCode'))
<div class="alert alert-error">{{ $errors->first('authCode', ':message') }}</div>
@endif
<!-- START MOBILE -->
<div class="control-group{{ $errors->first('phone', ' error') }}">
    <div class="login-field input-prepend">
        <span class="add-on"><i class="icon-mobile-phone"></i></span>
        {{Form::text('phone', '', array('placeholder'=>'请输入您的手机号码','id'=>'mobileNum'))}}
        {{Form::hidden('key',$key,array('id'=>'key'))}}
    </div>
</div>

<div class="login-field">
    或者您可以<a href="{{route('signUp')}}">用邮箱注册</a>
</div>
<!-- START USERNAME -->
<div class="control-group{{ $errors->first('username', ' error') }}">
    <div class="login-field input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
        {{Form::text('username', '', array('placeholder'=>'请输入您的真实姓名'))}}
    </div>
</div>
<!-- START PASSWORD -->
<div class="control-group{{ $errors->first('password', ' error') }}">
    <div class="login-field input-prepend">
        <span class="add-on"><i class="icon-lock"></i></span>
        {{Form::password('password', array('placeholder'=>'请输入您的密码'))}}
    </div>
</div>
<!-- START RE-PASSWORD -->
<div class="control-group{{ $errors->first('re-password', ' error') }}">
    <div class="login-field input-prepend">
        <span class="add-on"><i class="icon-external-link"></i></span>
        {{Form::password('re-password', array('placeholder'=>'请再次输入密码以便确认'))}}
    </div>
</div>
<!-- START MOBILE AUTHCODE -->
<div class="control-group{{ $errors->first('authCode', ' error') }}">
    <div class="login-field input-prepend">
        {{Form::input('button', 'authTrigger', '发送短信', array('id'=>'authTrigger','class'=>'btn btn-success'))}}
        {{Form::text('authCode', '', array('placeholder'=>'输入收到的验证码','class'=>'input-medium'))}}
    </div>
    <div class="alert alert-error" id="remember-tip"><i class=" icon-exclamation-sign"></i>您的手机号码格式不正确</div>
</div>
<div id="showKey"></div>
<div class="login-button">
    {{Form::submit('立即注册', array('class'=>'btn-block btn-danger btn-large'))}}
</div>
{{Form::close()}}

<div class="row-fluid">

    <div class="pull-right">
        <a href="{{route('forgot-password')}}" role="button" data-toggle="modal">忘记密码?</a>
    </div>
    <div class="span6">
        <a href="{{route('login')}}" role="button" data-toggle="modal">已有账号登录</a>
    </div>
</div>


</div>
<!-- START MOBILE AUTHCODE JS -->
@section('myjs')
<script>

$(document).ready(function(){
    var InterValObj;
    var count = 60;
    var curCount;

    function SetRemainTime() {
        if (curCount == 0) {
                                    window.clearInterval(InterValObj);//停止计时器
                                    $("#authTrigger").removeAttr("disabled");//启用按钮
                                    $("#authTrigger").val("获取短信");
                                }
                                else {
                                    curCount--;
                                    $("#authTrigger").val("请等"+curCount + "秒");
                                }
                            }

                            $('#authTrigger').click(function() {
                                var num = $('#mobileNum').attr('value');
                                var reg = /^0{0,1}(13[0-9]|145|147|15[0-3]|15[5-9]|18[0-9])[0-9]{8}$|^$/;
                                var str = num;
                                var key = $('#key').val();
                                var result = reg.exec(str);
                                if (result == null) {
                                    $('#remember-tip').html('您的手机号码格式不正确');
                                    $('#remember-tip').slideDown();
                                } else if(str==''){
                                    $('#remember-tip').html('您未填写手机号码');
                                    $('#remember-tip').slideDown();
                                }
                                else{
                                    $('#remember-tip').slideUp();
                                    curCount = count;
                                    $("#authTrigger").val("请等"+curCount + "秒");
                                    $("#authTrigger").attr("disabled", "true");
                                    InterValObj = window.setInterval(SetRemainTime, 1000);

                                    $.ajax({
                                      type: "POST",
                                      url: '{{url('sendSms')}}',
                                      data: {'key': key,'num':num},
                                      dataType: 'text',
                                      success: function(data, textStatus) {
                                        if (data.indexOf('1')==-1) {
                                            $("#showKey").html('发送失败,错误代码:'+data).addClass('alert alert-error');
                                        }else{
                                            $("#showKey").html('发送成功').addClass('alert alert-success');
                                        };
                                    }
                                });

                                }

                            });
})
</script>
@stop

@stop

<!-- START SIGNUP_DISABALED -->
@else
@section('content')
@include('_layouts.signup_disabled')
@stop

@endif
