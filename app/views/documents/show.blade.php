@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/fancybox/jquery.fancybox.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
<link rel="stylesheet" href="{{asset('css/docflow.css')}}">
@stop
@section('content')
@section('breadcrumb')
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
<i class="icon-list-ul"></i> 公文详情
</h3>
{{ Breadcrumbs::render('show_doc',$data->id) }}
<!-- END PAGE TITLE & BREADCRUMB-->
@stop


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
             <a href="{{url('home/documents/showTimeLine', $data->id) }}" data-fancybox-type="iframe" class="blog-features comments various">
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
          @include('_partials.docflowstep')
          <!-- BEGIN REPLY SECTION-->
          @include('_partials.comments')
          <!-- END REPLY SECTION-->

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


 <div class="blog-side-bar red-box">
   <h2> <i class=" icon-tags"></i> 本文关键字</h2>
   <ul class="unstyled tag">
    @foreach($tags as $tag)
    <li><a href="{{url('home/documents/search/tag',$tag->id)}}" target="_blank">{{$tag->tag}}</a></li>
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


<div class="blog-side-bar green-box">
 <h2> <i class="  icon-asterisk"></i> 我的公文</h2>
 <div class="space20"></div>
 @foreach($myDocs as $val)
 <!-- BEGIN SECTION  -->
 <div class="row-fluid">
   <div class="green-box-blog">
     <div class="span12">
       <h5>
         {{$val->created_at->diffForHumans()}}
       </h5>
       <p><a href="{{url('home/documents/show',$val->id)}}">{{$val->subject}}</a></p>
     </div>
   </div>
 </div>
 <!-- END SECTION -->
 @endforeach

 <div class="space10"></div>
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