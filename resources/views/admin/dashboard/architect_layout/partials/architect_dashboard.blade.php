<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion architect-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#layout-approval">
                <span class="form-accordion-title">Layout Approval</span>
                <span class="accordion-icon architect-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout-approval"
        data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Layout for revision</h2>
                    <h2 class="app-no mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_current_user']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Sent to EE</h2>
                    <h2 class="app-no mb-0">{{$architect_data['sent_to_ee']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Sent to EM</h2>
                    <h2 class="app-no mb-0">{{$architect_data['sent_to_em']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Sent to LM</h2>
                    <h2 class="app-no mb-0">{{$architect_data['sent_to_lm']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Sent to REE</h2>
                    <h2 class="app-no mb-0">{{$architect_data['sent_to_ree']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Forwarded for Approval</h2>
                    <h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Approved</h2>
                    <h2 class="app-no mb-0">{{$architect_data['approved_layouts']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#layout_forwarded_for_approval">
                <span class="form-accordion-title">Layout Forwarded for Approval</span>
                <span class="accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="layout_forwarded_for_approval"
        data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total number of applications forwarded for approval</h2>
                    <h2 class="app-no mb-0">{{$architect_data['appln_sent_for_arroval']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at REE</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_ree']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at CO</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_co']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at SAP</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_sap']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at CAP</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_cap']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at LA</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_la']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at VP</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_vp']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#layout_forwarded_for_approval_main">
                <span class="form-accordion-title">Layout Approval Subordinate Pendencies</span>
                <span class="accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="layout_forwarded_for_approval_main"
        data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total number of applications</h2>
                    <h2 class="app-no mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</h2>
                    <a href="" class="app-card__details mb-0">View Details</a>
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at Jr Achitect</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_jr_architect']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Pending at Asst. Achitect</h2>
                    <h2 class="app-no mb-0">{{$architect_data['pending_at_sr_architect']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

