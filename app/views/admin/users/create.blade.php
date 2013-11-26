@extends('_layouts.general')

@section('pageTitle')
<i class="icon-plus"></i>  创建用户
@stop

@section('content')
@section('breadcrumb')
@parent
@stop

<div class="row-fluid">
 <div class="span12">
    <div class="widget blue">
        <div class="widget-title">
            <h4><i class="icon-reorder"></i> 用户管理</h4>
            <span class="tools">
             <a href="javascript:;" class="icon-chevron-down"></a>
         </span>
     </div>
     <div class="widget-body">
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#general">常用管理</a></li>
                <li class=""><a data-toggle="tab" href="#permissions">权限分配</a></li>
            </ul>
            {{Form::open(array('class'=>'form-horizontal'))}}
            <div class="tab-content ">
                <div id="general" class="tab-pane fade in active">
                    <!-- 用户姓名 -->
                    <div class="control-group offset3 {{ $errors->has('username') ? 'error' : '' }}">
                        <label for="username" class="control-label"><i class="icon-user"></i>  用户姓名</label>
                        <div class="controls"><input type="text" name="username" value="{{Input::old('username')}}">
                            {{$errors->first('username','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- 手机号码 -->
                    <div class="control-group offset3 {{ $errors->has('phone') ? 'error' : '' }}">
                        <label for="phone" class="control-label"><i class=" icon-mobile-phone"></i>  手机号码</label>
                        <div class="controls"><input type="text" name="phone" value="{{Input::old('phone')}}">
                            {{$errors->first('phone','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- 邮箱 -->
                    <div class="control-group offset3 {{ $errors->has('email') ? 'error' : '' }}">
                        <label for="email" class="control-label"><i class="icon-envelope-alt"></i>  电子邮箱</label>
                        <div class="controls"><input type="text" name="email" value="{{Input::old('email')}}">
                            {{$errors->first('email','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="control-group offset3 {{ $errors->has('password') ? 'error' : '' }}">
                        <label class="control-label" for="password"><i class=" icon-key"></i>  设置密码</label>
                        <div class="controls">
                            <input type="password" name="password" id="password" value="" />
                            {{ $errors->first('password', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- Password Confirm -->
                    <div class="control-group offset3 {{ $errors->has('password_confirm') ? 'error' : '' }}">
                        <label class="control-label" for="password_confirm"><i class="icon-rotate-right"></i>  密码确认</label>
                        <div class="controls">
                            <input type="password" name="password_confirm" id="password_confirm" value="" />
                            {{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- 激活状态 -->
                    <div class="control-group offset3">
                        <label for="activated" class="control-label"><i class="icon-rss"></i>  激活用户</label>
                        <div class="controls">
                            <select name="activated" id="activated">
                        <option value="1"{{ (Input::old('activated', 0) === 1 ? ' selected="selected"' : '') }}>激活</option>
                        <option value="0"{{ (Input::old('activated', 0) === 0 ? ' selected="selected"' : '') }}>未激活</option>
                    </select>
                            {{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- 部门 -->
                    <div class="control-group offset3 {{ $errors->has('groups') ? 'error' : '' }}">
                        <label class="control-label" for="groups"><i class="icon-sitemap"></i>  所属部门</label>
                        <div class="controls">
                            <select name="unit">
                                @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <!-- 用户组 -->
                    <div class="control-group offset3 {{ $errors->has('groups') ? 'error' : '' }}">
                        <label class="control-label" for="groups"><i class="icon-group"></i>  用户组</label>
                        <div class="controls">
                            <select name="groups[]" id="groups[]" multiple="multiple">
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                        </div>
                    </div>
                </div>
                <div id="permissions" class="tab-pane fade">
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
                                    <input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
                                    拒绝
                                </label>
                                </div>

                                @if ($permission['can_inherit'])
                                <div class="radio">
                                    <label for="{{ $permission['permission'] }}_inherit" onclick="">
                                    <input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
                                   继承
                                </label>
                                </div>
                                @endif
                            </div>
                            @endforeach

                        </fieldset>
                        @endforeach

                    </div>

                </div>
            </div>
                                <div class="control-group offset2">
                        <div class="controls">
                            <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
                            <button type="submit" class="btn-large btn-success"><i class="icon-plus"></i>  创建用户</button>
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
<!-- <script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script> -->

@stop

@stop