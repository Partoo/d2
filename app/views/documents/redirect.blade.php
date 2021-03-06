@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/fancybox/jquery.fancybox.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
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

<?php $docNow = round($data->state/4,2)*100;
$docState = intval($docNow).'%' ;
?>

<div class="row-fluid">
 <div class="span12">
   <!-- BEGIN BLOG PORTLET-->
   <div class="row-fluid">
     <div class="span8 ">
       <div class="row-fluid">
         <div class="blog span12">
           <div class="span2 orange hidden-phone">
             <a href="javascript:;" class="blog-features date active">
               <p class="day">{{date('d',strtotime($data->created_at))}}</p>
               <p class="month">{{date('m',strtotime($data->created_at))}}月</p>
             </a>
             <a href="#comment" class="blog-features comments">
               <i class=" icon-edit"></i>
               <p class="info">{{$data->comments->count()}}条签收记录</p>
             </a>
             <a href="{{URL::to('/home/documents/showTimeLine/1')}}" class="blog-features comments">
               <i class=" icon-screenshot"></i>
               <p class="info">公文跟踪</p>
             </a>
           </div>
           <div class="span10">

            <div class="well">
             <h2>
               {{$data->subject}}
             </h2>
             <div class="subtitle">
               <p>
                 {{$data->docnumber}} <br /><a href="javascript:;">{{\Sentry::findUserById($data->sender_id)->username}}</a>    签发于{{$data->created_at}}
               </p>
             </div>
             <p>{{$data->content}}</p>

             <div  class="docAttach">
              <p></p>
              @if($data->filePath <> NULL)
              <ul>
                <?php $files=explode(',',trim($data->filePath,','))  ?>
                @foreach($files as $key=>$file)
                <li><a class="various" data-fancybox-type="iframe" href="<?php echo '/'.str_replace(strrchr($file, "."),"",$file).'.html'; ?>"><i class="icon-eye-open"></i> <span>阅读公文{{$key==0 ? '' :$key+1}}</span></a></li>
                @endforeach
                @foreach($files as $key=>$file)
                <li> <a href="{{'/'.$file}}"><i class="icon-cloud-download"></i> <span>下载公文{{$key==0 ? '' :$key+1}}</span></a></li>
                @endforeach
                <!-- <li> <a href="#"><i class="icon-paper-clip"></i> <span>附件一</span></a></li> -->
              </ul>
              @endif
            </div>
          </div>

          <div class="row-fluid">
           <div class="feedback">
             <h4><i class="icon-group"></i>   选择接收者</h4>
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


       <!-- BEGIN REPLY -->
       <div class="media well">
        <span class="label label-info" id="comment"><i class="icon-comments"></i>   公文签收单</span>
        @if ($data->comments->count())
        @foreach ($data->comments as $comment)
        <hr>
        <!-- BEGIN REPLY SECTION -->
        <div class="media-body">
         <a href="#" class="pull-left">
           <img alt="" src="" class="media-object">
         </a>
         <h4 class="media-heading">{{$comment->author->username}}</h4>
         <span>{{$comment->created_at->diffForHumans()}}</span>
         <p>{{$comment->comment}}</p>
       </div>
       @endforeach
       @endif
       <!-- END REPLY SECTION -->
     </div>
     <!-- END REPLY -->

   </div>

 </div>
</div>
</div>
<div class="span4">
  <!-- BEGIN DOCUMENT DETAIL SHORTCUT -->
  <div class="blog-side-bar blue-box visible-phone">
    <h2> <i class=" icon-tasks"></i>  更多详情</h2>
    <ul>
     <li>
       <a href="#">
         <i class=" icon-list"></i>
         <span>签收列表</span>
       </a>
     </li>
     <li>
       <a href="#">
         <i class="  icon-random"></i>
         <span>公文动态</span>
       </a>
     </li>
   </ul>
 </div>
 <!-- END DOCUMENT DETAIL SHORTCUT -->

 <div class="blog-side-bar green-box">
   <h2> <i class="  icon-asterisk"></i> 整体进度:{{$docState}}</h2>
   <div class="space20"></div>
   <div class="progress progress-striped progress-warning active">
    <div style="width: {{$docNow}}%;" class="bar"></div>
  </div>
  <div class="space10"></div>
</div>

<div class="blog-side-bar red-box">
 <h2> <i class=" icon-tags"></i> 本文关键字</h2>
 <ul class="unstyled tag">
  @foreach($tags as $tag)
  <li><a href="">{{$tag->tag}}</a></li>
  @endforeach
</ul>
</div>

<div class="blog-side-bar group-box">
 <h2> <i class=" icon-tasks"></i> 公文分类</h2>
 <ul class="unstyled tag">

  @foreach(Config::get('site_const')['category'] as $key =>$cat)
  <li><a href="search/{{$key}}">{{$cat}}</a></li>
  @endforeach
</ul>
</div>

</div>
</div>
<!-- END BLOG PORTLET-->
</div>
</div>
@section('myjs')
<script src="{{asset('assets/fancybox/jquery.fancybox.pack.js')}}"></script>
<script src="{{asset('assets/chosen-bootstrap/chosen.jquery.min.js')}}"></script>
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