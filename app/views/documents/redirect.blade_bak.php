@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/fancybox/jquery.fancybox.css')}}" type="text/css" media="screen" />
@stop
@section('content')
@section('breadcrumb')
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
 公文详情
</h3>
<ul class="breadcrumb">
 <li>
   <a href="#">系统首页</a>
   <span class="divider">/</span>
 </li>
 <li>
   <a href="#">公文管理</a>
   <span class="divider">/</span>
 </li>

 <li class="active">
   公文详情
 </li>

</ul>
<!-- END PAGE TITLE & BREADCRUMB-->
@stop
<div class="row-fluid">
 <div class="span12">
   <!-- BEGIN BLANK PAGE PORTLET-->
   <div class="widget">
     <div class="widget-title">
       <h4><i class="icon-random"></i> 公文转发 </h4>
       <span class="tools">
         <a href="javascript:;" class="icon-chevron-down"></a>
       </span>
     </div>
     <div class="widget-body">
       <div class="contact-us">
         <div class="space15"></div>
         <h3><i class="icon-paste"></i>  公文概况</h3>
         <div class="space15"></div>
         <div class="row-fluid">
           <div class="span4">
             <div class="widget blue">
               <div class="widget-title">
                 <h4>公文简介</h4>
               </div>
               <div class="widget-body">
                 <p> <strong>公文名称 :</strong> <a href="{{url('home/documents/show',$data->id)}}">{{$data->subject}} </a><br>
                     <strong>公文字号 :</strong> {{$data->docnumber}}<br>
                     <strong>发文时间 :</strong> {{$data->created_at}}<br>
                     <strong>发文单位 :</strong> {{$data->creDep}}<br>
                     <strong>公文分类 :</strong> {{$data->category}}</p>
                 </div>
               </div>

             </div>
             <div class="span4">
               <div class="widget cyan">
                 <div class="widget-title">
                   <h4>公文内容</h4>
                 </div>
                 <div class="widget-body" style="min-height:110px;position: relative;">
                  @if($data->content<>'')
                   <p>{{$data->content}}</p>
                   @endif
                    <div class="row-fluid ">
                  @if($data->filePath<>'')
                      <?php $files=explode(',',trim($data->filePath,','))  ?>
                        @foreach($files as $key=>$file)
                    <div style="position: absolute;bottom: 10px;"><a class="btn btn-info various" data-fancybox-type="iframe" href="<?php echo '/'.str_replace(strrchr($file, "."),"",$file).'.html'; ?>"><i class="icon-search"></i></a></div>
                      @endforeach
                   @endif
                    </div>
                   </div>
                 </div>
               </div>
               <div class="span4">
                 <div class="widget green">
                   <div class="widget-title">
                     <h4>审批意见</h4>
                   </div>
                   <div class="widget-body" style="min-height:110px;position: relative;">
                              @if ($comments->count())
                                @foreach ($comments as $comment)
                                 <p>
                                 <strong>{{$comment->author->username}} :</strong>{{$comment->comment}}</p>
                                @endforeach
                                @endif
                     </p>
                   </div>
                 </div>
               </div>
             </div>
             <div class="space20"></div>
             <div class="row-fluid">
               <div class="feedback">
                 <h3><i class="icon-group"></i>   选择接收者</h3>
                 <div class="space20"></div>

                 {{Form::open()}}
                  <div class="control-group ">
                    <div class="controls controls-row">
                      <select data-placeholder="请选择发送对象" class="chzn-select span12" multiple="multiple" name="recievers[]" tabindex="6">

                        @foreach($units as $key => $unit)
                            <optgroup label="{{$unit->name}}">
                              <?php $arr = \DB::table('users_units')->where('unit_id','=',$unit->id)->get();
                              ?>
                              @foreach($arr as  $val))<option value="{{$val->user_id}}">{{\Sentry::findUserById($val->user_id)->username}}</option>@endforeach
                            </optgroup>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="text-center">
                   <button class="btn btn-info btn-large" type="submit">转发公文</button>
                 </div>
               {{Form::close()}}
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- END BLANK PAGE PORTLET-->
   </div>
 </div>

 @section('myjs')
 <script src="{{asset('assets/chosen-bootstrap/chosen.jquery.min.js')}}"></script>
 <script src="{{asset('assets/fancybox/jquery.fancybox.pack.js')}}"></script>
 <script>
 $(document).ready(function() {
  $(".chzn-select").chosen({allow_select_group:true});
    $(".various").fancybox({
    maxWidth  : 800,
    maxHeight : 600,
    fitToView : false,
    width   : '70%',
    height    : '70%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
});
 </script>
 @stop

 @stop