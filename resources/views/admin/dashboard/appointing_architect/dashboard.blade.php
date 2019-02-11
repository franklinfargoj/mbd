<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion appointing-architect-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#appointing-architect">
                <span class="form-accordion-title">Appointing Architect</span>
                <span class="accordion-icon appointing-architect-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="appointing-architect"
        data-parent="#accordion">
        <div class="row no-gutters hearing-row">
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Total No. of Applications</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['total_no_of_application']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Shortlisted Applications</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['total_shortlisted_application']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Final Applications</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['total_final_application']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Pending Applications</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['pending_at_current_user']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact hearing-accordion appointing-architect-pendencies-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#appointing-architect-pendencies">
                <span class="form-accordion-title">Appointing Architect pendencies</span>
                <span class="accordion-icon appointing-architect-pendencies-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="appointing-architect-pendencies"
        data-parent="#accordion">
        <div class="row no-gutters hearing-row">
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Pending At Junior Architect</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['pending_at_jr_architect']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Pending At Seinior Architect</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['pending_at_sr_architect']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Pending At Head Architect</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['pending_at_architect']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center no-shadow">
                    <h2 class="app-heading">Pending At Selection Committee</h2>
                    <h2 class="app-no mb-0">{{$appointing_architect_data['pending_at_selection_committee']}}</h2>
                    <!-- <a href="" class="app-card__details mb-0">View Details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>


