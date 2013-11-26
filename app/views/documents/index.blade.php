@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/data-tables/DT_bootstrap.css')}}" />
@stop
@section('pageTitle')
<i class="icon-file-text"></i>  公文管理
@stop
@section('content')

<div class="row-fluid">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-th-large"></i> 概况一览 </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                            </div>
                            <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="metro-nav">
                                    <div class="metro-nav-block nav-block-orange">
                                        <a data-original-title="" href="#">
                                            <i class="icon-user"></i>
                                            <div class="info">@foreach($user->getGroups() as $group) {{$group->name}}@endforeach</div>
                                            <div class="status">您的身份</div>
                                        </a>
                                    </div>
                                    <div class="metro-nav-block nav-block-blue">
                                        @if(Sentry::getUser()->hasAnyAccess(['leader']))
                                        <a data-original-title="" href="#">
                                            <i class="icon-check"></i>
                                            <div class="info">{{$newAuditCount}}</div>
                                            <div class="status">需审批公文</div>
                                        </a>
                                            @else
                                        <a data-original-title="" href="#">
                                            <i class="icon-sitemap"></i>
                                            <div class="info">@foreach($user->getUnits() as $unit) {{$unit->name}}@endforeach</div>
                                            <div class="status">所在部门</div>
                                        </a>
                                        @endif
                                    </div>

                                    <div class="metro-nav-block nav-block-yellow">
                                             <a data-original-title="" href="{{route('inbox')}}">
                                            <i class="icon-pencil"></i>
                                            <div class="info">{{$newInboxCount}}</div>
                                            <div class="status">需签收公文</div>
                                        </a>
                                    </div>

                                    @if(Sentry::getUser()->hasAnyAccess(['leader']))
                                    <div class="metro-nav-block nav-block-green double">
                                        <a data-original-title="" href="{{route('audit')}}">
                                            <i class="icon-edit"></i>
                                            <div class="info">{{$auditedBox}}</div>
                                            <div class="status">已审批的公文</div>
                                        </a>
                                    </div>
                                    @else
                                    <div class="metro-nav-block nav-block-green double">
                                        <a data-original-title="" href="{{route('inbox')}}">
                                            <i class="icon-edit"></i>
                                            <div class="info">{{$signedCount}}</div>
                                            <div class="status">已签收的公文</div>
                                        </a>
                                    </div>
                                    @endif

                                    <div class="metro-nav-block nav-block-red">
                                        <a data-original-title="" href="{{route('outbox')}}">
                                            <i class="icon-external-link"></i>
                                            <div class="info">{{$outtedCount}}</div>
                                            <div class="status">您发出的公文</div>
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