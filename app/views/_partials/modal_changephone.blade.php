<!-- START CHANGE EMAIL MODAL -->
<?php
if (!Session::has('mcode')) {
    $code = App\Libs\Sms::getCode();
    Session::put('mcode',$code);
}
    $key = md5(Session::get('mcode'));
?>
{{Form::open(array('url'=>'account/change-phone'))}}
<div id="changephone" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-body">
        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label"><i class=" icon-envelope-alt"></i>  手机号码</label>
                <div class="controls">
                    <input type="text" class="input-block-level" id="phone" placeholder="请输入您的手机号码" name="phone" value="{{ Input::old('phone', $user->phone) }}">
                            {{Form::hidden('key',$key,array('id'=>'key'))}}

                </div>
            </div>
        </div>
        <!-- FOR TEST BELOW -->
<!-- <div>{{Session::get('mcode')}}</div> -->
        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label"><i class=" icon-lock"></i>  验证码</label>
                 {{Form::input('button', 'authTrigger', '发送验证码', array('id'=>'authTrigger','class'=>'btn btn-success'))}}
                <div class="controls">
                   <input type="text" name="authCode" class="input-block-level" placeholder="请输入您收到的短信验证码">
                </div>
                <div class="alert alert-error hide" id="remember-tip"><i class=" icon-exclamation-sign"></i></div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a class="btn" data-dismiss="modal" aria-hidden="true">取消</a>
        {{Form::submit('提交',array('class'=>'btn-primary'))}}
    </div>
</div>
{{Form::close()}}

<script>

$(document).ready(function(){
    var InterValObj;
    var count = 60;
    var curCount;

    function SetRemainTime() {
        if (curCount == 0) {
                                    window.clearInterval(InterValObj);//停止计时器
                                    $("#authTrigger").removeAttr("disabled");//启用按钮
                                    $("#authTrigger").val("获取短信");
                                }
                                else {
                                    curCount--;
                                    $("#authTrigger").val("请等"+curCount + "秒");
                                }
                            }

                            $('#authTrigger').click(function() {
                                var num = $('#phone').attr('value');
                                var reg = /^0{0,1}(13[0-9]|145|147|15[0-3]|15[5-9]|18[0-9])[0-9]{8}$|^$/;
                                var str = num;
                                var key = $('#key').val();
                                var result = reg.exec(str);
                                if (result == null) {
                                    $('#remember-tip').html('您的手机号码格式不正确');
                                    $('#remember-tip').slideDown();
                                } else if(str==''){
                                    $('#remember-tip').html('您未填写手机号码');
                                    $('#remember-tip').slideDown();
                                }
                                else{
                                    $('#remember-tip').slideUp();
                                    curCount = count;
                                    $("#authTrigger").val("请等"+curCount + "秒");
                                    $("#authTrigger").attr("disabled", "true");
                                    InterValObj = window.setInterval(SetRemainTime, 1000);

                                    $.ajax({
                                      type: "POST",
                                      url: '{{url('sendSms')}}',
                                      data: {'key': key,'num':num},
                                      dataType: 'text',
                                      success: function(data, textStatus) {
                                        if (data.indexOf('1')==-1) {
                                            $("#remember-tip").html('发送失败,错误代码:'+data).addClass('alert alert-error');
                                            $('#remember-tip').slideDown();
                                        }else{
                                            $("#remember-tip").html('发送成功,请查看您的手机短信').addClass('alert alert-success');
                                            $('#remember-tip').slideDown();
                                        };
                                    }
                                });

                                }

                            });
})
</script>