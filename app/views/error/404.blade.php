@extends('_layouts.login_general')
@section('content')

    <body>
    <div class="error-wrap error-wrap-404">
        <div class="metro big alpha_terques">
           <span> <i class="icon-frown"></i> </span>
        </div>
        <div class="metro alpha_purple">
            <span> 4 </span>
        </div>
        <div class="metro alpha_yellow">
            <span> 0 </span>
        </div>
        <div class="metro alpha_red">
            <span> 4 </span>
        </div>
        <div class="metro double alpha_green">
            <span class="page-txt"> 该页不存在 </span>
        </div>
        <div class="metro alpha_gray">
            <a href="{{url('/')}}" class="home"><i class="icon-home"></i> </a>
        </div>

    </div>
</body>

@stop