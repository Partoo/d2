 $(document).ready(function(){
    var InterValObj;
    var count = 60;
    var curCount;

    function SetRemainTime() {
        if (curCount === 0) {
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
                                var num = $('#mobileNum').attr('value');
                                var reg = /^0{0,1}(13[0-9]|145|147|15[0-3]|15[5-9]|18[0-9])[0-9]{8}$|^$/;
                                var str = num;
                                var key = $('#key').val();
                                var result = reg.exec(str);
                                if (result === null) {
                                    $('#remember-tip').html('您的手机号码格式不正确');
                                    $('#remember-tip').slideDown();
                                } else if(str===''){
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
                                      url: {{url('sendSms')}},
                                      data: {'key': key,'num':num},
                                      success: success,
                                      dataType: dataType
                                  });
                                    $.ajaxSetup({
                                        url: '{{url('sendSms')}}',
                                        type: 'POST',
                                        dataType: 'text',
                                        data: {'key': key,'num':num},
                                        success: function(data, textStatus) {
                                            if (data.indexOf('1')==-1) {
                                                $("#showKey").html('发送失败,错误代码:'+data).addClass('alert alert-error');
                                            }else{
                                                $("#showKey").html('发送成功').addClass('alert alert-success');
                                            }
                                        }
                                    });
                                    $.post();
                                }

                            });
});