@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/data-tables/DT_bootstrap.css')}}" />
@stop
@section('pageTitle')
<i class="icon-user"></i>  用户管理
@stop

@section('content')


<div class="row-fluid">
 <div class="span12">
   <div class="widget blue">
     <div class="widget-title">
       <h4><i class="icon-user-md"></i> 用户管理</h4>

       <span class="tools">
        <a href="javascript:;" class="icon-chevron-down"></a>
      </span>
    </div>
    <div class="widget-body">
     <div>
       <div class="clearfix">
         <div class="btn-group">
           <a href="{{route('create/user')}}" id="addNew" class="btn btn-success">
             添加用户 <i class="icon-plus"></i>
           </a>
         </div>
       </div>
       <div class="space15"></div>
       <table class="table table-striped table-hover table-bordered" id="dataTable">
         <thead>
           <tr>
             <th>@lang('admin/users/table.name')</th>
             <th>@lang('admin/users/table.email')</th>
             <th>@lang('admin/users/table.phone')</th>
             <th style="width:100px">激活状态</th>
             <th>创建时间</th>
             <th>管理操作</th>
           </tr>
         </thead>
         <tbody>

          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- END EXAMPLE TABLE widget-->
</div>
</div>

@include('_partials.modal_delete')

@section('myjs')
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootbox/bootbox.min.js')}}"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {

  $('#dataTable').dataTable({
    "aoColumns": [
      { "bSearchable": true },
      null,
      null,
      null,
      {"bSearchable":false},
      {"bSearchable":false}
    ],
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "{{route('user_index')}}",
    "oLanguage": {
      "sLengthMenu": "每页显示 _MENU_ 条记录",
      "sZeroRecords": "对不起，查询不到任何相关数据",
      "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
      "sInfoEmtpy": "找不到相关数据",
      "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
      "sProcessing": "正在加载中...",
      "sSearch": "搜索",
      "oPaginate": {
          "sFirst":    "第一页",
          "sPrevious": " 上一页 ",
          "sNext":     " 下一页 ",
          "sLast":     " 最后一页 "
      }
  },
  // 确定datatable加载完毕,调用modal
  "fnInitComplete": function() {
      $('.del').click(function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
          bootbox.confirm("你确定删除吗?",function(isOk){
            if (isOk) {
              location.href=href;
            };
          });
      });

   }

  });



} );
</script>
@stop

@stop