<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#vp_layouts">
                <span class="form-accordion-title">Layout Revision & Approval</span>
                <span class="accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="vp_layouts"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Layouts  </h2>
                <h2 class="app-no mb-0"></h2>
                    <a href="" class="app-card__details mb-0">{{$data['total_no_of_layout']}}</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Layouts in process</h2>
                <h2 class="app-no mb-0">{{$data['layout_in_process']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Layouts Approved by VP</h2>
                <h2 class="app-no mb-0">{{$data['approved_by_vp']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
               data-toggle="collapse" href="#sap_layouts_status">
                <span class="form-accordion-title">Layout Approval</span>
                <span class="accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="sap_layouts_status"
         data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Layout for Approval</h2>
                <h2 class="app-no mb-0">{{$data['total_no_of_appln_for_approval']}}</h2>
                    <a href="" class="app-card__details mb-0"></a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                <h2 class="app-no mb-0">{{$data['layouts_pending_at_vp']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Approved & Sent to Architect</h2>
                <h2 class="app-no mb-0">{{$data['vp_forwarded_and_approved_layouts']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Sent Back to CAP</h2>
                <h2 class="app-no mb-0">{{$data['vp_reverted_layouts']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>