
<div class="post-comment well">
    {{Form::open()}}
    <div class="row-fluid">
            填写审核意见
    <a class="btn btn-success pull-right"  id="btn_helper">输入助手</a>
    </div>
    <hr>
    <div class="row-fluid"  style="display:none" id="helper">
        <div class="span4">
            <div class="widget-title">
                <h4> 情态动词</h4>
            </div>
            <div class="widget-body">
                            @foreach(\Setting::get('site_const.modalVerb') as $verb)
            <a href="" class="btn btn-info">{{$verb}}</a>
            @endforeach
            </div>
        </div>
        <div class="span4">
            <div class="widget-title">
                <h4> 部门人员</h4>
            </div>
            <div class="widget-body" id="recievers">
                            <select data-placeholder="请选择对象" class="chzn-select span12" multiple="multiple" name="recievers[]" tabindex="6">

                  @foreach($units as $key => $unit)
                  <optgroup label="{{$unit->name}}">
                    <?php $arr = \DB::table('users_units')->where('unit_id','=',$unit->id)->get();
                    ?>
                    @foreach($arr as  $val))<option value="{{\Sentry::findUserById($val->user_id)->username}}">{{\Sentry::findUserById($val->user_id)->username}}</option>@endforeach
                  </optgroup>
                  @endforeach
                </select>
                <div class="space10"></div>
                <div id="insertUsers" class="btn btn-primary">插入语句中</div>
            </div>
        </div>

<div class="span4">
            <div class="widget-title">
                <h4> 执行动作</h4>
            </div>
            <div class="widget-body">
                            @foreach(\Setting::get('site_const.action') as $action)
            <a href="" class="btn btn-info">{{$action}}</a>
            @endforeach
            </div>
        </div>
    </div>
    <textarea id="comment" class="span12" name="comment" rows="8" placeholder="您可以在此填写您的签收意见，但提交后将不能修改。"></textarea>
    <p>{{Form::submit('提交拟办意见',array('class'=>'btn btn-large btn-warning','name'=>'doc_preAudit'))}}
        {{Form::submit('直接审核通过',array('class'=>'btn btn-large btn-info','name'=>'doc_pass'))}}
        {{Form::submit('退回公文',array('class'=>'btn btn-large btn-danger','name'=>'doc_cancel'))}}
    </p>
    {{Form::close()}}
</div>