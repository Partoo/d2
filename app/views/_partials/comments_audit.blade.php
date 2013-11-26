
<div class="post-comment well">
    <hr>
    {{Form::open()}}
    <label>填写审核意见</label>
    <textarea class="span12" name="comment" rows="8" placeholder="您可以在此填写您的签收意见，但提交后将不能修改。"></textarea>
    <p>{{Form::submit('提交拟办意见',array('class'=>'btn btn-large btn-warning','name'=>'doc_preAudit'))}}
        {{Form::submit('直接审核通过',array('class'=>'btn btn-large btn-info','name'=>'doc_pass'))}}
        {{Form::submit('退回公文',array('class'=>'btn btn-large btn-danger','name'=>'doc_cancel'))}}
    </p>
    {{Form::close()}}
</div>