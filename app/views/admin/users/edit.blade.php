@extends('_layouts.general')

@section('pageTitle')
<i class="icon-edit"></i>  修改用户:{{$user->username}}
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
                <li class=""><a data-toggle="tab" href="#safety">账号安全</a></li>
            </ul>
            {{Form::open(array('class'=>'form-horizontal'))}}
            <div class="tab-content ">
                <div id="general" class="tab-pane fade in active offset3">
                    <!-- 用户姓名 -->
                    <div class="control-group {{ $errors->has('username') ? 'error' : '' }}">
                        <label for="username" class="control-label"><i class="icon-user"></i>  用户姓名</label>
                        <div class="controls"><input type="text" name="username" value="{{Input::old('username',$user->username)}}">
                            {{$errors->first('username','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- 手机号码 -->
                    <div class="control-group{{ $errors->has('phone') ? 'error' : '' }}">
                        <label for="phone" class="control-label"><i class=" icon-mobile-phone"></i>  手机号码</label>
                        <div class="controls"><input type="text" name="phone" value="{{Input::old('phone',$user->phone)}}">
                            {{$errors->first('phone','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- 邮箱 -->
                    <div class="control-group{{ $errors->has('email') ? 'error' : '' }}">
                        <label for="email" class="control-label"><i class="icon-envelope-alt"></i>  电子邮箱</label>
                        <div class="controls"><input type="text" name="email" value="{{Input::old('email',$user->email)}}">
                            {{$errors->first('email','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="control-group{{ $errors->has('password') ? 'error' : '' }}">
                        <label class="control-label" for="password"><i class=" icon-key"></i>  设置密码</label>
                        <div class="controls">
                            <input type="password" name="password" id="password" value="" />
                            {{ $errors->first('password', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- Password Confirm -->
                    <div class="control-group{{ $errors->has('password_confirm') ? 'error' : '' }}">
                        <label class="control-label" for="password_confirm"><i class="icon-rotate-right"></i>  密码确认</label>
                        <div class="controls">
                            <input type="password" name="password_confirm" id="password_confirm" value="" />
                            {{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- 激活状态 -->
                    <div class="control-group">
                        <label for="activated" class="control-label"><i class="icon-rss"></i>  激活用户</label>
                        <div class="controls">
                            <select name="activated">
                                {{$user->id===Sentry::getId()?'disabled="disabled"' : ''}}
                                <option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>已激活</option>
                                <option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>未激活</option>
                            </select>
                            {{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    <!-- 部门 -->
                    <div class="control-group{{ $errors->has('groups') ? 'error' : '' }}">
                        <label class="control-label" for="groups"><i class="icon-sitemap"></i>  所属部门</label>
                        <div class="controls">
                            <select name="unit">
                                @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"{{ (array_key_exists($unit->id, $userUnits) ? ' selected="selected"' : '') }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <!-- 用户组 -->
                    <div class="control-group{{ $errors->has('groups') ? 'error' : '' }}">
                        <label class="control-label" for="groups"><i class="icon-group"></i>  用户组</label>
                        <div class="controls">
                            <select name="groups[]" multiple>
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}"{{ (array_key_exists($group->id, $userGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- 权限TAB -->
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
                                        <input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
                                        允许
                                    </label>
                                </div>

                                <div class="radio">
                                    <label for="{{ $permission['permission'] }}_deny" onclick="">
                                        <input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
                                        拒绝
                                    </label>
                                </div>

                                @if ($permission['can_inherit'])
                                <div class="radio">
                                    <label for="{{ $permission['permission'] }}_inherit" onclick="">
                                        <input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($userPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
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
            <!-- 安全管理TAB -->
            <div id="safety" class="tab-pane fade">
                <div class="controls">
                    <div class="control-group">
                        <fieldset>
                            <legend>{{$user->username}} 当前账号状态{{Sentry::findThrottlerByUserId($user->id)->isSuspended()?' <span class="text-error">  冻结中</span>':'<span class="text-success">  未冻结</span>'}}</legend>

                            {{Sentry::findThrottlerByUserId($user->id)->isSuspended()?'<div class="radio"><label for="disallow"><input type="radio" value="0" id="disallow" name="suspend">解除冻结</label></div>':'<div class="radio"><label for="allow"><input type="radio" value="1" id="allow" name="suspend">冻结账号</label></div>'}}


                        </fieldset>

                    </div>

                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="control-group offset2">
                <div class="controls">
                    <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
                    <button type="submit" class="btn-large btn-success"><i class="icon-edit"></i>  修改用户</button>
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



@stop