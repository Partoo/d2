@extends('emails/layouts/default')

@section('content')
<p>您好 {{ $user->username }},</p>

<p>您刚刚通过系统提交了更改密码的请求，请点击下面链接完成操作。（部分邮箱不支持HTML语法，如果无法点击，请将下面的地址复制到浏览器地址栏中访问即可。）</p>

<p><a href="{{ $forgotPasswordUrl }}">{{ $forgotPasswordUrl }}</a></p>

<p>祝您 顺利</p>

<p>{{Config::get('site.siteName')}}</p>
@stop
