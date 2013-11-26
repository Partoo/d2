@extends('_layouts.general')
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
       <!-- BEGIN BLOG PORTLET-->
       <div class="row-fluid">
           <div class="span8 ">
               <div class="row-fluid">
                   <div class="blog">
                       <div class="span2 orange">
                           <a href="javascript:;" class="blog-features date active">
                               <p class="day">22</p>
                               <p class="month">八月</p>
                           </a>
                           <a href="javascript:;" class="blog-features comments">
                               <i class=" icon-download"></i>
                               <p class="info">14人已签收</p>
                           </a>
                           <a href="javascript:;" class="blog-features comments">
                               <i class=" icon-screenshot"></i>
                               <p class="info">公文跟踪</p>
                           </a>
                       </div>
                       <div class="span10">

                            <div class="well">
                           <h2>
                               胶州市人民政府办公室关于印发2013年种植业等政策性保险工作实施方案的通知
                           </h2>
                           <div class="subtitle">
                               <p>
                                   胶政办发〔2013〕28号 <br /><a href="javascript:;">尹琪</a>    签发于2013/8/22 13:52:33
                               </p>
                           </div>

                                  <p>各镇政府、街道办事处，市政府各部门，市直各单位：</p>
                                   <div class="docBody">
                                    <p>《胶州市2013年种植业政策性保险工作实施方案》、《胶州市2013年日光温室大棚蔬菜政策性保险工作实施方案》、《胶州市2013年养殖业政策性保险工作实施方案》和《胶州市2013年森林火灾政策性保险工作实施方案》等四个方案已经市政府研究同意，现印发给你们，望认真贯彻实施。</p>
                                </div>
                                <div align="right">胶州市人民政府办公室</div>
                                <div align="right">2013年5月15日</div>
                            </div>

                            <div  class="docAttach">
                            <ul>
                                <li><a href="#"><img src="{{asset('img/ico/icon_10_word_list.png')}}" alt="胶州市人民政府办公室关于印发2013年种植业等政策性保险工作实施方案的通知">    公文原件</a></li>
                                <li> <a href="#"><img src="{{asset('img/ico/icon_10_word_list.png')}}" alt="胶州市2013年种植业政策性保险工作实施方案">    公文附件</a></li>
                            </ul>
                            </div>
                            <hr>

                        <div class="media well">
                           <h3><i class="icon-list-ul"></i>  签收意见</h3>
                           <hr>
                           <a href="#" class="pull-left">
                               <img alt="" src="{{asset('img/avatar1.jpg')}}" class="media-object">
                           </a>
                           <div class="media-body">
                               <h4 class="media-heading">冯小刚</h4>
                               <span>2 小时前签收</span>
                               <p>请转发给赵本山导演以及语言组各位同志。 </p>
                           </div>
                       </div>
                       <div class="media well">
                           <a href="#" class="pull-left">
                               <img alt="" src="img/avatar2.jpg" class="media-object">
                           </a>
                           <div class="media-body">
                               <h4 class="media-heading">Jonathan Smith </h4>
                               <span>July 5,2013 | <a href="#">Reply</a></span>
                               <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                           </div>
                       </div>
                       <hr>
                       <div class="post-comment">
                           <h3>Post Comments</h3>
                           <form>
                               <label>Name</label>
                               <input type="text" class="span7">
                               <label>Email <span class="color-red">*</span></label>
                               <input type="text" class="span7">
                               <label>Message</label>
                               <textarea class="span10" rows="8"></textarea>
                               <p><button class="btn" type="submit">Post Comment</button></p>
                           </form>
                       </div>
                   </div>

               </div>
           </div>
       </div>
       <div class="span4">
           <div class="blog-side-bar blue-box">
            <h2> <i class=" icon-tasks"></i> category</h2>
            <ul>
               <li>
                   <a href="#">
                       <i class=" icon-umbrella"></i>
                       <span>Animal</span>
                   </a>
               </li>
               <li>
                   <a href="#">
                       <i class=" icon-trophy"></i>
                       <span>Landscape</span>
                   </a>
               </li>
               <li>
                   <a href="#">
                       <i class=" icon-plane"></i>
                       <span>Potrait</span>
                   </a>
               </li>
               <li>
                   <a href="#">
                       <i class=" icon-pushpin"></i>
                       <span>Wild Life</span>
                   </a>
               </li>
               <li>
                   <a href="#">
                       <i class=" icon-beaker"></i>
                       <span>Video</span>
                   </a>
               </li>
               <li>
                   <a href="#">
                       <i class=" icon-bullhorn"></i>
                       <span>Nature</span>
                   </a>
               </li>
           </ul>
       </div>
       <div class="blog-side-bar green-box">
           <h2> <i class="  icon-comments-alt"></i> Latest blog</h2>
           <div class="space20"></div>
           <div class="row-fluid">
               <div class="green-box-blog">
                   <div class="span3">
                       <img alt="" src="img/blog/blog-thumb-1.jpg">
                   </div>
                   <div class="span9">
                       <h5>
                           <a href="javascript:;">02 MAY 2013</a>
                       </h5>
                       <p>Nam sed arcu non tellus
                           fringilla fringilla ut vel ipsum.</p>
                       </div>
                   </div>
               </div>
               <div class="space10"></div>
               <div class="row-fluid">
                   <div class="green-box-blog">
                       <div class="span3">
                           <img alt="" src="img/blog/blog-thumb-2.jpg">
                       </div>
                       <div class="span9">
                           <h5>
                               <a href="javascript:;">02 MAY 2013</a>
                           </h5>
                           <p>Nam sed arcu non tellus
                               fringilla fringilla ut vel ipsum.</p>
                           </div>
                       </div>
                   </div>
                   <div class="space10"></div>
                   <div class="row-fluid">
                       <div class="green-box-blog">
                           <div class="span3">
                               <img alt="" src="img/blog/blog-thumb-3.jpg">
                           </div>
                           <div class="span9">
                               <h5>
                                   <a href="javascript:;">02 MAY 2013</a>
                               </h5>
                               <p>Nam sed arcu non tellus
                                   fringilla fringilla ut vel ipsum.</p>
                               </div>
                           </div>
                       </div>
                       <div class="space10"></div>
                   </div>
                   <div class="blog-side-bar red-box">
                       <h2> <i class=" icon-tags"></i> popular tags</h2>
                       <ul class="unstyled tag">
                           <li><a href="#">Metrolab Admin</a></li>
                           <li><a href="#"> Dashboard Theme</a></li>
                           <li><a href="#"> Metro</a></li>
                           <li><a href="#"> Control Panel</a></li>
                           <li><a href="#"> UI</a></li>
                           <li><a href="#"> Web Design</a></li>
                           <li><a href="#"> UIX</a></li>
                           <li><a href="#"> Blog</a></li>
                           <li><a href="#">Metrolab Admin</a></li>
                           <li><a href="#"> Dashboard Theme</a></li>
                       </ul>
                   </div>
                   <div class="blog-side-bar orange-box">
                       <h2> <i class=" icon-tasks"></i> Archive</h2>
                       <ul>
                           <li>
                               <a href="#">
                                   <span class="large">OCT</span>
                                   <span>2012</span>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <span class="large">Nov</span>
                                   <span>2012</span>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <span class="large">dec</span>
                                   <span>2012</span>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <span class="large">jan</span>
                                   <span>2013</span>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <span class="large">feb</span>
                                   <span>2013</span>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <span class="large">mar</span>
                                   <span>2013</span>
                               </a>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
           <!-- END BLOG PORTLET-->
       </div>
   </div>

   @stop