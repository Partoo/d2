@extends('_layouts.general')

@section('pageTitle')
<i class="icon-gears"></i>  系统管理
@stop

@section('content')


<div class="row-fluid">
 <div class="span12">
   <div class="widget blue">
     <div class="widget-title">
       <h4><i class="icon-gears"></i> 系统管理</h4>

       <span class="tools">
        <a href="javascript:;" class="icon-chevron-down"></a>
      </span>
    </div>
    <div class="widget-body">
      <div>
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#settings">系统参数</a></li>
          <li><a data-toggle="tab" href="#fix">系统维护</a></li>
        </ul>
        {{Form::open(array('class'=>'form-horizontal'))}}
        <div class="tab-content ">
          <div id="settings" class="tab-pane active offset3">
            <!-- 系统名称 -->
            <div class="control-group">
              <label for="username" class="control-label"><i class=" icon-laptop"></i>  系统名称</label>
              <div class="controls"><input type="text" name="sitename" value="{{Setting::get('site.siteName')}}">
              </div>
            </div>
            <!-- 站长电话 -->
            <div class="control-group">
              <label for="username" class="control-label"><i class=" icon-phone"></i>  管理员电话</label>
              <div class="controls"><input type="text" name="adminPhone" value="{{Setting::get('site.siteAdminPhone')}}">
              </div>
            </div>

          </div>
          <div id="fix" class="tab-pane">
            <div class="offset3">
              <div class="control-group">
                <fieldset>
                  <legend>系统当前{{Setting::get('site.siteOn')?'<span class="text-success">  正常运行中</span>':' <span class="text-error">  维护关闭中</span>'}}</legend>
                  {{Setting::get('site.siteOn')?'<div class="radio"><label for="allow"><input type="radio" value="1" id="allow" name="siteOn">关闭系统</label></div>':'<div class="radio"><label for="disallow"><input type="radio" value="0" id="disallow" name="siteOn">启动系统</label></div>'}}
                </fieldset>
              </div>
              <div class="control-group">
                <fieldset>
                  <legend>系统当前{{Setting::get('site.signEnabled')?'<span class="text-success">  允许注册新用户</span>':' <span class="text-error">  禁止注册新用户</span>'}}</legend>
                  {{Setting::get('site.signEnabled')?'<div class="radio"><label for="allow"><input type="radio" value="1" id="allow" name="signEnabled">禁止注册</label></div>':'<div class="radio"><label for="disallow"><input type="radio" value="0" id="disallow" name="signEnabled">允许注册</label></div>'}}
                </fieldset>
              </div>
            </div>
          </div>
          <div class="control-group offset2">
            <div class="controls">
              <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
              <button type="submit" class="btn-large btn-success"><i class="icon-plus"></i> 修改参数</button>
            </div>
          </div>
        </div>
        <!-- Form Actions -->

        {{Form::close()}}
      </div>
    </div>
  </div>
  <!-- END EXAMPLE TABLE widget-->
</div>
</div>

@section('myjs')
<script src="{{asset('js/bs-tab-cookie.js')}}"></script>
@stop


@stop