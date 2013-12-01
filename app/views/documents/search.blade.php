@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
@stop
<?php
function showState($code)
{
    switch ($code) {
        case '0':
        return '<span class="label label-info"><i class="icon-ok-circle"></i>  待审批</span>';
        break;
        case '1':
        return '<span class="label label-success"><i class="icon-ok"></i>  审批通过</span>';
        break;
        case '2':
        return '<span class="label label-inverse"><i class=" icon-ban-circle"></i>  退回</span>';
        break;
        case '3':
        return '<span class="label label-success"><i class="icon-pencil"></i>  已签发</span>';
        break;
        case '4':
        return '<span class="label label-important"><i class="icon-refresh"></i>  已办结</span>';
        break;
        case '5':
        return '<span class="label label-warning"><i class="icon-archive"></i>  已归档</span>';
        break;
        case '-1':
        return '<span class="label label-warning"><i class="icon-randomv"></i>  预审通过</span>';
        break;
    }
}
?>


@section('pageTitle')
<i class=" icon-upload-alt"></i>  Search
@stop
@section('breadcrumb')
{{ Breadcrumbs::render('outbox') }}
@stop

@if(Request::segment(4)=="tag")
@section('content')
<div class="row-fluid">
    <div class="span12">

        <!-- BEGIN EXAMPLE TABLE widget-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class=" icon-file-alt"></i> 标注 {{$tag}} 的公文列表</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!--  BEGIN ADD NEW DOCUMNET BUTTON-->
                <div class="clearfix"></div>
                <!-- END ADD NEW DOCUMNET BUTTON -->


                <table class="table table-hover file-search">
                    <thead>
                        <tr>
                            <th>公文名称</th>
                            <th class="hidden-phone">公文字号</th>
                            <th>公文状态</th>
                            <th class="hidden-phone">公文类型</th>
                            <th class="hidden-phone">发文单位</th>
                            <th class="hidden-phone">发文日期</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <img src="{{asset('img/file-search/wait.png')}}" alt="">
                                <strong><a href="{{url('home/documents/show',$item->id)}}">{{$item->subject}}</a></strong>
                                <cite style="color:#999">发送者:{{Sentry::getUser($item->sender_id)->username}}</cite>
                            </td>
                            <td class="hidden-phone">{{$item->docnumber}}</td>
                            <td>{{showState($item->state)}}</td>
                            <td class="hidden-phone">{{$item->category}}</td>
                            <td class="hidden-phone">{{$item->creDep}}</td>
                            <td class="hidden-phone">{{$item->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{{$data->links()}}</div>


            </div>
        </div>
        <!-- END EXAMPLE TABLE widget-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class=" icon-file-alt"></i> 关键字列表</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!--  BEGIN ADD NEW DOCUMNET BUTTON-->
                <div class="clearfix"></div>
                <!-- END ADD NEW DOCUMNET BUTTON -->
                @foreach($tags as $item)
                <a href="{{url('home/documents/search/tag',$item->id)}}" class="btn btn-success">{{$item->tag}}</a>
                @endforeach
                <div>{{$tags->links()}}</div>
            </div>
        </div>

    </div>
</div>
@stop
<!-- END TAG SEARCH -->

<!-- START CATEGORY SEARCH -->
@else
@section('content')
<div class="row-fluid">
    <div class="span12">

        <!-- BEGIN EXAMPLE TABLE widget-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class=" icon-file-alt"></i> 标注 {{$category}} 的公文列表</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!--  BEGIN ADD NEW DOCUMNET BUTTON-->
                <div class="clearfix"></div>
                <!-- END ADD NEW DOCUMNET BUTTON -->


                <table class="table table-hover file-search">
                    <thead>
                        <tr>
                            <th>公文名称</th>
                            <th class="hidden-phone">公文字号</th>
                            <th>公文状态</th>
                            <th class="hidden-phone">公文类型</th>
                            <th class="hidden-phone">发文单位</th>
                            <th class="hidden-phone">发文日期</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <img src="{{asset('img/file-search/wait.png')}}" alt="">
                                <strong><a href="{{url('home/documents/show',$item->id)}}">{{$item->subject}}</a></strong>
                                <cite style="color:#999">发送者:{{Sentry::getUser($item->sender_id)->username}}</cite>
                            </td>
                            <td class="hidden-phone">{{$item->docnumber}}</td>
                            <td>{{showState($item->state)}}</td>
                            <td class="hidden-phone">{{$category}}</td>
                            <td class="hidden-phone">{{$item->creDep}}</td>
                            <td class="hidden-phone">{{$item->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{{$data->links()}}</div>


            </div>
        </div>
        <!-- END EXAMPLE TABLE widget-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class=" icon-file-alt"></i> 分类列表</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!--  BEGIN ADD NEW DOCUMNET BUTTON-->
                <div class="clearfix"></div>
                <!-- END ADD NEW DOCUMNET BUTTON -->
                @foreach($categories as $item)
                <a href="{{url('home/documents/search/category',$item->id)}}" class="btn btn-success">{{$item->category}}</a>
                @endforeach
                <div>{{$categories->links()}}</div>
            </div>
        </div>

    </div>
</div>
@stop
@endif
@section('myjs')
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootbox/bootbox.min.js')}}"></script>

@stop
