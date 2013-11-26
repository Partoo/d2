@extends('_layouts.general')
@section('mycss')

<link rel="stylesheet" type="text/css" href="{{asset('assets/data-tables/DT_bootstrap.css')}}" />
@stop
@section('pageTitle')
<i class="icon-sitemap"></i>  部门管理
@stop
@section('content')


<div class="row-fluid">
 <div class="span12">
  <div class="widget blue">
    <div class="widget-title">
      <h4><i class="icon-reorder"></i> 管理部门</h4>
      <span class="tools">
       <a href="javascript:;" class="icon-chevron-down"></a>
     </span>
   </div>
   <div class="widget-body">
    <div>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#general">常用管理</a></li>
        <li><a data-toggle="tab" href="#users">部门用户</a></li>
      </ul>
      {{Form::open(array('class'=>'form-horizontal'))}}
      <div class="tab-content ">
        <div id="general" class="tab-pane fade in active">
          <!-- 用户姓名 -->
          <div class="control-group offset3 {{ $errors->has('name') ? 'error' : '' }}">
            <label for="name" class="control-label"><i class="icon-sitemap"></i>  部门名称</label>
            <div class="controls"><input type="text" name="name" value="{{$unit->name}}">
              {{$errors->first('name','<span class="help-inline">:message</span>')}}
            </div>
          </div>
        </div>

        <div id="users" class="tab-pane fade">

          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dataTable" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>手机</th>
                <th>创建日期</th>
                <th>管理操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="5" class="dataTables_empty">数据读取中...</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>手机</th>
                <th>创建日期</th>
                <th>管理操作</th>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="space15"></div>
        <div class="control-group offset2">
          <div class="controls">
            <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
            <button type="submit" class="btn-large btn-success"><i class="icon-edit"></i>  更改部门</button>
          </div>
        </div>
      </div>
      <!-- Form Actions -->

      {{Form::close()}}
    </div>
  </div>
</div>
</div>
</div>



@section('myjs')

<script type="text/javascript" src="{{asset('assets/data-tables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootbox/bootbox.min.js')}}"></script>
<script>
$(document).ready(function() {

  $('#dataTable').dataTable({
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "{{route('unit_show',$unit->id)}}",
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
      $('.btn-danger').click(function(event) {
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

</script>
@stop

@stop