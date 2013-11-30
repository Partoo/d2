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
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
        <!--base css styles-->

    <link href="{{asset('assets/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap-responsive.min.css')}}
">
        <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
        <!-- <link rel="stylesheet" href="http://cdn.staticfile.org/normalize/2.1.0/normalize.min.css"> -->
        <link rel="stylesheet" href="{{asset('assets/pnotify/jquery.pnotify.default.css')}}">
        <!--page specific css styles-->
        {{stylesheet()}}
        <style type="text/css">
      body {padding-top: 0;background-color: #333}
      #remember-tip{display: none}
</style>
        <script src="{{asset('assets/modernizr/modernizr-2.6.2.min.js')}}"></script>
        @yield('mycss')
    </head>
    <body>
        <!-- Add notifications -->

        <!--[if lt IE 10]>
            <p class="chromeframe">您正在使用<strong>被淘汰的</strong>浏览器。请<a href="http://browsehappy.com/">升级</a> 以获得安全与完美的浏览体验。</p>
            <![endif]-->

        <!-- START CONTENT -->
           @yield('content')
        <!--basic scripts-->
        <script src="{{asset('assets/jquery/jquery-1.8.1.min.js')}}"></script>
        <script src="{{asset('assets/jquery-ui/jquery-ui-1.8.23.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/nicescroll/jquery.nicescroll.min.js')}}"></script>
        <script src="{{asset('assets/pnotify/jquery.pnotify.min.js')}}"></script>
        <script src="{{asset('js/scripts.min.js')}}"></script>
        <script src="{{asset('js/jquery.backstretch.min.js')}}"></script>
<script>
        jQuery(document).ready(function($) {
                var num = Math.floor(Math.random()*10+6);
                        jQuery.backstretch("{{asset('img/bg')}}"+'/'+num+".jpg");
                        $(':checkbox').click(function() {
                            $('#remember-tip').slideToggle();
                        });
        });
                @include('_layouts.notifications')
</script>
        @yield('myjs')
    </body>
</html>
