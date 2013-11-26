@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-daterangepicker/daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-tags-input/jquery.tagsinput.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
@stop
@section('pageTitle')
<i class="icon-file-alt"></i>  新建公文
@stop
@section('content')


<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN SAMPLE FORMPORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4>
                    <i class="icon-plus"></i> 创建公文
                </h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!-- BEGIN FORM-->
                {{Form::open(array('files'=>true))}}
                <!-- ROW 1 -->
                <div class="row-fluid">
                    <div class="span8">
                        <div class="control-group {{ $errors->has('subject') ? 'error' : '' }}">
                            <label class="control-label"><i class="icon-file-alt"></i>  公文名称<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <input type="text" class="input-block-level" placeholder="请输入公文名称" name="subject" value="@if( isset($input['subject']) ){{ $input['subject'] }}@endif">
                                   {{$errors->first('subject','<span class="help-inline">:message</span>')}}
                            </div>

                        </div>
                    </div>
                    <div class="span2">
                        <div class="control-group">
                            <label class="control-label">  <i class="icon-th"></i>  公文类别<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <select class="span12" name="category">
                                    @foreach($category as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-share"></i>  发文单位</label>
                            <select class="chzn-select span12" data-placeholder="请选择..." name="creDep">
                                @foreach($creDept as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group {{ $errors->has('docnumber') ? 'error' : '' }}">
                            <label class="control-label"><i class=" icon-barcode"></i>  发文字号<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <input type="text" class="input-block-level" placeholder="请输入发文字号" name="docnumber" value="@if( isset($input['docnumber']) ){{ $input['docnumber'] }}@endif" > {{$errors->first('docnumber','<span class="help-inline">:message</span>')}}
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group {{ $errors->has('tags') ? 'error' : '' }}">
                            <label class="control-label"><i class="icon-tags"></i>  主题词<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <input type="text"  class="input-block-level" placeholder="多个主题词用空格分隔" name="tags" value="@if( isset($input['tags']) ){{ $input['tags'] }}@endif"> {{$errors->first('tags','<span class="help-inline">:message</span>')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="control-group {{ $errors->has('content') ? 'error' : '' }}">
                            <label class="control-label"><i class=" icon-level-up"></i>  公文内容<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <textarea  name="content" class="span12" placeholder="如果有公文附件，可以只填写概要或不填">@if( isset($input['content']) ){{ $input['content'] }} @endif</textarea>{{$errors->first('content','<span class="help-inline">:message</span>')}}
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="control-group {{ $errors->has('file') ? 'error' : '' }}">
                            <label class="control-label"><i class=" icon-level-up"></i>  上传公文</label>
                            <div class="controls controls-row">
                                <input type="file" class="alert alert-info" name="files[]"  multiple="multiple" >{{$errors->first('file','<span class="help-inline">:message</span>')}}
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-bell"></i>  紧急程度</label>
                            <div class="controls controls-row">
                                <select class="span12" name="priority">
                                    @foreach($priority as $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-key"></i>  秘密等级</label>
                            <div class="controls controls-row">
                                <select class="span12" name="seclevel">
                                    @foreach($seclevel as $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row-fluid">
                    <div class="span5">
                        <div class="control-group {{ $errors->has('recievers') ? 'error' : '' }}">
                            <label class="control-label"><i class="icon-foursquare"></i>  选择请批领导<span class="text-error"> *</span></label>
                            <div class="controls controls-row">
                                <select class="chzn-select span12" multiple="multiple" name="recievers[]" >
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>{{$errors->first('recievers','<span class="help-inline">:message</span>')}}
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-code"></i>  备注信息</label>
                            <div class="controls controls-row">
                                <textarea class="message span12" name="message" rows="1"  placeholder="您可以在此填写备注信息">有新的公文，请签阅</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label"><i class="icon-comment-alt"></i>  常用用语</label>
                            <select class="chzn-select span12 sentence" data-placeholder="请选择...">
                                @foreach($commonSentence as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row-fluid">
                    <div class="span12">

                        {{Form::submit('申请批示', array('class'=>'btn btn-large btn-primary'))}}

                    </div>

                </div>
                {{Form::close()}}
                <!-- END FORM-->
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
@section('myjs')
<script src="{{asset('assets/chosen-bootstrap/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>
<script>
$('.sentence').change(function(event) {
    $('.message').val(this.value);
});
</script>
@stop

@stop