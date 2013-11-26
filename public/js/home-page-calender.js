var Script = function () {

//    calender

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        buttonText:{
             prev:     '上月',
             next:     '下月',
             prevYear: '去年',
             nextYear: '明年',
             today:    '今天',
             month:    '月',
             week:     '周',
             day:      '日'
        },
        editable: true,

        events: [
            {
                title: '服务器硬件接入',
                start: new Date(y, m, 12)
            },
            {
                title: '服务器系统配置及调试',
                start: new Date(y, m, 15),
                end: new Date(y,m,16)
            },
               {
                title: '服务器硬件及压力测试',
                start: new Date(y, m,17),
                end: new Date(y, m,18)
            },
            {
                title: '办公系统-用户及公文传输功能模块调试',
                start: new Date(y, m,19),
                end: new Date(y, m,20)
            },
            {
                title: '已发现问题集中整改',
                start: new Date(y, m,21),
                end: new Date(y, m,22)
            },
            {
                title: '附属功能模块测试',
                start: new Date(y, m,23),
                end: new Date(y, m,28)
            },
            {
                title: '项目整体调试完毕,修复所有问题',
                start: new Date(y, m, 29),
                end: new Date(y, m, 31),
                url: 'http://google.com/'
            }
        ]
    });


}();

