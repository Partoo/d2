@extends('_layouts.login_general')
<!-- get config file to check signup status -->
<?php $key = md5(Session::get('mcode'))?>
@section('content')
<div class="login-container">
 <div class="login-header blue">
    <h4><i class="icon-key"></i>  找回密码 </h4>
    <!-- **********测试用 -->
    <!-- <div>{{Session::get('mcode')}}</div> -->
    <!-- ***************** -->
</div>
@if ($errors->has('phone'))
<div class="alert alert-error">{{ $errors->first('phone', ':message') }}</div>
@elseif ($errors->has('email'))
<div class="alert alert-error">{{ $errors->first('email', ':message') }}</div>
@elseif($errors->has('authCode'))
<div class="alert alert-error">{{ $errors->first('authCode', ':message') }}</div>
@endif
{{Form::open()}}
<div class="accordion" id="accordion1">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" style="background-color:#777;color:#fff" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
                <i class="icon-asterisk"></i>  使用手机找回
            </a>
        </div>
        <div class="split5"></div>
        <div id="collapse_1" class="accordion-body in collapse" style="height: auto;">
            <div class="{{ $errors->first('phone', ' error') }} mtop10">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-mobile-phone"></i></span>
                    {{Form::text('phone', '', array('placeholder'=>'请输入您的手机号码','id'=>'mobileNum','class'=>'input-large'))}}
                    {{Form::hidden('key',$key,array('id'=>'key'))}}
                </div>
            </div>
            <div class="{{ $errors->first('authCode', ' error') }}">
                <div class="login-field input-prepend">
                    {{Form::input('button', 'authTrigger', '发送短信', array('id'=>'authTrigger','class'=>'btn btn-warning'))}}
                    {{Form::text('authCode', '', array('placeholder'=>'输入收到的验证码','class'=>'input-large'))}}
                </div>
                <div id="showKey"></div>
                <div class="alert alert-error" id="remember-tip"></div>
            </div>
            <div>
                {{Form::submit('下一步', array('class'=>'btn-block btn-danger btn-large'))}}
            </div>
        </div>
    </div>
    {{Form::close()}}
    {{Form::open(array('url'=>'forgot-password-mail'))}}

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" style="background-color:#777;color:#fff" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2">
                <i class="icon-asterisk"></i>  使用邮箱找回
            </a>
        </div>
        <div class="split5"></div>
        <div id="collapse_2" class="accordion-body collapse" style="height: 0px;">
            <div class="{{ $errors->first('email', ' error') }} mtop10">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope-alt"></i></span>
                    {{Form::text('email', '', array('placeholder'=>'请输入您的邮箱地址','id'=>'email','class'=>'input-large'))}}
                </div>
            </div>

            <div>
                {{Form::submit('下一步', array('class'=>'btn-block btn-danger btn-large'))}}
            </div>
        </div>

    </div>
    {{Form::close()}}
</div>
<div class="row-fluid">

    <div class="pull-right">
        <a href="{{url('signUp')}}" role="button" data-toggle="modal">注册账号</a>
    </div>
    <div class="span6">
        <a href="{{route('login')}}" role="button" data-toggle="modal">已有账号登录</a>
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
                                    $("#authTrigger").val(curCount + "秒后获取");
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
                                    $("#authTrigger").val(curCount + "秒后获取");
                                    $("#authTrigger").attr("disabled", "true");
                                    InterValObj = window.setInterval(SetRemainTime, 1000);



                                    $.ajaxSetup({
                                        url: '{{url('sendSms')}}',
                                        type: 'POST',
                                        dataType: 'text',
                                        data: {'key': key,'num':num},
                                        success: function(data, textStatus) {
                                            if (data.indexOf('1')==-1) {
                                                $("#showKey").html('发送失败,错误代码:'+data);
                                            }else{
                                                $("#showKey").html('发送成功')
                                            };
                                        }
                                    });
                                    $.post();
                                }

                            });
})
</script>
@stop

@stop

