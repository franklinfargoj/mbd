@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <div id="accordion" class="mt-4">
        <h3 class="section-title section-title--small mb-4">Name of Applicant: {{$application->name_of_applicant}}</h3>
        @php
        $project_count=$application->project_sheets->count();
        @endphp
        @if($project_count>1)
        @php $k=($project_count-1); @endphp
        @else
        @php $k=0; @endphp
        @endif
        @for($j=0;$j<(1+$k);$j++) <div class="m-portlet m-portlet--compact form-accordion">
            <a class="btn--unstyled section-title section-title--small form-count-title" data-toggle="collapse" href="#form_{{$j+1}}">Form
                {{$j+1}}:</a>
            <form role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step7_post')}}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="application_id" value="{{$application->id}}" class="one">
                <input type="hidden" name="project_sheet_detail_id" value="{{$application->project_sheets[$j]->id}}">
                <div class="m-portlet__body m-portlet__body--spaced collapse form-count" id="form_{{$j+1}}" data-parent="#accordion">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Name of Project:</label>
                            <input type="text" id="" name="name_of_project" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->name_of_project}}">
                            @if ($errors->has('name_of_project'))
                            <span class="text-danger">{{ $errors->first('name_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Location:</label>
                            <input type="text" id="" name="location" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->location}}">
                            @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Name of Client:</label>
                            <input type="text" id="" name="name_of_client" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->name_of_client}}">
                            @if ($errors->has('name_of_client'))
                            <span class="text-danger">{{ $errors->first('name_of_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Address:</label>
                            <input type="text" id="" name="address" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->address}}">
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Phone Number:</label>
                            <input type="text" id="" name="tel_no" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->tel_no}}">
                            @if ($errors->has('tel_no'))
                            <span class="text-danger">{{ $errors->first('tel_no')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="extract">Upload Attachment:<span class="star">*</span></label>
                            <div class="custom-file">
                                <input type="file" id="extract" name="extract" class="custom-file-input">
                                <label title="" class="custom-file-label" for="extract">Choose File...</label>
                                <span class="help-block"></span>
                                <a class="btn-link" href=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Build Up Area in m<sup>2</sup>:</label>
                            <input type="text" id="" name="built_up_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->built_up_area_in_sq_m}}">
                            @if ($errors->has('built_up_area_in_sq_m'))
                            <span class="text-danger">{{ $errors->first('built_up_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Land Area in m<sup>2</sup>:</label>
                            <input type="text" id="" name="land_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->land_area_in_sq_m}}">
                            @if ($errors->has('land_area_in_sq_m'))
                            <span class="text-danger">{{ $errors->first('land_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Estimated Value of Projects:</label>
                            <input type="text" id="" name="estimated_value_of_project" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->estimated_value_of_project}}">
                            @if ($errors->has('estimated_value_of_project'))
                            <span class="text-danger">{{ $errors->first('estimated_value_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Completed Value of Projects:</label>
                            <input type="text" id="" name="completed_value_of_project" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->completed_value_of_project}}">
                            @if ($errors->has('completed_value_of_project'))
                            <span class="text-danger">{{ $errors->first('completed_value_of_project')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Date of Start:</label>
                            <input type="text" id="" name="date_of_start" class="form-control form-control--custom m_datepicker"
                                readonly value="{{$application->project_sheets[$j]->date_of_start}}">
                            @if ($errors->has('date_of_start'))
                            <span class="text-danger">{{ $errors->first('date_of_start')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Date of Completion:</label>
                            <input type="text" id="" name="date_of_completion" class="form-control form-control--custom m_datepicker"
                                readonly value="{{$application->project_sheets[$j]->date_of_completion}}">
                            @if ($errors->has('date_of_completion'))
                            <span class="text-danger">{{ $errors->first('date_of_completion')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Whether Service Terminated by Client:</label>
                            <input type="text" id="" name="whether_service_terminated_by_client" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->whether_service_terminated_by_client}}">
                            @if ($errors->has('whether_service_terminated_by_client'))
                            <span class="text-danger">{{ $errors->first('whether_service_terminated_by_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Salient Features of Project:</label>
                            <input type="text" id="" name="salient_features_of_project" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->salient_features_of_project}}">
                            @if ($errors->has('salient_features_of_project'))
                            <span class="text-danger">{{ $errors->first('salient_features_of_project')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Reasons for Delay (If any):</label>
                            <input type="text" id="" name="reason_for_delay_if_any" class="form-control form-control--custom m-input"
                                value="{{$application->project_sheets[$j]->reason_for_delay_if_any}}">
                            @if ($errors->has('reason_for_delay_if_any'))
                            <span class="text-danger">{{ $errors->first('reason_for_delay_if_any')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-one4">
                                    <div class="btnone-list">
                                        <button typonee="submit" id="" class="btn btn-primary">Save</button>
                                        <a href="" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
    @endfor
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions p-0">
        <div class="btn-list d-flex justify-content-between align-items-center">
            <a id="add-more" class="btn--add-delete add">add more<a>
                    <button type="submit" id="" class="btn btn-primary">Next</button>
        </div>
    </div>
</div>
</div>

@endsection


@section('js')
<script>
    $(document).ready(function () {
        document.querySelector(".m-portlet__body").classList.add("show");
        $('#add-more').click(function (e) {
            e.preventDefault();
            var formAccordionInputHidden = $('#accordion .form-accordion:first').find("input").filter(
                function (index, item) {
                    if (item.name !== 'application_id' && item.name !== '_token') {
                        item.value = '';
                    }
                });

            var formAccordion = $("#accordion .form-accordion:first").clone();
            var formAccordionCount = $("#accordion").find('.form-accordion').length + 1;
            var newID = 'form_' + formAccordionCount;

            var formAccordionNumber = formAccordion.find('.form-count-title')[0];
            formAccordionNumber.setAttribute("href", "#" + newID);
            formAccordionNumber.textContent = "Form " + formAccordionCount + ":";

            var formAccordionCount = formAccordion.find('.form-count')[0];
            formAccordionCount.setAttribute("id", newID);

            formAccordion.insertAfter("#accordion .form-accordion:last");

            $(".m_datepicker").datepicker({
                todayHighlight: !0,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                },
                autoclose: true,
                format: 'dd-mm-yyyy'
            })
        });
    });

</script>
@endsection
