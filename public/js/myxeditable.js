
jQuery(document).ready(function() {
   $('.edit').editable({
    url: '{{route('param/update')}}',
    title: '请填写您要修改的内容',
    success: function(response, newValue) {
        $.pnotify({
            title:'  操作提示',
            text:response,
            icon:'icon-info',
            type:'info',
            stack: stack_topleft,
            animation: 'show'
        })
    }
});

//删除的前端视觉代码
   $('.removehandle').toggle(function() {
    $('.remove-btn').css('display', '');
}, function() {
    $('.remove-btn').css('display', 'none');
});

//新建内容 前端处理代码
   $('.createbox').editable({
    url: '{{route('param')}}' //this url will not be used for creating new user, it is only for update
});

   $('.createbox').editable('option', 'validate', function(v) {

    if(!v) {
        return '这里怎么能不填点什么呢'}
        else{
            $('.save-btn').css('display', '');
        };

    });

   $('.save-btn').click(function(event) {
     $('.createbox').editable('submit', {
         url: '{{route('param')}}',
         ajaxOptions: {
           dataType: 'json' //assuming json response
       },
       success: function(data, config) {
           if(data && data.id) {  //record created, response like {"id": 2}
               //set pk
           $(this).editable('option', 'pk', data.id);
               //remove unsaved class
               $(this).removeClass('editable-unsaved');

               $('.save-btn').hide();
               document.location.reload();
           } else if(data && data.errors){
               //server-side validation error, response like {"errors": {"username": "username already exist"} }
               config.error.call(this, data.errors);
           }
       },
       error: function(errors) {
         var msg = '';
           if(errors && errors.responseText) { //ajax error, errors = xhr object
             msg = errors.responseText;
           } else { //validation error (client-side or server-side)
             $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
         }
         $.pnotify({
            title:'  操作提示',
            text:msg,
            icon:'icon-info',
            type:'info',
            stack: stack_topleft,
            animation: 'show'
        });
     }
 });
});

$('#categoryEditor .remove-btn').click(function(event) {
    event.preventDefault();
    var href = $(this).attr('href');
    bootbox.confirm("此操作可能造成公文数据混乱,你确定执行吗?",function(isOk){
        if (isOk) {
          location.href=href;
      };
  });
});


});
