@extends('_layouts.general')

@section('pageTitle')
<i class="icon-plus"></i>  创建部门
@stop

@section('content')
@section('breadcrumb')
@parent
@stop

<div class="row-fluid">
   <div class="span12">
    <div class="widget blue">
        <div class="widget-title">
            <h4><i class="icon-reorder"></i> 创建部门</h4>
            <span class="tools">
               <a href="javascript:;" class="icon-chevron-down"></a>
           </span>
       </div>
       <div class="widget-body">
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#general">常用管理</a></li>
            </ul>
            {{Form::open(array('class'=>'form-horizontal'))}}
            <div class="tab-content ">
                <div id="general" class="tab-pane fade in active">
                    <!-- 用户姓名 -->
                    <div class="control-group offset3 {{ $errors->has('name') ? 'error' : '' }}">
                        <label for="unitname" class="control-label"><i class="icon-sitemap"></i>  部门名称</label>
                        <div class="controls"><input type="text" name="name">
                            {{$errors->first('name','<span class="help-inline">:message</span>')}}
                        </div>
                    </div>
                </div>

                <div class="space15"></div>
                <div class="control-group offset2">
                    <div class="controls">
                        <button type="reset" class="btn-inverse btn-large"><i class="icon-undo"></i>  重置</button>
                        <button type="submit" class="btn-large btn-success"><i class="icon-plus"></i>  创建部门</button>
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