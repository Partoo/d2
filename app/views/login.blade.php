@extends('_layouts.login_general')
    @section('content')
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="index.html">
            <img class="center" alt="logo" src="{{asset('img/logo.png')}}">
        </a>
        <!-- END LOGO -->
    </div>
    <div class="login-wrap">
            @if ($errors->has('login'))
                <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
            @endif
        <div class="metro single-size alpha_red">
            <div class="locked">
                <i class="icon-lock"></i>
            </div>
        </div>
        {{Form::open()}}
        <div class="metro double-size alpha_green">
                <div class="input-append lock-input">
                     {{Form::text('username', '', array('placeholder'=>'输入邮箱/手机登录'))}}
                </div>
        </div>
        <div class="metro double-size alpha_yellow">
                <div class="input-append lock-input">
                     {{Form::password('password', array('placeholder'=>'请输入您的密码'))}}
                </div>
        </div>
        <div class="metro single-size alpha_terques login">
            {{Form::submit('登录', array('class'=>'btn login-btn'))}}
        </div>
        <div class="metro double-size alpha_navy-blue ">
            <a href="{{route('mobileSignUp')}}" class="social-link">
                <i class="icon-mobile-phone"></i>
                <span>使用我的手机注册</span>
            </a>
        </div>
        <div class="metro double-size alpha_deep-red">
            <a href="{{route('signUp')}}" class="social-link">
                <i class="icon-envelope"></i>
                <span>使用我的邮箱注册</span>
            </a>
        </div>
        <div class="metro single-size alpha_blue">
            <a href="{{route('forgot-password')}}" class="social-link">
                <i class="icon-key"></i>
                <span>忘记密码？</span>
            </a>
        </div>
        <div class="metro single-size alpha_purple">
            <a href="{{url('help')}}" class="social-link">
                <i class="icon-question-sign"></i>
                <span>获取帮助</span>
            </a>
        </div>
        <div class="login-footer">
            <div class="remember-hint pull-left">
            <label>
                            <input type="checkbox" name="remember-me" id="remember-me" /> 记住登录
             </label>
            </div>

        </div>
        <div class="alert alert-error" id="remember-tip"><i class=" icon-exclamation-sign"></i>  请不要在公共场合使用此功能</div>
    </div>
            {{Form::close()}}
@stop