@extends('_layouts.login_general')
@section('content')

    <body>
    <div class="error-wrap error-wrap-404">
        <div class="metro big alpha_terques">
           <span> <i class="icon-wrench"></i> </span>
        </div>
        <div class="metro alpha_purple">
            <span> 维 </span>
        </div>
        <div class="metro alpha_yellow">
            <span> 护 </span>
        </div>
        <div class="metro alpha_red">
            <span> 中 </span>
        </div>
        <div class="metro double alpha_green">
            <span class="page-txt"> 管理员电话:{{Config::get('site.siteAdminPhone')}} </span>
        </div>
        <div class="metro alpha_gray">
            <a href="{{url('/')}}" class="home"><i class="icon-home"></i> </a>
        </div>

    </div>
</body>

@stop