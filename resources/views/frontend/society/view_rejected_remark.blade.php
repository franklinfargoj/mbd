@extends('frontend.layouts.sidebarAction')
@section('actions')
@if($module == 'Offer')
    @include('frontend.society.actions',compact('ol_applications'))

@elseif($module == 'Revalidation')
    @include('frontend.society.reval_actions',compact('ol_applications'))
@endif
@endsection  
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
                        {{ Breadcrumbs::render('rejected_remark', encrypt($ol_applications->id)) }} (Offer Letter)
            <div class="ml-auto btn-list">
                <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div> 
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body table--box-input">
            <h3 class="section-title section-title--small">REE Remark :</h3>
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <p class="font-weight-semi-bold">Remark by REE head</p>
                    <textarea rows="4" cols="63" name="remark" class="form-control form-control--custom" readonly>{{ isset($ol_applications->olApplicationStatus[0]) ? $ol_applications->olApplicationStatus[0]->remark : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>            
@endsection