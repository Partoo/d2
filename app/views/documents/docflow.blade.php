@extends('_layouts.general')
@section('content')
@section('breadcrumb')
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
 公文详情
</h3>
{{ Breadcrumbs::render('docflow',$docid) }}
<!-- END PAGE TITLE & BREADCRUMB-->
@stop

<?php
    function color($val){
        $arr=[];
        switch ($val) {
            case '0':
                return $arr=['orange','icon-plus'];
                break;

            case '1':
                return $arr=['green','icon-check'];
                break;

            case '2':
                return $arr=['red','icon-minus'];
                break;

            case '3':
                return $arr=['purple','icon-external-link'];
                break;

            case '4':
                return $arr=['blue','icon-edit-sign'];
                break;

            case '5':
                return $arr=['red','icon-briefcase'];
                break;

            case '6':
                return $arr=['brown','icon-archives'];
                break;

            case '7':
                return $arr=['brown','icon-check-sign'];
                break;
        }
    }
?>

<div class="row-fluid">
                 <ul class="metro_tmtimeline">
                    @foreach($flows as $flow)
                        <li class="{{color($flow->type)[0]}}">
                            <div class="metro_tmtime">
                                <span class="date">{{date('Y',strtotime($flow->created_at)).'年'.date('m',strtotime($flow->created_at)).'月'.date('j',strtotime($flow->created_at)).'日'}}</span>
                                <span class="time">{{date('H',strtotime($flow->created_at)).':'.date('i',strtotime($flow->created_at))}}</span>
                            </div>
                            <div class="metro_tmicon">
                                <i class="{{color($flow->type)[1]}}"></i>
                            </div>
                            <div class="metro_tmlabel">
                                <h2>{{$flow->event}}</h2>
                                <p>{{$flow->comments}}</p>
                            </div>
                        </li>
                    @endforeach
                    </ul>
            </div>

@stop