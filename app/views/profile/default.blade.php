@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/bootstrap-datetimepicker/css/datepicker.css')}}">
@stop
@section('pageTitle')
<i class="icon-list-alt"></i>  个人资料
@stop
@section('content')
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN INLINE TABS PORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class="icon-user"></i> 修改个人资料</h4>
                <span class="tools">
                 <a href="javascript:;" class="icon-chevron-down"></a>
             </span>
         </div>
         <!-- 如果有了用户档案则显示 -->
         @if(!is_null($user->profile))
         <div class="widget-body">
            <div class="bs-docs-example">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#home">基本资料</a></li>
                    <li class=""><a data-toggle="tab" href="#profile">详细资料</a></li>
                    <li class=""><a data-toggle="tab" href="#avatar">头像与签名</a></li>
                    <li class=""><a data-toggle="tab" href="#auth">修改密码</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div id="home" class="tab-pane active">
                        <!-- BEGIN FORM-->
                        {{Form::open(array('class'=>'form-horizontal','url'=>'account/profile'))}}
                        <!-- ROW 1 -->
                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-user"></i>  真实姓名</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="请输入真实姓名" value="{{$user->username}}" name="username" readonly>
                                        <div class="space10"></div>
                                        <a href="#changename" data-toggle="modal" class="btn btn-primary pull-right">更改姓名</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-sitemap"></i>  所属部门</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="未选部门" value="<?php foreach ($myunit as $unit) {echo $unit;}?>" name="unitname" readonly>
                                        <div class="space10"></div>
                                        <a href="#changeunit" data-toggle="modal" class="btn btn-primary pull-right">更改部门</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class=" icon-envelope-alt"></i>  注册邮箱</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="您可以绑定邮箱(不要用QQ信箱)" name="email" value="{{$user->email}}" readonly>
                                        <div class="space10"></div>
                                        <a href="#changemail" data-toggle="modal" class="btn btn-primary pull-right">绑定邮箱</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-mobile-phone"></i>  绑定手机</label>
                                    <div class="controls controls-row">
                                        <input type="text" class="input-block-level" placeholder="您尚未绑定手机" name="phone" value="{{$user->phone}}" readonly>
                                    </div>
                                    <div class="space10"></div>
                                    <a href="#changephone" data-toggle="modal" class="btn btn-primary pull-right">绑定手机</a>
                                </div>
                            </div>
                        </div>


                        {{Form::close()}}
                        <!-- END FORM-->
                    </div>

                    <div id="profile" class="tab-pane">
                        <!-- BEGIN FORM-->
                        {{Form::open(array('class'=>'form-horizontal'))}}
                        <!-- ROW 1 -->
                        <div class="row-fluid">
                            <div class="offset3 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-user-md"></i>  昵称</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="请输入您的昵称" value="{{$profile->nickname}}" name="nickname">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset3 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-calendar"></i>  出生日期</label>
                                    <div class="controls">
                                        <input name="birth" class="input-block-level" type="text" value="{{$profile->birth}}" id="birth" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset3 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-volume-up"></i>  QQ号码</label>
                                    <div class="controls controls-row">
                                        <input type="text" value="{{$profile->qq}}" name="qq">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset3 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-weibo"></i>  微博</label>
                                    <div class="controls controls-row">
                                        <input type="text" value="{{$profile->weibo}}" name="weibo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset3 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-male"></i>  个人简介</label>
                                    <div class="controls controls-row">
                                        <textarea type="text" row="3"  name="intro">{{$profile->intro}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset4 span4" style="text-align: center;">
                                {{Form::submit('修改资料', array('class'=>'btn btn-large btn-primary'))}}
                            </div>

                        </div>
                        {{Form::close()}}
                        <!-- END FORM-->
                    </div>

                    <div id="avatar" class="tab-pane">
                        <div class="row-fluid span12">
                            <div class="row-fluid  span5">
                                <img src="{{asset($profile->avatar)}}" class="img-polaroid">
                            </div>
                            <label class="control-label"><i class=" icon-level-up"></i>  上传头像<span class="text-error"> *</span></label>
                            <div class="row-fluid span6">
                                {{Form::open(array('files'=> true))}}
                                <input type="file" class="alert alert-success " name="avatar">
                                <div class="row-fluid">
                                    <div>
                                        {{Form::submit('修改头像', array('class'=>'btn btn-large btn-primary'))}}
                                    </div>

                                </div>
                                {{Form::close()}}
                            </div>

                        </div>
                    </div>
                    <div id="auth" class="tab-pane">
                        <!-- BEGIN FORM-->
                        {{Form::open(array('class'=>'form-horizontal','url'=>'account/change-password'))}}
                        <!-- ROW 1 -->
                        <div class="row-fluid">
                            <div class="offset4 span4">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-lock"></i>  当前密码</label>
                                    <div class="controls">
                                        <input type="password" class="input-block-level" placeholder="输入当前密码" value="" name="old_password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset4 span4">
                                <div class="control-group">
                                    <label class="control-label"><i class=" icon-key"></i>  新密码</label>
                                    <div class="controls">
                                        <input type="password" class="input-block-level" placeholder="输入密码" value="" name="password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset4 span4">
                                <div class="control-group">
                                    <label class="control-label"><i class=" icon-mail-forward "></i>  密码确认</label>
                                    <div class="controls">
                                        <input type="password" class="input-block-level" placeholder="再次输入密码" value="" name="password_confirm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset4 span4" style="text-align: center;">
                                {{Form::submit('修改密码', array('class'=>'btn btn-large btn-primary'))}}
                            </div>

                        </div>
                        {{Form::close()}}
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
        <!-- 如果没有个人资料，则提供创建 -->
        @else
        <div class="widget-body">
            <div class="bs-docs-example">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#home">基本资料</a></li>
                    <li class=""><a data-toggle="tab" href="#profile">详细资料</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div id="home" class="tab-pane active">
                        <!-- BEGIN FORM-->
                        {{Form::open(array('class'=>'form-horizontal','url'=>'account/profile'))}}
                        <!-- ROW 1 -->
                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-user"></i>  真实姓名</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="请输入真实姓名" value="{{$user->username}}" name="username" readonly>
                                        <div class="space10"></div>
                                        <a href="#changename" data-toggle="modal" class="btn btn-primary pull-right">更改姓名</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class=" icon-envelope-alt"></i>  注册邮箱</label>
                                    <div class="controls">
                                        <input type="text" class="input-block-level" placeholder="请输入您的邮箱(不推荐使用QQ信箱)" name="email" value="{{$user->email}}" readonly>
                                        <div class="space10"></div>
                                        <a href="#changemail" data-toggle="modal" class="btn btn-primary pull-right">更改邮箱</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="offset2 span5">
                                <div class="control-group">
                                    <label class="control-label"><i class="icon-mobile-phone"></i>  绑定手机</label>
                                    <div class="controls controls-row">
                                        <input type="text" class="input-block-level" placeholder="请输入您的手机号码" name="phone" value="{{$user->phone}}" readonly>
                                    </div>
                                    <div class="space10"></div>
                                    <a href="#changephone" data-toggle="modal" class="btn btn-primary pull-right">更改手机</a>
                                </div>
                            </div>
                        </div>

                        {{Form::close()}}
                        <!-- END FORM-->
                    </div>
                    <div id="profile" class="tab-pane">
                        您还没有填写详细资料
                        <div class="space15"></div>
                        <div class="row-fluid">
                            <a href="{{url('account/new-profile')}}" class="btn btn-large btn-primary" type="a"><i class="icon-plus"></i>  填写详细资料</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- END INLINE TABS PORTLET-->
</div>
</div>



@section('myjs')
<script src="{{asset('assets/bootstrap-datetimepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/bs-tab-cookie.js')}}"></script>
<script type="text/javascript">
$("#birth").datepicker();
</script>

@include('_partials.modal_changemail')
@include('_partials.modal_changephone')
@include('_partials.modal_changename')
@include('_partials.modal_changeunit')
@stop
@stop