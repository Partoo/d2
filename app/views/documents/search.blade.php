@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
@stop
@section('pageTitle')
<i class=" icon-upload-alt"></i>  Search
@stop
@section('breadcrumb')
     {{ Breadcrumbs::render('outbox') }}
@stop
@section('content')
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE widget-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class=" icon-file-alt"></i> 公文列表</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!--  BEGIN ADD NEW DOCUMNET BUTTON-->
                <div class="clearfix"></div>
                <!-- END ADD NEW DOCUMNET BUTTON -->
                <div class="space15"></div>

                <table  class="table table-striped table-hover table-bordered" id="dataTable">
                 <thead>
                   <tr>
                      <th>ID</th>
                     <th>公文名称</th>
                     <th>公文号</th>
                     <th>公文状态</th>
                     <th>公文类型</th>
                     <th>发文单位</th>
                     <th>发文日期</th>
                     <th>管理操作</th>
                   </tr>
                 </thead>

                </table>
                @foreach ($data->documents as $item)
                <li>{{$item->subject}}</li>
                @endforeach

            </div>
        </div>
        <!-- END EXAMPLE TABLE widget-->
    </div>
</div>
@section('myjs')
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootbox/bootbox.min.js')}}"></script>

@stop
@stop