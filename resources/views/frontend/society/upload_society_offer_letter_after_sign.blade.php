@extends('admin.layouts.app')
@section('content')
<h2>Application for {{ $application_name[0]->ol_application_master->title }}- Offer Letter</h2>
<div class="row" style="margin-top: 5%">
    <div class="col-md-12">
       <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">
          <div class="m-portlet__head main-sub-title">
             <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                   <span class="m-portlet__head-icon m--hide">
                   <i class="flaticon-statistics"></i>
                   </span>
                   <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                      <span>
                        Application for Offer letter
                      </span>
                   </h2>
                </div>
             </div>
          </div>
          <div class="m-portlet__body m-portlet__body--table">
             <div class="m-section mb-0">
                <iframe width="100%" height="100%" src="{{ url('offer_letter_application_form_dev/'.$application_name[0]->ol_application_master->id) }}"></iframe>
             </div>
       </div>
    </div>
     </div>
</div>
@endsection
