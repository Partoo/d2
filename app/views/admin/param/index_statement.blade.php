@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-editable/css.css')}}" />
<style></style>
@stop
@section('pageTitle')
<i class="icon-quote-right"></i>  常用语设置
@stop

@section('content')


<div class="row-fluid">
 <div class="span12">
   <div class="widget blue">
     <div class="widget-title">
       <h4><i class="icon-quote-right"></i>  常用语设置</h4>

       <span class="tools">
        <a href="javascript:;" class="icon-chevron-down"></a>
      </span>
    </div>
    <div class="widget-body">
      <a href="#" class="btn btn-large btn-danger" id="create-btn"><i class="icon-plus"></i>   新建用语</a>
      <div class="space15"></div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#ID</th>
            <th>语句</th>
            <th>类型</th>
            <th>管理操作</th>
          </tr>
        </thead>
        <tbody>
          <tr id="newone" style="display:none">
            <td>/</td>
            <td><a href="#" class="btn btn-info newedit" id="newState" data-value='' data-type="text" data-name="statement" data-original-title="输入短语">点击新建</a></td>
            <td><a href="#" class="btn btn-warning newedit editable-click editable-unsaved"  id="newType" data-type="select" data-name="type"  >点击选择</a></td>
            <td><a href="#" class="btn btn-success save-btn">点击保存</a></td>
          </tr>
          @foreach($lists as $val)
          <tr>
            <td><span class="badge">{{$val->id}}</span></td>
            <td><a href="#" style="margin-bottom:5px;" class="btn btn-info edit" data-type="text" data-name="statement" data-pk="{{$val->id}}" >{{$val->statement}}</a></td>
            <td><a href="#" style="margin-bottom:5px;" class="btn btn-warning statement-type" data-value="{{$val->type}}" data-type="select" data-name="type" data-pk="{{$val->id}}">@if($val->type=='0')<i class="icon-check-sign"></i>  审批用语@else<i class="icon-comments-alt"></i>  普通用语@endif</a></td>
            <td><a href="{{route('param/delete/statement', $val->id)}}"  class="btn  btn-danger remove-btn" style="margin-bottom:5px;"><span><i class="icon-remove"></i></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  <!-- END EXAMPLE TABLE widget-->
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


@section('myjs')
<script src="{{asset('js/bs-tab-cookie.js')}}"></script>
<script src="{{asset('assets/bootstrap-editable/min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootbox/bootbox.min.js')}}"></script>
<script>
jQuery(document).ready(function() {
 $('.edit').editable({
  url: '{{route('param/update')}}',
  title: '请填写您要修改的内容',
  success: function(response, newValue) {
    $.pnotify({
      title:'  操作提示',
      text:response,
      icon:'icon-info',
      type:'info',
      stack: stack_topleft,
      animation: 'show'
    })
  }
});

 $('.statement-type').editable({
   url: '{{route('param/update')}}',
   source: [
   {value: 0, text: '审批用语'},
   {value: 1, text: '普通用语'}
   ],
   success: function(response, newValue) {
    $.pnotify({
      title:'  操作提示',
      text:response,
      icon:'icon-info',
      type:'info',
      stack: stack_topleft,
      animation: 'show'
    })
  }
});


//新建内容 前端处理代码

$('#create-btn').click(function(event) {
  $('#newone').show();
});

$('#newState').editable({
    url: '{{route('param')}}' //this url will not be used for creating new user, it is only for update
  });

$('#newType').editable({
  url: '{{route('param')}}',
  source: [
  {value: 0, text: '审批用语'},
  {value: 1, text: '普通用语'}
  ],
});

$('.newedit').editable('option', 'validate', function(v) {

  if(!v)
    return '这里怎么能不填点什么呢'
  });

//automatically show next editable
$('.newedit').on('save.newuser', function(){
    var that = this;
    setTimeout(function() {
        $(that).closest('td').next().find('.newedit').editable('show');
    }, 200);
});

$('.save-btn').click(function(event) {
 $('.newedit').editable('submit', {
   url: '{{route('param')}}',
   ajaxOptions: {
           dataType: 'json' //assuming json response
         },
         success: function(data, config) {
           if(data && data.id) {  //record created, response like {"id": 2}
               //set pk
             $(this).editable('option', 'pk', data.id);
             $('#newone').hide();
               document.location.reload();
             } else if(data && data.errors){
               //server-side validation error, response like {"errors": {"username": "username already exist"} }
               config.error.call(this, data.errors);
             }
           },
           error: function(errors) {
             var msg = '';
           if(errors && errors.responseText) { //ajax error, errors = xhr object
             msg = errors.responseText;
           } else { //validation error (client-side or server-side)
             $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
           }
           $.pnotify({
            title:'  操作提示',
            text:msg,
            icon:'icon-info',
            type:'info',
            stack: stack_topleft,
            animation: 'show'
          });
         }
       });
});

$('.remove-btn').click(function(event) {
  event.preventDefault();
  var href = $(this).attr('href');
  bootbox.confirm("此操作不可恢复,你确定执行吗?",function(isOk){
    if (isOk) {
      location.href=href;
    };
  });
});


});
</script>
@stop


@stop