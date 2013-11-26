@extends('emails/layouts/default')

@section('content')
<p>您好， {{ $user->username }}！</p>

<p>这是来自{{Config::get('site.siteName')}}的邮箱验证邮件。您刚刚在系统中注册了该邮箱地址，激活该账号只需要点击下面的链接。（部分邮箱可能不支持html语法，如链接地址无法点击，请将其复制到浏览器地址栏中访问）
</p>

<p><a href="{{ $activationUrl }}">{{ $activationUrl }}</a></p>

<p>顺祝 近祺！</p>

@stop
