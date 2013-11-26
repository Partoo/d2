<div class="row-fluid">
    <div class="flowstep">
        <ol class="flowstep-5">
            <li class="step-first">
                <div class="step-done">
                    <div class="step-name">登记公文</div>
                    <div class="step-no"></div>
                </li>

                @if($data->state=='0' || $data->state=='2')
                <li>
                    <div class="step-cur">
                    <div class="step-name">等待审批</div>
                    <div class="step-no">2</div>
                </li>
                <li>
                    <div class="step-name">等待转发</div>
                    <div class="step-no">3</div>
                </li>

            <li>
                <div class="step-name">公文传输中</div>
                <div class="step-no">4</div>
            </li>

            <li class="step-last">
                <div class="step-name">办结</div>
                <div class="step-no">5</div>
            </li>

            @elseif($data->state=='-1')
                <li>
                    <div class="step-done">
                    <div class="step-name">预审通过</div>
                    <div class="step-no"></div>
                </li>
                <li>
                    <div class="step-cur">
                    <div class="step-name">等待转发</div>
                    <div class="step-no">3</div>
                </li>

            <li>
                <div class="step-name">公文传输中</div>
                <div class="step-no">4</div>
            </li>

            <li class="step-last">
                <div class="step-name">办结</div>
                <div class="step-no">5</div>
            </li>

            @elseif($data->state=='1')
                <li>
                    <div class="step-done">
                    <div class="step-name">审批通过</div>
                    <div class="step-no"></div>
                </li>
                <li>
                    <div class="step-cur">
                    <div class="step-name">等待转发</div>
                    <div class="step-no">3</div>
                </li>

            <li>
                <div class="step-name">公文传输中</div>
                <div class="step-no">4</div>
            </li>

            <li class="step-last">
                <div class="step-name">办结</div>
                <div class="step-no">5</div>
            </li>
            @elseif($data->state=='3')
                <li>
                    <div class="step-done">
                    <div class="step-name">审批通过</div>
                    <div class="step-no"></div>
                </li>
                <li>
                    <div class="step-done">
                    <div class="step-name">已签发</div>
                    <div class="step-no"></div>
                </li>

            <li>
                <div class="step-cur">
                <div class="step-name">公文传输中</div>
                <div class="step-no">4</div>
            </li>

            <li class="step-last">
                <div class="step-name">办结</div>
                <div class="step-no">5</div>
            </li>
            @elseif($data->state=='4')
                <li>
                    <div class="step-done">
                    <div class="step-name">审批通过</div>
                    <div class="step-no"></div>
                </li>
                <li>
                    <div class="step-done">
                    <div class="step-name">已签发</div>
                    <div class="step-no"></div>
                </li>

            <li>
                <div class="step-done">
                <div class="step-name">签收完毕</div>
                <div class="step-no"></div>
            </li>

            <li class="step-last">
                <div class="step-cur">
                <div class="step-name">顺利办结</div>
                <div class="step-no">5</div>
            </li>
                @endif
        </ol>
    </div>
</div>