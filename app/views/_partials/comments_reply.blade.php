
          <div class="post-comment well">
            <hr>
            <div class="row-fluid">
                <div class="row">1</div>
                <div class="row">2</div>
                <div class="row">3</div>
            </div>
            {{Form::open()}}
             <label>填写签收反馈 </label>
             <textarea class="span12" name="comment" rows="8" placeholder="您可以在此填写您的签收意见，但提交后将不能修改。"></textarea>
                      <p>{{Form::submit('签收公文',array('class'=>'btn btn-large btn-info','name'=>'doc_signed'))}}</p>
           {{Form::close()}}
         </div>