<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Revision in Layout</h3>
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
                            <td>Total No of Layouts</td>
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
                            <td>Total No of Layout for revision</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_appln_for_revision']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Application Pending</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_current_user']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Sent to EE</td>
                            <td><span class="count-circle">{{$architect_data['sent_to_ee']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">4.</td>
                            <td>Sent to EM</td>
                            <td><span class="count-circle">{{$architect_data['sent_to_em']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">5.</td>
                            <td>Sent to LM</td>
                            <td><span class="count-circle">{{$architect_data['sent_to_lm']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">6.</td>
                            <td>Sent to REE</td>
                            <td><span class="count-circle">{{$architect_data['sent_to_ree']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">7.</td>
                            <td>Application Forwarded for Approval</td>
                            <td><span class="count-circle">{{$architect_data['appln_sent_for_arroval']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">8.</td>
                            <td>Approved</td>
                            <td><span class="count-circle">{{$architect_data['approved_layouts']}}</span></td>
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
            <h3 class="m-subheader__title">Layout Forwarded for Approval</h3>
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
                            <td>Total number of applications forwarded for approval</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['appln_sent_for_arroval']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Pending at REE</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_ree']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Pending at CO</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_co']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">4.</td>
                            <td>Pending at SAP</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_sap']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">5.</td>
                            <td>Pending at CAP</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_cap']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">6.</td>
                            <td>Pending at LA</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_la']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">7.</td>
                            <td>Pending at VP</td>
                            <td><span class="count-circle">{{$architect_data['pending_at_vp']}}</span></td>
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
               {{--data-toggle="collapse" href="#co_layouts">--}}
                {{--<span class="form-accordion-title">Layout Revision & Approval</span>--}}
                {{--<span class="accordion-icon architect-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="co_layouts"--}}
         {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Layouts  </h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['total_no_of_layout']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
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
    {{--<div class="m-portlet m-portlet--compact hearing-accordion architect-layout-revision-co-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                {{--data-toggle="collapse" href="#layout-approval-co">--}}
                {{--<span class="form-accordion-title">Layout Approval</span>--}}
                {{--<span class="accordion-icon architect-layout-revision-co-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout-approval-co"--}}
        {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Layout for revision</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Pending</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_current_user']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Sent to EE</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['sent_to_ee']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Sent to EM</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['sent_to_em']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Sent to LM</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['sent_to_lm']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Sent to REE</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['sent_to_ree']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Forwarded for Approval</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Approved</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['approved_layouts']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact hearing-accordion architect-layout-approval-co-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                {{--data-toggle="collapse" href="#layout_forwarded_for_approval_co">--}}
                {{--<span class="form-accordion-title">Layout Forwarded for Approval</span>--}}
                {{--<span class="accordion-icon architect-layout-approval-co-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout_forwarded_for_approval_co"--}}
        {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total number of applications forwarded for approval</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at REE</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_ree']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at CO</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_co']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at SAP</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_sap']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at CAP</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_cap']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at LA</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_la']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at VP</h2>--}}
                    {{--<h2 class="app-no mb-0">{{$architect_data['pending_at_vp']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}