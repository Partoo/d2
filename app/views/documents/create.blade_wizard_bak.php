@extends('_layouts.general')
@section('mycss')
<link rel="stylesheet" href="{{asset('assets/chosen-bootstrap/chosen.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-daterangepicker/daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-tags-input/jquery.tagsinput.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/uniform/css/uniform.default.css')}}" />
<link rel="stylesheet" href="{{asset('assets/bootstrap-datetimepicker/css/datepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/bootstrap-wizard/style.min.css')}}">
@stop
@section('pageTitle')
<i class="icon-file-alt"></i>  新建公文
@stop
@section('breadcrumb')
{{ Breadcrumbs::render('create_doc') }}
@stop
@section('content')


<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN SAMPLE FORMPORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4>
                    <i class="icon-plus"></i> 创建公文
                </h4>
            </div>
            <div class="widget-body collapse in" id="acc-wizard">
                <div class="widget-inner">

                    <div class="row-fluid acc-wizard">
                      <div class="span3" style="padding-left: 1em;">
                        <p style="margin-bottom: 2em;">
                          该向导将引导您轻松完成公文的新建。
                      </p>
                      <ol class="acc-wizard-sidebar">
                          <li class="acc-wizard-todo acc-wizard-active"><a href="#prerequisites" data-original-title="">公文概况</a></li>
                          <li class="acc-wizard-todo"><a href="#addwizard" data-original-title="">公文内容</a></li>
                          <li class="acc-wizard-todo"><a href="#adjusthtml" data-original-title="">其它选项</a></li>
                          <li class="acc-wizard-todo"><a href="#viewpage" data-original-title="">核对提交</a></li>
                      </ol>

                  </div>
                  <div class="span9">
                    <div class="accordion" id="accordion-demo">
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-demo" href="#prerequisites">
                            请填写公文的相关信息
                        </a>
                    </div>
                    <div id="prerequisites" class="accordion-body collapse in">

                      <div class="accordion-inner">

                      <!-- BEGIN FORM-->
                        {{Form::open(array('files'=>true))}}

                            The accordion wizard depends on two other open source packages:
                            <ul>
                              <li>The Bootstrap framework, available <a href="http://twitter.github.com/bootstrap/index.html">here</a>.
                                  <li>The jQuery javascript library, available <a href="http://jquery.com">here</a>.
                                  </ul>
                                  Note that Bootstrap itself depends on jQuery for its interactive
                                  components, so if you're using Bootstrap you probably already have
                                  jQuery as well.

                                  <p>
                                    You'll include the CSS styles for Bootstrap in the
                                    <code>&lt;head&gt;</code> of your HTML file, for example:
                                </p>
                            {{Form::close()}}
                        </div> <!--/.accordion-inner -->
                    </div> <!-- /#prerequisites -->
                </div> <!-- /.accordion-group -->

                <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-demo" href="#addwizard">
                        Add Accordion Wizard
                    </a>
                </div>
                <div id="addwizard" class="accordion-body collapse in">
                  <div class="accordion-inner">
                    {{Form::open(array('files'=>true))}}
                      <p>
                        If you haven't already found it, the source code for the
                        accordion wizard is available on github
                        <a href="https://github.com/sathomas/acc-wizard">here</a>.
                        There are two main folders, <code>/src</code> and
                        <code>/release</code>.
                    </p>
                    Alternatively, if you're building custom CSS and javascript,
                    then you might want to start with the files in the <code>/src</code>
                    folder and adapt them to your source code. The <code>/src</code>
                    folder contains a LESS file and uncompressed (and commented)
                    javascript. Note that the <code>acc-wizard.less</code> file
                    depends on variables defined in Bootstrap's <code>variables.less</code>
                    file.
                {{Form::close()}}
            </div> <!--/.accordion-inner -->
        </div> <!-- /#addwizard -->
    </div> <!-- /.accordion-group -->

    <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-demo" href="#adjusthtml">
            Adjust Your HTML Markup
        </a>
    </div>
    <div id="adjusthtml" class="accordion-body collapse in">
      <div class="accordion-inner">
        {{Form::open(array('files'=>true))}}
          <p>
            Now you can modify your HTML markup to activate the accordion
            wizard. There are two parts to the markup&mdash;the collapsible
            accordion itself and the task list. I prefer putting both in
            the same <code>.row</code> with the task list taking up a
            <code>.span3</code> and the accordion panels in a <code>.span9</code>,
            but that's not a requirement.
        </p>

        The default options are probably fine for most uses, but
        there are many customizations you can use when you activate
        the wizard. Check out the documentation on
        <a href="https://github.com/sathomas/acc-wizard">github</a>
        for the details.
    {{Form::close()}}
</div> <!--/.accordion-inner -->
</div> <!-- /#adjusthtml -->
</div> <!-- /.accordion-group -->

<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-demo" href="#viewpage1">
        Test Your Page
    </a>
</div>
<div id="viewpage1" class="accordion-body collapse in">
  <div class="accordion-inner">
    {{Form::open(array('files'=>true))}}
      <p>
        Naturally, the last thing you'll want to do is test your
        page with the accordion wizard. Once you've confirmed that
        it's working as expected, release it on the world. Your
        users will definitely appreciate the feedback and guidance
        it gives to multi-step and complex tasks on your web site.
    </p>
{{Form::close()}}
</div> <!--/.accordion-inner -->
</div> <!-- /#viewpage -->
</div> <!-- /.accordion-group -->

</div>
</div>
</div>


</div>
</div>
</div>
<!-- END SAMPLE FORM PORTLET-->
</div>
</div>
@section('myjs')
<script src="{{asset('assets/chosen-bootstrap/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/uniform/jquery.uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-datetimepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
$("#expireDate").datepicker();
</script>
<script src="{{asset('js/form.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>

<script>
if($(".acc-wizard").length > 0){
   function onNext(parent, panel) {
      hash = "#" + panel.id;
      $(".acc-wizard-sidebar",$(parent))
      .children("li")
      .children("a[href='" + hash + "']")
      .parent("li")
      .removeClass("acc-wizard-todo")
      .addClass("acc-wizard-completed");
  }

  $(".acc-wizard").accwizard({onNext: onNext});
}
$('.sentence').change(function(event) {
    $('.message').val(this.value);
});
</script>
@stop

@stop