<!-- START CHANGE EMAIL MODAL -->
{{Form::open(array('url'=>'account/change-email'))}}
<div id="changemail" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-body">
        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label"><i class=" icon-envelope-alt"></i>  填写邮箱</label>
                <div class="controls">
                    <input type="text" class="input-block-level" placeholder="请输入您的邮箱(不要使用QQ信箱)" name="email" value="{{ Input::old('email', $user->email) }}">
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label"><i class=" icon-lock"></i>  当前密码</label>
                <div class="controls">
                    {{Form::password('password', array('class'=>'input-block-level','placeholder'=>'请输入您当前使用的密码以验证操作'))}}
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a class="btn" data-dismiss="modal" aria-hidden="true">取消</a>
        {{Form::submit('提交',array('class'=>'btn-primary'))}}
    </div>
</div>
{{Form::close()}}