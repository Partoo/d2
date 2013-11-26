@extends('_layouts.general')

@section('pageTitle')
<i class="icon-plus"></i>  创建群组
@stop

@section('content')
@section('breadcrumb')
@parent
@stop

<div class="row-fluid">
   <div class="span12">
    <div class="widget blue">
        <div class="widget-title">
            <h4><i class="icon-reorder"></i> 创建群组</h4>
            <span class="tools">
               <a href="javascript:;" class="icon-chevron-down"></a>
           </span>
       </div>
       <div class="widget-body">
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#general">常用管理</a></li>
                <li><a data-toggle="tab" href="#permissions">权限分配</a></li>
            </ul>
            {{Form::open(array('class'=>'form-horizontal'))}}
            <div class="tab-content ">
                <div id="general" class="tab-pane  active">
                    <!-- 用户姓名 -->
                    <div class="control-group offset3 {{ $errors->has('name') ? 'error' : '' }}">
                        <label for="name" class="control-label"><i class="icon-sitemap"></i>  群组名称</label>
                        <div class="controls"><input type="text" name="name">
                            {{$errors->first('name','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                </div>
                <div id="permissions" class="tab-pane ">
                 <div class="controls">
                    <div class="control-group">
                        @foreach ($permissions as $area => $permissions)
                        <fieldset>
                            <legend>{{ $area }}</legend>
                            @foreach ($permissions as $permission)
                            <div class="control-group">
                                <label class="control-group">{{ $permission['label'] }}</label>

                                <div class="radio">
                                    <label for="{{ $permission['permission'] }}_allow" onclick="">
                                    <input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
                                    允许
                                </label>
                                </div>

                                <div class="radio">
                                    <label for="{{ $permission['permission'] }}_deny" onclick="">
                                    <input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
                                    拒绝
                                </label>
                                </div>
                            </div>
                            @endforeach

                        </fieldset>
                        @endforeach

                    </div>

                </div>
            </div>

                <div class="space15"></div>
                <div class="control-group offset2">
                    <div class="controls">
                        <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
                        <button type="submit" class="btn-large btn-success"><i class="icon-plus"></i>  创建群组</button>
                    </div>
                </div>
            </div>
            <!-- Form Actions -->

            {{Form::close()}}
        </div>
    </div>
</div>
</div>
</div>

@section('myjs')
<script src="{{asset('js/bs-tab-cookie.js')}}"></script>

@stop

@stop