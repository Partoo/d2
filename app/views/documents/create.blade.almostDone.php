@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-daterangepicker/daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-tags-input/jquery.tagsinput.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
<link rel="stylesheet" href="{{asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/bootstrap-wizard/style.min.css')}}">
<!-- <link rel="stylesheet" href="{{asset('assets/jquery-upload/css/jquery.fileupload.css')}}"> -->
@stop
@section('pageTitle')
<i class="icon-file-alt"></i>  新建公文
@stop
@section('breadcrumb')
{{ Breadcrumbs::render('create_doc') }}
@stop
@section('content')

<div class="row-fluid">
  <div class="span12">
    <div class="widget blue">
      <div class="widget-title">
        <h4><i class="icon-plus"></i>创建公文</h4>
      </div>
      <div class="widget-body">
       <!-- START OF VERTICAL WIZARD -->
       {{Form::open(array('files'=>true,'class'=>'form-horizontal','id'=>'docForm'))}}
       <div class="row-fluid">
        <div class="span12 wizard verwizard" id="wizard">
          <div class="span3 hidden-phone">
            <ul class="verticalmenu">
              <li>
                <a href="#step1">
                  <span>第1步: 填写公文概况</span>
                </a>
              </li>
              <li>
                <a href="#step2">
                  <span>第2步: 提交公文内容</span>
                </a>
              </li>
              <li>
                <a href="#step3">
                  <span>第3步: 完善详细资料</span>
                </a>
              </li>
              <li>
                <a href="#step4">
                  <span>第4步: 提交审批</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- END UL MENU -->
          <div class="span9 wizardMain">
            <!-- STEP1 START -->
            <div id="step1">
              <h4><i class="icon-edit"></i> 第一步: 填写公文概况</h4>

              <div class="control-group ">
                <label class="control-label">公文名称 (必填)</label>
                <div class="controls controls-row">
                  <input class="span6 required" placeholder="请输入公文名称" name="subject" value="@if( isset($input['subject']) ){{ $input['subject'] }}@endif" type="text"  />
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">发文字号 (选填)</label>
                <div class="controls controls-row">
                  <input class="span6 " type="text" name="docnumber" placeholder="留空将自动生成字号"  value="@if( isset($input['docnumber']) ){{ $input['docnumber'] }}@endif"   />
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">公文类别(必选)</label>
                <div class="controls controls-row">
                  <select class="span6" name="category">
                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->category}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">发文单位(必选)</label>
                <div class="controls controls-row">
                  <select class="chzn-select span6" data-placeholder="请选择..." name="creDep">
                    @foreach($creDept as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">截止日期(必填)</label>
                <div class="controls controls-row">
                  <input name="expireDate" class="span6 required date" type="text" id="expireDate" data-date-format="yyyy-mm-dd">
                </div>
              </div>
            </div><!--END  -->

            <!-- STEP2 START -->
            <div id="step2">
              <h4><i class="icon-paste"></i> 第二步: 提交公文内容</h4>

              <h4 class="muted">您可以直接上传公文附件 <i class="icon-chevron-down"></i></h4>

              <div class="control-group form" style="border:1px dashed #ccc;">
                <input type="file" name="files[]"  multiple="multiple" >{{$errors->first('file','<span class="help-inline">:message</span>')}}
              </div>
              <h4 class="muted">或者手工填写公文内容 <i class="icon-chevron-down"></i></h4>

              <div class="control-group form" style="border:1px dashed #ccc;">
                <textarea  name="content" class="span12" placeholder="如果有公文附件，可以只填写概要或不填">@if( isset($input['content']) ){{ $input['content'] }} @endif</textarea>{{$errors->first('content','<span class="help-inline">:message</span>')}}
              </div>

            </div><!--END  -->
            <div id="step3">
              <h4><i class="icon-paste"></i> 第三步: 填写详细资料</h4>
              <div class="controls controls-row">
                <select class="span12" name="priority">
                  @foreach($priority as $val)
                  <option value="{{$val}}">{{$val}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div id="step4">444</div>

            {{Form::close()}}

          </div>
        </div>
      </div>
      <!-- END OF VERTICAL WIZARD -->
    </div>
  </div>
</div>
</div>


@section('myjs')
<script src="{{asset('assets/chosen-bootstrap/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{asset('js/form.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>
<script src="{{asset('assets/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/jquery-validation/cn.js')}}"></script>
// <script src="{{asset('assets/jquery-upload/js/vendor/jquery.ui.widget.js')}}"></script>
// <script src="{{asset('assets/jquery-upload/js/jquery.iframe-transport.js')}}"></script>
// <script src="{{asset('assets/jquery-upload/js/jquery.fileupload.js')}}"></script>
<script type="text/javascript">


$(document).ready(function(){



      // FOR DATEPICKER
      var today = new Date();
      $('#expireDate').datetimepicker({
        startDate:today,
        autoclose:true,
        minView:2
      });
      // Smart Wizard
      $('#wizard').smartWizard({onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});

      function leaveAStepCallback(obj){
        var step_num= obj.attr('rel');
        return validateAllSteps();
      }

      function onFinishCallback(){
       if(validateAllSteps()){
        $('#docForm').submit();
      }
    }



    function validateAllSteps(){
      return runValidate();

    }



// jquery validate.js 验证
function runValidate(){
  $('#docForm').validate({
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .closest('.control-group').removeClass('error').addClass('success');
    }
  });
  if ($('#docForm').valid()) {
    return true;
  }else {
    return  false;
  }
}

// 自动填入语句
$('.sentence').change(function(event) {
  $('.message').val(this.value);
});





});

</script>
@stop

@stop