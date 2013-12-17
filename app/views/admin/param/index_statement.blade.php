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
          <tr class="odd gradeX">
            <td><input type="checkbox" class="checkboxes" value="1" /></td>
            <td>Jhone doe</td>
            <td class="hidden-phone"><a href="mailto:jhone-doe@gmail.com">jhone-doe@gmail.com</a></td>
            <td class="hidden-phone">10</td>
            <td class="center hidden-phone">02.03.2013</td>
            <td class="hidden-phone"><span class="label label-success">Approved</span></td>
          </tr>
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

//删除的前端视觉代码
$('.removehandle').toggle(function() {
  $('.remove-btn').css('display', '');
}, function() {
  $('.remove-btn').css('display', 'none');
});

//新建内容 前端处理代码
$('.createbox').editable({
    url: '{{route('param')}}' //this url will not be used for creating new user, it is only for update
  });

$('.createbox').editable('option', 'validate', function(v) {

  if(!v) {
    return '这里怎么能不填点什么呢'}
    else{
      $('.save-btn').css('display', '');
    };

  });

$('.save-btn').click(function(event) {
 $('.createbox').editable('submit', {
   url: '{{route('param')}}',
   ajaxOptions: {
           dataType: 'json' //assuming json response
         },
         success: function(data, config) {
           if(data && data.id) {  //record created, response like {"id": 2}
               //set pk
             $(this).editable('option', 'pk', data.id);
               //remove unsaved class
               $(this).removeClass('editable-unsaved');

               $('.save-btn').hide();
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

$('#categoryEditor .remove-btn').click(function(event) {
  event.preventDefault();
  var href = $(this).attr('href');
  bootbox.confirm("此操作可能造成公文数据混乱,你确定执行吗?",function(isOk){
    if (isOk) {
      location.href=href;
    };
  });
});


});
</script>
@stop


@stop