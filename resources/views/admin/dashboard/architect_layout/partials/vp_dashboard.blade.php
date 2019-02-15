<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Layout Revision</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="m-portlet db-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <th style="width: 10%;">Sr. No</th>
                        <th style="width: 60%;" class="text-center">Stages</th>
                        <th style="width: 15%;" class="text-left">Count</th>
                        {{--<th style="width: 15%;">Action</th>--}}
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Total No of Layouts  </td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_layout']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Layouts in process</td>
                            <td><span class="count-circle">{{$architect_data['layout_in_process']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Layouts Approved by VP</td>
                            <td><span class="count-circle">{{$architect_data['approved_by_vp']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="m-portlet">
                <img src="img/data-gola.jpg">
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Layout Approval</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="m-portlet db-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <th style="width: 10%;">Sr. No</th>
                        <th style="width: 60%;" class="text-center">Stages</th>
                        <th style="width: 15%;" class="text-left">Count</th>
                        {{--<th style="width: 15%;">Action</th>--}}
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Total No of Layout for Approval</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_appln_for_approval']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Application Pending</td>
                            <td><span class="count-circle">{{$architect_data['layouts_pending_at_vp']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Application Approved & Sent to Architect</td>
                            <td><span class="count-circle">{{$architect_data['vp_forwarded_and_approved_layouts']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">4.</td>
                            <td>Application Sent Back to CAP</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['vp_reverted_layouts']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="m-portlet">
                <img src="img/data-gola.jpg">
            </div>
        </div>
    </div>

</div>


{{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact hearing-accordion architect-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
               {{--data-toggle="collapse" href="#vp_layouts">--}}
                {{--<span class="form-accordion-title">Layout Revision & Approval</span>--}}
                {{--<span class="accordion-icon architect-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="vp_layouts"--}}
         {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Layouts  </h2>--}}
                {{--<h2 class="app-no mb-0"></h2>--}}
                    {{--<a href="" class="app-card__details mb-0">{{$architect_data['total_no_of_layout']}}</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Layouts in process</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['layout_in_process']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Layouts Approved by VP</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['approved_by_vp']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact hearing-accordion vp-layout-approval-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
               {{--data-toggle="collapse" href="#sap_layouts_status">--}}
                {{--<span class="form-accordion-title">Layout Approval</span>--}}
                {{--<span class="accordion-icon vp-layout-approval-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="sap_layouts_status"--}}
         {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Layout for Approval</h2>--}}
                {{--<h2 class="app-no mb-0">--}}
                    {{--{{$architect_data['total_no_of_appln_for_approval']}}--}}
                {{--</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Pending</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['layouts_pending_at_vp']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Approved & Sent to Architect</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['vp_forwarded_and_approved_layouts']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Sent Back to CAP</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['vp_reverted_layouts']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}