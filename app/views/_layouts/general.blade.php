<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site.siteName')}}--Powered by iStar Office</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img')}}/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('img')}}/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img')}}/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="{{asset('img')}}/ico/apple-touch-icon-57-precomposed.png">
    <!--base css styles-->
    <link href="{{asset('assets/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap-responsive.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <!--         <link rel="stylesheet" href="{{asset('assets/normalize/normalize.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/pnotify/jquery.pnotify.default.css')}}">
    <!--page specific css styles-->
    {{stylesheet()}}
    <script src="{{asset('assets/modernizr/modernizr-2.6.2.min.js')}}"></script>
    @yield('mycss')
</head>
<body>

            <!-- BEGIN Navbar -->
            <div id="navbar" class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <!-- BEGIN Brand -->
                        <a href="#" class="brand">
                            <img src="{{URL::asset('img/logo.png')}}" alt="">
                        </a>
                        <!-- END Brand -->


                        <!-- BEGIN Responsive Sidebar Collapse -->
                        <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                            <i class="icon-reorder"></i>
                        </a>
                        <!-- END Responsive Sidebar Collapse -->

                        <!-- BEGIN Navbar Buttons -->
                        <ul class="nav flaty-nav pull-right">

                            <!-- BEGIN Button User -->
                            <li class="user-profile">
                                <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                                    <img class="nav-user-photo" src="{{asset($avatar)}}" />
                                    <span class="hidden-phone" id="user_info">
                                     {{ Sentry::getUser()->username}}
                                 </span>
                                 <i class="icon-caret-down"></i>
                             </a>

                             <!-- BEGIN User Dropdown -->
                             <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                                <li class="nav-header">
                                    <i class="icon-time"></i>
                                    上次登录:{{Sentry::getUser()->last_login->diffForHumans()}}
                                </li>

<!--                                 <li>
                                    <a href="#">
                                        <i class="icon-cog"></i>
                                        个性设置
                                    </a>
                                </li> -->

                                <li>
                                    <a href="{{route('account')}}">
                                        <i class="icon-user"></i>
                                        修改个人资料
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-question"></i>
                                        帮助
                                    </a>
                                </li>


                                <li class="divider"></li>

                                <li>
                                    <a href="#logoutModal" data-toggle="modal">
                                        <i class="icon-off"></i>
                                        退出登录
                                    </a>
                                </li>
                            </ul>
                            <!-- BEGIN User Dropdown -->
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
        <!-- END Navbar -->
        <!-- START LOGOUT MODAL -->
        <div id="logoutModal" class="modal hide fade" tabindex="-1" role="dialog">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1">您要退出吗？</h3>
            </div>
            <div class="modal-body">
                <p>如果您要退出本系统，请点击确定。</p>
            </div>
            <div class="modal-footer">
                <a class="btn" data-dismiss="modal" aria-hidden="true">取消</a>
                <a class="btn btn-primary" href="{{route('logout')}}">确定</a>
            </div>
        </div>

        <!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            @include('_partials.sidebar')

            <!-- BEGIN Content -->
            <div id="main-content">
                <!-- BEGIN Page HEADER -->
                <div class="row-fluid">
                 <div class="span12">
                    <!-- BEGIN NOTIFICATION FROM layouts.notification -->


                    @section('breadcrumb')
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">@yield('pageTitle')</h3>
                     {{ Breadcrumbs::render(Request::segment(1)) }}
                 <!-- END PAGE TITLE & BREADCRUMB-->
                 @show
             </div>
         </div>
         <!-- END Page HEADER -->

         @yield('content')

         <footer>
            <p>2013 © Powered by iStar Office v2.0</p>
        </footer>

        <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
    </div>
    <!-- END Content -->
</div>



<!-- END Container -->
<!--basic scripts-->
<script src="{{asset('assets/jquery/jquery-1.8.1.min.js')}}"></script>
<script src="{{asset('assets/jquery-ui/jquery-ui-1.8.23.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/pnotify/jquery.pnotify.min.js')}}"></script>
<script src="{{asset('js/jquery.cookie.js')}}"></script>
<script src="{{asset('js/scripts.min.js')}}"></script>
@yield('myjs')
<script>
@include('_layouts.notifications')
// 侧边栏开关 全局检测
    var istarbar = $.cookie('istarbar');
    if (istarbar=='sidebar-collapsed') {
        $("#sidebar-collapse > i").attr("class", "icon-double-angle-right");
        $("#sidebar").addClass('sidebar-collapsed');
    }else{
        $("#sidebar-collapse > i").attr("class", "icon-double-angle-left");
    }
</script>
</body>
</html>
