<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion architect-revision-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#revision_layout_for_ree">
                <span class="form-accordion-title">Revision in Layout</span>
                <span class="accordion-icon architect-revision-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="revision_layout_for_ree"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Application Sent For Revision</h2>
                <h2 class="app-no mb-0"></h2>
                    <a href="" class="app-card__details mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                <h2 class="app-no mb-0">{{$architect_data['application_pending']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Forwarded</h2>
                <h2 class="app-no mb-0">{{$architect_data['ree_forwarded_layouts']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact approval-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#approval_layout_for_ree">
                <span class="form-accordion-title">Layout Sent for Approval</span>
                <span class="accordion-icon approval-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="approval_layout_for_ree"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Application Sent For Approval</h2>
                <h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                <h2 class="app-no mb-0">{{$architect_data['application_pending_after_layout_and_excel']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Forwarded</h2>
                <h2 class="app-no mb-0">{{$architect_data['application_forwarded_after_layout_and_excel']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact layout-approval-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#layout_forwarded_for_ee_head">
                <span class="form-accordion-title">Layout Approval</span>
                <span class="accordion-icon layout-approval-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout_forwarded_for_ee_head"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Application Sent For Approval</h2>
                <h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at JE / SE</h2>
                <h2 class="app-no mb-0">{{$architect_data['jr_ree_pending']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at Deputy Engineer</h2>
                <h2 class="app-no mb-0">{{$architect_data['dy_ree_pending']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at  Asst REE</h2>
                <h2 class="app-no mb-0">{{$architect_data['assistant_ree_pending']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at REE</h2>
                <h2 class="app-no mb-0">{{$architect_data['head_ree_pending']}}</h2>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
