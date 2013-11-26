@extends('_layouts.login_general')
<!-- get config file to check signup status -->
@if( Setting::get('site.signEnabled'))
@section('content')
   <div class="login-container">
             <div class="login-header blue">
                <h4><i class="icon-user"></i>  注册用户</h4>
        </div>
       {{Form::open()}}

<!-- Email -->
            @if ($errors->has('email'))
                <div class="alert alert-error">{{ $errors->first('email', ':message') }}</div>
            @elseif($errors->has('username'))
                <div class="alert alert-error">{{ $errors->first('username', ':message') }}</div>
            @elseif($errors->has('password'))
                <div class="alert alert-error">{{ $errors->first('password', ':message') }}</div>
            @elseif($errors->has('re-password'))
                <div class="alert alert-error">{{ $errors->first('re-password', ':message') }}</div>
            @endif
            <!-- START EMAIL -->
<div class="control-group{{ $errors->first('email', ' error') }}">
        <div class="login-field input-prepend">
            <span class="add-on"><i class="icon-envelope-alt"></i></span>
            {{Form::text('email', '', array('placeholder'=>'您的邮箱(不建议使用QQ邮箱)'))}}
        </div>
</div>

        <div class="login-field">
            或者您可以<a href="{{route('mobileSignUp')}}">用手机注册</a>
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

        <div class="login-button">
            {{Form::submit('立即注册', array('class'=>'btn-block btn-large btn-danger'))}}
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
    @stop

            <!-- START SIGNUP_DISABALED -->
        @else
        @section('content')
            @include('_layouts.signup_disabled')
        @stop
@endif

