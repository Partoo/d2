@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
@stop
@section('pageTitle')
<i class="icon-gear"></i>  参数设置
@stop
@section('breadcrumb')
     {{ Breadcrumbs::render('document') }}
@stop
@section('content')

<div class="row-fluid">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-gear"></i> 参数设置</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                            </div>
                            <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="metro-nav">
                                    <div class="metro-nav-block nav-block-orange">
                                        <a data-original-title class="text-center" href="{{route('param/category')}}">
                                            <i class="icon-tags"></i>
                                            <div class="status">公文类别</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-yellow">
                                        <a data-original-title class="text-center" href="{{route('param/unit')}}">
                                            <i class="icon-sitemap"></i>
                                            <div class="status">发文单位</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-green">
                                        <a data-original-title class="text-center" href="{{route('param/priority')}}">
                                            <i class="icon-exclamation-sign"></i>
                                            <div class="status">紧急程度</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-blue">
                                        <a data-original-title class="text-center" href="{{route('param/seclevel')}}">
                                            <i class="icon-key"></i>
                                            <div class="status">机密等级</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-red">
                                        <a data-original-title class="text-center" href="{{route('param/statement')}}">
                                            <i class="icon-quote-right"></i>
                                            <div class="status">常用语</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-grey">
                                        <a data-original-title class="text-center" href="{{route('param/action')}}">
                                            <i class="icon-meh"></i>
                                            <div class="status">情态动词</div>
                                        </a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <!--END METRO STATES-->
                            </div>
                        </div>
                    </div>
                </div>


@section('myjs')
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
@stop
@stop