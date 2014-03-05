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
                <label class="control-label">公文名称 (*)</label>
                <div class="controls controls-row">
                  <input class="span6 required" placeholder="请输入公文名称" name="subject" value="@if( isset($input['subject']) ){{ $input['subject'] }}@endif" type="text"  />
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">发文字号 </label>
                <div class="controls controls-row">
                  <input class="span6 " type="text" name="docnumber" placeholder="留空将自动生成字号"  value="@if( isset($input['docnumber']) ){{ $input['docnumber'] }}@endif"   />
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">公文类别(*)</label>
                <div class="controls controls-row">
                  <select class="span6" name="category">
                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->category}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">发文单位(*)</label>
                <div class="controls controls-row">
                  <select class="chzn-select span6" data-placeholder="请选择..." name="creDep">
                    @foreach($creDept as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group ">
                <label class="control-label">截止日期(*)</label>
                <div class="controls controls-row">
                  <input name="expireDate" placeholder="您可以选择最终办理截止日期" class="span6 date" type="text" id="expireDate" data-date-format="yyyy-mm-dd">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">紧急程度</label>
                <div class="controls">
                  <select class="span6" name="priority" id="priority">
                    <option value="普通">普通</option>
                    <option value="紧急">紧急</option>
                    <option value="特急">特急</option>
                  </select>
                </div>
              </div>
            </div><!--END  -->

            <!-- STEP2 START -->
            <div id="step2">
              <h4><i class="icon-paste"></i> 第二步: 提交公文内容</h4>
              <div style="border:1px dashed #ccc;margin-bottom:10px;padding:10px">
                <h5>您可以直接上传公文附件 <i class="icon-chevron-down"></i></h5>
                <div class="control-group form" >
                  <input type="file" class="content-group" id="files" name="files[]"  multiple="multiple" >{{$errors->first('file','<span class="help-inline">:message</span>')}}
                </div>
              </div>
              <div style="border:1px dashed #ccc;padding:10px">
                <h5>或者手工填写公文内容 <i class="icon-chevron-down"></i></h5>
                <div class="control-group form">
                  <textarea  name="content"  class="span12 content-group" placeholder="如果有公文附件，可以只填写概要或不填">@if( isset($input['content']) ){{ $input['content'] }} @endif</textarea>{{$errors->first('content','<span class="help-inline">:message</span>')}}
                </div>
              </div>

            </div><!--END  -->
            <!-- STEP3 START -->
            <div id="step3">
              <h4><i class="icon-list"></i> 第三步: 完善公文详细资料</h4>

              <div class="control-group ">
                <label class="control-label">发文单位(*)</label>
                <div class="controls controls-row">
                  <select class="chzn-select" data-placeholder="请选择..." name="creDep">
                    @foreach($creDept as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="control-group ">
                <label class="control-label">公文类别(*)</label>
                <div class="controls controls-row">
                  <select  name="category">
                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->category}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group ">
                <label class="control-label">机密等级(*)</label>
                <div class="controls controls-row">
                  <select  name="seclevel">
                    @foreach($seclevel as $val)
                    <option value="{{$val}}">{{$val}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group ">
                <label class="control-label">主题词(*)</label>
                <div class="controls controls-row">
                  <input type="text" class="required"  placeholder="多个主题词用空格分隔" name="tags" value="@if( isset($input['tags']) ){{ $input['tags'] }}@endif"> {{$errors->first('tags','<span class="help-inline">:message</span>')}}
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">持续跟踪吗？</label>
                <div class="controls">
                  <div id="tracked">
                    <!-- <input type="checkbox" name="constantTrack" class="toggle" checked="yes" /> -->
                    {{Form::checkbox('constantTrack', 'yes', array('class'=>'toggle'))}}
                  </div>
                </div>

              </div>


            </div><!--END  -->
            <!-- STEP 4 START -->
            <div id="step4">
              <h4><i class="icon-list"></i> 第四步: 提交审批</h4>

              <div class="control-group ">
                <label class="control-label">选择审批领导(*)</label>
                <div class="controls controls-row">
                  <select class="chzn-select span12" multiple="multiple" id="recievers" name="recievers[]">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->username}}</option>
                    @endforeach
                  </select>{{$errors->first('recievers','<span class="help-inline">:message</span>')}}
                </div>
              </div>


              <div class="control-group ">
                <label class="control-label">常用用语</label>
                <div class="controls controls-row">
                  <select class="chzn-select span12 sentence" data-placeholder="请选择...">
                    @foreach($commonSentence as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group ">
                <label class="control-label">备注信息</label>
                <div class="controls controls-row">
                  <textarea class="message span12" name="message" rows="1"  placeholder="您可以在此填写备注信息">有新的公文请您批示</textarea>
                </div>
              </div>


            </div>

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

<script type="text/javascript" src="{{asset('assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>
<script src="{{asset('assets/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/jquery-validation/cn.js')}}"></script>
<script src="{{asset('assets/jquery-validation/additional-methods.min.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script type="text/javascript">


$(document).ready(function(){



      // FOR DATEPICKER
      var today = new Date();
      $('#expireDate')
      .datetimepicker({
        startDate:today,
        autoclose:true,
        minView:2,
      })
      .on('changeDate',function(e){
          //
          changePriority();
        })
      //计算当前时间与截止时间的时间差
      function timeDiff() {
        var today = new Date();
        var future = new Date($('#expireDate').val().replace(/\-/g, "/"));
        var diffTime = future.getTime()-today.getTime();
        var diffDay = Math.floor(diffTime/(24*3600*1000))+1;
        return diffDay;
      }
      function changePriority(){
        if (timeDiff()<=3) {
          $('#priority').get(0).selectedIndex=2;
        } else if(timeDiff()<=7){
          $('#priority').get(0).selectedIndex=1;
        } else{
          $('#priority').get(0).selectedIndex=0;
        }
      }


      // Smart Wizard
      $('#wizard').smartWizard({
        onLeaveStep:leaveAStepCallback,
        onFinish:onFinishCallback,
        enableFinishButton:false
      });

      function leaveAStepCallback(obj){
        // var step_num= obj.attr('rel');
        return validateAllSteps();
      }

      function onFinishCallback(){
       if ($('#recievers').val()==null) {
        alert('您没有选择审批领导')
       } else{
            if(validateAllSteps()){
            $('#docForm').submit();
          }
       };

    }


    function validateAllSteps(){
      return runValidate();

    }

// jquery validate.js 验证
function runValidate(){


  $('#docForm').validate({
    rules: {
      'files[]': {
        require_from_group: [1, ".content-group"]
      },
      'content': {
        require_from_group: [1, ".content-group"]
      }

    },

    messages:{
      'files[]':"公文附件或文本内容至少输入一个",
      'content':"公文附件或文本内容至少输入一个"
    },
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

    $('#tracked').toggleButtons({
      width: 220,
        label: {
            enabled: "无需持续跟踪",
            disabled: "需要持续跟踪"
        },
        style:{
          enabled:"danger",
          disabled:"success"
        }
    });

// 自动填入语句
$('.sentence').change(function(event) {
  $('.message').val(this.value);
});





});

</script>
@stop

@stop