<!-- START CHANGE UNIT MODAL -->
{{Form::open(array('url'=>'account/change-unit'))}}
<div id="changeunit" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-body">
        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label"><i class=" icon-sitemap"></i>  请选择部门</label>
                <div class="controls">
                                        <select name="unit" class="input-large m-wrap" tabindex="1">
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
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