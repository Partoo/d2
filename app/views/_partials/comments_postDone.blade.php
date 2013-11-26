


<div class="post-comment well">
    <hr>
    <div class="alert alert-info">
  <strong>操作提示:</strong> 除非特殊情况,请在所有人员签收后执行办结。
</div>
    {{Form::open()}}
    <label>可填写备注</label>
    <textarea class="span12" name="comment" rows="8" placeholder="您可以在此填写备注，但提交后将不能修改。"></textarea>
    <p>{{Form::submit('提交办结',array('class'=>'btn btn-large btn-warning','name'=>'postDone'))}}
    </p>
    {{Form::close()}}
</div>