@extends('_layouts.login_general')
@section('content')

    <body>
    <div class="error-wrap error-wrap-404">
        <div class="metro big alpha_terques">
           <span> <i class="icon-remove"></i> </span>
        </div>
        <div class="metro alpha_green">
            <span> 5 </span>
        </div>
        <div class="metro alpha_yellow">
            <span> 0 </span>
        </div>
        <div class="metro alpha_purple">
            <span> 0 </span>
        </div>
        <div class="metro double alpha_red">
            <span class="page-txt"> 您的访问方式不正确 </span>
        </div>
        <div class="metro gray">
            <a href="{{url('/')}}" class="home"><i class="icon-home"></i> </a>
        </div>

    </div>
</body>

@stop