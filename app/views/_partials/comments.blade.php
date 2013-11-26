@if($showButtons== 'passed')
                        <div class="alert alert-info">
                                <strong>提示:</strong> 该公文正在准备转发
                            </div>
@elseif($showButtons== 'edit')
    @include('_partials.comments_update')
@elseif($showButtons== 'sign')
    @include('_partials.comments_reply')
@elseif($showButtons== 'signed')
                            <div class="alert alert-success">
                                <strong>提示:</strong> 该公文您已成功签收
                            </div>
@elseif($showButtons=='audit')
    @include('_partials.comments_audit')
@elseif($showButtons=='waitForAudit')
                            <div class="alert alert-info">
                                <strong>提示:</strong> 该公文正在等待审批过程中,请耐心等待
                            </div>
@elseif($showButtons=='redirect')
    @include('_partials.comments_redirect')
@elseif($showButtons=='postDone')
    @include('_partials.comments_postDone')
@elseif($showButtons=='done')
                            <div class="alert alert-success">
                                <strong>提示:</strong> 该公文已顺利办结
                            </div>
@endif

         <!-- BEGIN REPLY -->
          @if ($data->comments->count())
         <div class="media well">
          <span class="label label-info" id="comment"><i class="icon-comments"></i>   公文签收单</span>
          @foreach ($data->comments as $comment)
          <hr>
          <!-- BEGIN REPLY SECTION -->
          <div class="media-body">
           <a href="#" class="pull-left">
             <img alt="" src="" class="media-object">
           </a>
           <h4 class="media-heading">{{$comment->author->username}}</h4>
           <span>{{$comment->created_at->diffForHumans()}}</span>
           <p>{{$comment->comment}}</p>
         </div>
          @endforeach
         <!-- END REPLY SECTION -->
       </div>
                 @endif
       <!-- END REPLY -->