
          <div class="post-comment well">
            <hr>

            {{Form::open()}}
             <label>填写反馈信息 </label>
             <textarea class="span12" name="comment" rows="8" placeholder="您可以在此填写您的签收意见，但提交后将不能修改。"></textarea>
                      <p>{{Form::submit('提交反馈',array('class'=>'btn btn-large btn-info','name'=>'doc_signed'))}}</p>
           {{Form::close()}}
         </div>