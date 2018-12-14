<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#layout_forwarded_for_approval">
                <span class="form-accordion-title">Revision in Layout</span>
                <span class="accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="layout_forwarded_for_approval"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Application Sent For Revision</h2>
                <h2 class="app-no mb-0"></h2>
                    <a href="" class="app-card__details mb-0">{{$data['total_no_of_appln_for_revision']}}</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                <h2 class="app-no mb-0">{{$data['application_pending']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Forwarded to Architect</h2>
                <h2 class="app-no mb-0">{{$data['lm_forwarded_layouts']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
