@extends('_layouts.login_general')

@section('content')
<div class="login-container">
   <div class="login-header blue">
    <h4><i class="icon-magic"></i>  更改密码 </h4>
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
    {{Form::submit('更改密码', array('class'=>'btn-block btn-danger btn-large'))}}
</div>
{{Form::close()}}

<div class="row-fluid">

    <div class="pull-right">
        <a href="{{route('signUp')}}" role="button" data-toggle="modal">注册用户</a>
    </div>
    <div class="span6">
        <a href="{{route('login')}}" role="button" data-toggle="modal">已有账号登录</a>
    </div>
</div>


</div>
<!-- START MOBILE AUTHCODE JS -->


@stop

