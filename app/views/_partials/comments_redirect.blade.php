<div class="alert alert-info">
  <strong>操作提示:</strong> 您可以根据审批意见从下面的列表中选取用户进行公文传输
</div>
<div class="row-fluid">
 <div class="feedback">

   {{Form::open()}}
   <div class="control-group ">
    <div class="controls controls-row">
      <select data-placeholder="请选择发送对象" class="chzn-select span12" multiple="multiple" name="recievers[]" tabindex="6">

        @foreach($units as $key => $unit)
        <optgroup label="{{$unit->name}}">
          <?php $arr = \DB::table('users_units')->where('unit_id','=',$unit->id)->get();
          ?>
          @foreach($arr as  $val))<option value="{{$val->user_id}}">{{\Sentry::findUserById($val->user_id)->username}}</option>@endforeach
        </optgroup>
        @endforeach
      </select>
    </div>
  </div>
  <div class="text-center">
    {{Form::submit('转发公文',array('class'=>'btn btn-info btn-large','name'=>'redirect'))}}
 </div>
 {{Form::close()}}
</div>
</div>