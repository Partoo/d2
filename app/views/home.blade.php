@extends('_layouts.general')
    @section('mycss')
                <link href="{{asset('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}" rel="stylesheet" />
    @stop
    @section('pageTitle')
    <i class="icon-dashboard"></i>  系统首页
    @stop
@section('content')
<!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                <!--BEGIN METRO STATES-->
                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange ">
                        <a data-original-title="" href="#">
                            <i class="icon-list-alt"></i>
                            <div class="info">5</div>
                            <div class="status">进行中工作</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-purple ">
                        <a data-original-title="" href="#">
                            <i class="icon-file-alt"></i>
                            <div class="info">+15</div>
                            <div class="status">新收到公文</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class=" icon-check"></i>
                            <div class="info">+49</div>
                            <div class="status">审批动态</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-blue double">
                        <a data-original-title="" href="#">
                            <i class="icon-bell-alt"></i>
                            <div class="info">+87</div>
                            <div class="status">新收到提醒</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-grey">
                        <a data-original-title="" href="#">
                            <i class="icon-envelope"></i>
                            <div class="info">288</div>
                            <div class="status">未读站内短信</div>
                        </a>
                    </div>
                </div>
                <div class="space10"></div>
                                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-yellow ">
                        <a data-original-title="" href="#">
                            <i class="icon-comment"></i>
                            <div class="info">5</div>
                            <div class="status">新评论</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green double ">
                        <a data-original-title="" href="#">
                            <i class="icon-rss"></i>
                            <div class="info">+15</div>
                            <div class="status">有新资讯发布</div>
                        </a>
                    </div>

                </div>
                <!--END METRO STATES-->
            </div>
            <div class="space10"></div>

            <div class="row-fluid">
                <div class="span7 responsive" data-tablet="span7 fix-margin" data-desktop="span7">
                    <!-- BEGIN CALENDAR PORTLET-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i> 工作日历</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>

                <div class="span5">
<!-- BEGIN PROGRESS PORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> 进行中的工作 </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <ul class="unstyled">
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-refresh"></i></span>  完成年度总结 <strong class="label"> 48%</strong>
                                    <div class="space10"></div>
                                    <div class="progress">
                                        <div style="width: 48%;" class="bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-check"></i></span>  审批某某材料 <strong class="label label-success"> 85%</strong>
                                    <div class="space10"></div>
                                    <div class="progress progress-success">
                                        <div style="width: 85%;" class="bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <span class="btn btn-inverse"> <i class="icon-fire"></i></span>  基层调研 <strong class="label label-important"> 65%</strong>
                                    <div class="space10"></div>
                                    <div class="progress progress-danger">
                                        <div style="width: 65%;" class="bar"></div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- END PROGRESS PORTLET-->

                </div>

            </div>



            <div class="row-fluid">
                 <div class="span6">

                    <!-- BEGIN ALERTS PORTLET-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-bell-alt"></i> 提醒</h4>
                            <span class="tools">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="alert">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>注意!</strong> 您的账号20分钟前被冻结。
                            </div>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>成功!</strong> 您的个人资料成功修改。
                            </div>
                            <div class="alert alert-info">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>提示!</strong> 您的账号没有绑定手机。
                            </div>
                            <div class="alert alert-error">
                                <button data-dismiss="alert" class="close">×</button>
                                <strong>错误!</strong> 您的账号出现异常。
                            </div>
                        </div>
                    </div>
                    <!-- END ALERTS PORTLET-->

                 </div>
                 <div class="span6">
                     <!-- BEGIN CHAT PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-comments-alt"></i> 聊天</h4>
                                    <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-down"></a>
                                    <a href="javascript:;" class="icon-remove"></a>
                                    </span>
                         </div>
                         <div class="widget-body">
                             <div class="timeline-messages">
                                 <!-- Comment -->
                                 <div class="msg-time-chat">
                                     <a class="message-img" href="#"><img alt="" src="img/demo/avatar/avatar1.jpg" class="avatar"></a>
                                     <div class="message-body msg-in">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution"><a href="#">Partoo</a>  于今天13:55分说:</p>
                                             <p>在不？能不能把今天市里关于植树造林的资料共享一下？</p>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- /comment -->

                                 <!-- Comment -->
                                 <div class="msg-time-chat">
                                     <a class="message-img" href="#"><img alt="" src="img/demo/avatar/avatar4.jpg" class="avatar"></a>
                                     <div class="message-body msg-out">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution"> <a href="#">翠花</a>  于今天14:55分说:</p>
                                             <p>对不起，您拨打的用户已欠费，请充值后联系。</p>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- /comment -->

                                 <!-- Comment -->
                                 <div class="msg-time-chat">
                                     <a class="message-img" href="#"><img alt="" src="img/demo/avatar/avatar1.jpg" class="avatar"></a>
                                     <div class="message-body msg-in">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution"><a href="#">Partoo</a> 于今天15:05分说</p>
                                             <p>我看你是欠揍吧</p>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- /comment -->

                                 <!-- Comment -->
                                 <div class="msg-time-chat">
                                     <a class="message-img" href="#"><img alt="" src="img/demo/avatar/avatar4.jpg" class="avatar"></a>
                                     <div class="message-body msg-out">
                                         <span class="arrow"></span>
                                         <div class="text">
                                             <p class="attribution"><a href="#">翠花</a> 于今天15:15分说</p>
                                             <p>我说，您能否在工作时间讨论一下工作方面的事宜呢？</p>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- /comment -->
                             </div>
                             <div class="chat-form">
                                 <div class="input-cont">
                                     <input type="text" placeholder="请在此输入您的聊天内容,所有内容系统将默认保留30天">
                                 </div>
                                 <div class="btn-cont">
                                     <a href="javascript:;" class="btn btn-primary">发言</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- END CHAT PORTLET-->
                 </div>
             </div>
                <!-- END Main Content -->

                @section('myjs')
           <script src="{{asset('assets/fullcalendar/fullcalendar/fullcalendar.min.js')}}"></script>
        <script src="{{asset('js/home-page-calender.js')}}"></script>
                @stop
@stop