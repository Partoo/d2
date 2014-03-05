


<div class="post-comment well">

    <hr>
    {{Form::open()}}
    <label>公文办结备注</label>
    <textarea class="span12" name="comment" rows="8" placeholder="您可以在此填写备注，但提交后将不能修改。"></textarea>
    <div class="alert alert-danger">
      <strong>操作提示:</strong> 除非特殊情况,请在所有人员签收后执行办结。
  </div>
  <p>{{Form::submit('提交办结',array('class'=>'btn btn-large btn-warning','name'=>'postDone'))}}
  </p>

  {{Form::close()}}
</div>