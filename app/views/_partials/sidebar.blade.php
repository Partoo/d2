            <!-- BEGIN Sidebar -->
            <div id="sidebar" class="nav-collapse sidebar-fixed">
                <!-- BEGIN Navlist -->
                <div class="space15"></div>
                <ul class="nav nav-list">

                    <li {{Request::is('home')?"class='active'":"class=''"}} style="border-bottom: 1px solid rgba(255,255,255,.3);">
                        <a href="{{route('home')}}">
                            <i class="icon-dashboard"></i>
                            <span>控制面板</span>
                        </a>
                    </li>

<!--                     <li>
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-list-alt"></i>
                            <span>任务管理</span>
                            <b class="arrow icon-angle-right"></b>
                        </a> -->

                        <!-- BEGIN Submenu -->
<!--                         <ul class="submenu">
                            <li><a href="ui_general.html">我的工作计划</a></li>
                            <li><a href="ui_button.html">同事的工作计划</a></li>
                        </ul> -->
                        <!-- END Submenu -->
<!--                     </li> -->

                    <li {{Request::segment(2)=="documents"?"class='active'":"class=''"}}>
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-file-alt"></i>
                            <span>我的公文</span>
                            <b class="arrow icon-angle-right"></b>
                        </a>
                        <!-- BEGIN Submenu -->
                        <ul class="submenu">
                            @if(Sentry::getUser()->hasAccess('leader'))
                                    @if($newAuditbox>0)
                                    <li><a href="{{route('audit')}}"><i class="icon-check"></i> 公文批示 ({{$newAuditbox}})</a></li>
                                    @else
                                    <li><a href="{{route('audit')}}"><i class="icon-check"></i> 公文批示</a></li>
                                    @endif
                            @endif
                            @if($newInbox>0)
                            <li><a href="{{route('inbox')}}"><i class="icon-inbox"></i> 收件箱 ({{$newInbox}})</a></li>
                            @else
                            <li><a href="{{route('inbox')}}"><i class="icon-inbox"></i> 收件箱</a></li>
                            @endif
                            <li><a href="{{route('outbox')}}"><i class="icon-signout"></i> 发件箱</a></li>
                            <li><a href={{action('DocumentsController@create')}}><i class="icon-plus"></i> 发送新公文</a></li>
                        </ul>
                        <!-- END Submenu -->
                    </li>



<!--                     <li>
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-copy"></i>
                            <span>审批管理</span>
                            <b class="arrow icon-angle-right"></b>
                        </a> -->

                        <!-- BEGIN Submenu -->
<!--                         <ul class="submenu">
                            <li><a href="form_layout.html">我的申请</a></li>
                            <li><a href="form_component.html">创建申请</a></li>
                            <li><a href="form_wizard.html">申请审批</a></li>
                            <li><a href="form_validation.html">Validation</a></li>
                        </ul> -->
                        <!-- END Submenu -->
                    <!-- </li> -->

<!--                     <li>
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-edit"></i>
                            <span>资讯发布</span>
                            <b class="arrow icon-angle-right"></b>
                        </a> -->

                        <!-- BEGIN Submenu -->
<!--                         <ul class="submenu">
                            <li><a href="table_basic.html">信息资讯</a></li>
                            <li><a href="table_advance.html">发布信息</a></li>
                            <li><a href="table_dynamic.html">Dynamic</a></li>
                        </ul> -->
                        <!-- END Submenu -->
                    <!-- </li> -->

                    <li {{Request::segment(1)=="account"?"class='active'":"class=''"}}>
                        <a href="{{route('account')}}">
                            <i class="icon-list-alt"></i>
                            <span>个人资料</span>
                        </a>
                    </li>

                    @if(Sentry::getUser()->hasAccess('admin'))
                    <li {{Request::segment(1)=="admin"?"class='active'":"class=''"}}>
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-gears"></i>
                            <span>系统管理</span>
                            <b class="arrow icon-angle-right"></b>
                        </a>
                        <!-- BEGIN Submenu -->
                        <ul class="submenu">
                            <li><a href="{{route('param')}}"><i class="icon-gear"></i> 参数设置</a></li>
                            <li><a href="{{route('docs')}}"><i class="icon-archive"></i> 公文管理</a></li>
                            <li><a href="{{route('users')}}"><i class="icon-user"></i> 用户管理</a></li>
                            <li><a href="{{route('groups')}}"><i class="icon-group"></i> 群组管理</a></li>
                            <li><a href="{{route('units')}}"><i class="icon-sitemap"></i> 部门管理</a></li>
                            <li><a href="{{route('site')}}"><i class="icon-wrench"></i> 系统维护</a></li>
                        </ul>
                        @endif
                        <!-- END Submenu -->
                    </li>
                </ul>
                <!-- END Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-desktop">
                    <i class="icon-double-angle-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>
            <!-- END Sidebar -->