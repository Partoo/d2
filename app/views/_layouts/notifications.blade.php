<!-- This file is nested in Javascript. That means the code below are all the js -->
var stack_topleft = {"dir1": "down", "dir2": "left", "firstpos1": 55, "firstpos2": 25};
$.pnotify.defaults.history = false;
$.pnotify.defaults.nonblock = false;
@if ($message = Session::get('success'))
	$.pnotify({
		title:'操作完成',
		text:'{{$message}}',
		icon:'icon-ok',
		type:'success',
        		stack: stack_topleft,
        		animation: 'show'
	})
@endif

@if ($message = Session::get('error'))
	$.pnotify({
		title:'错误',
		text:'{{$message}}',
		icon:'icon-remove',
		type:'error',

        		stack: stack_topleft,
        		animation: 'show'
	})
@endif

@if ($message = Session::get('warning'))
	$.pnotify({
		title:'注意',
		text:'{{$message}}',
		icon:'icon-exclamation',
		type:'warning',

        		stack: stack_topleft,
        		animation: 'show'
	})
@endif

@if ($message = Session::get('info'))
	$.pnotify({
		title:'提示',
		text:'{{$message}}',
		icon:'icon-info',
		type:'info',

        		stack: stack_topleft,
        		animation: 'show'
	})
@endif
