@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button onclick="window.location='{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button onclick="window.location='{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 2</button>
        <button onclick="window.location='{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 3</button>
        <button onclick="window.location='{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 4</button>
        <button onclick="window.location='{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
        <button onclick="window.location='{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button onclick="window.location='{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button onclick="window.location='{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
        <button onclick="window.location='{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab ">Step 9</button>
        <button onclick="window.location='{{ route("appointing_architect.step10",['id'=>encrypt($application->id)]) }}'" class="btn--unstyled flex-grow-1 form-step-tab ">Step 10</button>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view m-portlet--forms-compact">
        <h3 class="section-title section-title--small mb-0">APPLICATION FORM FOR EMPLOYMENT OF ARCHITECT</h3>
        <form action="{{route('appointing_architect.step1_post',['id'=>encrypt($application->id)])}}" id="appointing_architect_step1" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            @include('employment_of_architect.partial_personal_details',compact('application'))
            @include('employment_of_architect.partial_payment_details',compact('application'))
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" id="" class="btn btn-primary">Save</button>
                                <a href="" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
