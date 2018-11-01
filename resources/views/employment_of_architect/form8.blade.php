@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
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
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 8</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab ">Step 9</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab ">Step 10</button>
    </div>
    <div id="accordion" class="mt-4">
        @php
        $prev_form_number=old('form_number')?old('form_number'):0;
        @endphp

        <h3 class="section-title section-title--small mb-4">Name of Applicant: {{$application->name_of_applicant}}</h3>

        @php
        $project_count=$application->project_sheets->count();
        @endphp

        @if($prev_form_number>$project_count)
        @php $project_count=($prev_form_number-$project_count)+$project_count @endphp
        @endif

        @if($project_count>1)
        @php $k=($project_count-1); @endphp
        @else
        @php $k=0; @endphp
        @endif


        @for($j=0;$j<(1+$k);$j++) <div class="m-portlet m-portlet--compact form-accordion">
            <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
                <a class="btn--unstyled section-title section-title--small form-count-title" data-toggle="collapse"
                    href="#form_{{$j+1}}">Form
                    {{$j+1}}:</a>
                @if($j>=1)
                <h2 class='m--font-danger mb-0'><i title='Delete' class='fa fa-remove'></i></h2>
                @endif
            </div>
            <form role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step8_post',['id'=>encrypt($application->id)])}}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_number" value="{{$j+1}}">
                <input type="hidden" name="application_id" value="{{$application->id}}" class="one">
                <input type="hidden" name="project_sheet_detail_id" value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->id:''}}">
                <div class="m-portlet__body m-portlet__body--spaced collapse form-count {{$prev_form_number==$j+1?'show':''}}"
                    id="form_{{$j+1}}" data-parent="#accordion">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Name of Project:</label>
                            <input type="text" id="" name="name_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->name_of_project:old('name_of_project')}}">
                            @if ($errors->has('name_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('name_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Location:</label>
                            <input type="text" id="" name="location" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->location:old('location')}}">
                            @if ($errors->has('location') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('location')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Name of Client:</label>
                            <input type="text" id="" name="name_of_client" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->name_of_client:old('name_of_client')}}">
                            @if ($errors->has('name_of_client') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('name_of_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Address:</label>
                            <input type="text" id="" name="address" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->address:old('address')}}">
                            @if ($errors->has('address') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('address')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Phone Number:</label>
                            <input type="text" id="" name="tel_no" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->tel_no:old('tel_no')}}">
                            @if ($errors->has('tel_no') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('tel_no')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="extract">Upload copy of agreement:
                                <!--<span class="star">*</span>--></label>
                            <div class="custom-file">
                                <input type="file" id="extract_{{$j+1}}" name="copy_of_agreement" class="custom-file-input">
                                <label title="" class="custom-file-label" for="extract_{{$j+1}}">Choose File...</label>
                                <span class="help-block"></span>
                                @php
                                $file="";
                                $file=isset($application->project_sheets[$j])?$application->project_sheets[$j]->copy_of_agreement:'';
                                @endphp
                                <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Build Up Area in m<sup>2</sup>:</label>
                            <input type="text" id="" name="built_up_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->built_up_area_in_sq_m:old('built_up_area_in_sq_m')}}">
                            @if ($errors->has('built_up_area_in_sq_m') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('built_up_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Land Area in m<sup>2</sup>:</label>
                            <input type="text" id="" name="land_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->land_area_in_sq_m:old('land_area_in_sq_m')}}">
                            @if ($errors->has('land_area_in_sq_m') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('land_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Estimated Value of Projects:</label>
                            <input type="text" id="" name="estimated_value_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->estimated_value_of_project:old('estimated_value_of_project')}}">
                            @if ($errors->has('estimated_value_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('estimated_value_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Completed Value of Projects:</label>
                            <input type="text" id="" name="completed_value_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->completed_value_of_project:old('completed_value_of_project')}}">
                            @if ($errors->has('completed_value_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('completed_value_of_project')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Date of Start:</label>
                            <input type="text" id="" name="date_of_start" class="form-control form-control--custom m_datepicker"
                                readonly value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->date_of_start:old('date_of_start')}}">
                            @if ($errors->has('date_of_start') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('date_of_start')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Date of Completion:</label>
                            <input type="text" id="" name="date_of_completion" class="form-control form-control--custom m_datepicker"
                                readonly value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->date_of_completion:old('date_of_completion')}}">
                            @if ($errors->has('date_of_completion') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('date_of_completion')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Whether Service Terminated by Client:</label>
                            <input type="text" id="" name="whether_service_terminated_by_client" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->whether_service_terminated_by_client:old('whether_service_terminated_by_client')}}">
                            @if ($errors->has('whether_service_terminated_by_client') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('whether_service_terminated_by_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="">Salient Features of Project:</label>
                            <input type="text" id="" name="salient_features_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->salient_features_of_project:old('salient_features_of_project')}}">
                            @if ($errors->has('salient_features_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('salient_features_of_project')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Reasons for Delay (If any):</label>
                            <input type="text" id="" name="reason_for_delay_if_any" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->reason_for_delay_if_any:old('reason_for_delay_if_any')}}">
                            @if ($errors->has('reason_for_delay_if_any') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('reason_for_delay_if_any')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="btn-list">
                                <input type="submit" id="" class="btn btn-primary" name="Save">
                                <a href="" class="btn btn-secondary">Cancel</a>
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
           
            <a href="{{route('appointing_architect.step9',['id'=>encrypt($application->id)])}}" id="" class="btn btn-primary">Next</a>
        </div>
    </div>
</div>
</div>

@endsection


@section('js')
<script>
    $(document).ready(function () {
        //document.querySelector(".m-portlet__body").classList.add("show");

        function showUploadedFile() {
            $('.custom-file-input').change(function (e) {
                $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
            });
        }


        $('#add-more').click(function (e) {
            e.preventDefault();
            var formAccordion = $("#accordion .form-accordion:first").clone();
            var formAccordionInputHidden = formAccordion.find("input").filter(
                function (index, item) {
                    if (item.name !== 'application_id' && item.name !== '_token' && item.type !==
                        'submit') {
                        item.value = '';
                    }
                });

            formAccordion.find(".form-steps-toplinks").append("<h2 class='m--font-danger'><i title='Delete' class='fa fa-remove'></i></h2>");

            var formAccordionCount = $("#accordion").find('.form-accordion').length + 1;
            var newID = 'form_' + formAccordionCount;

            formAccordion.find("input[name='form_number']")[0].value = formAccordionCount

            var formAccordionNumber = formAccordion.find('.form-count-title')[0];
            formAccordionNumber.setAttribute("href", "#" + newID);
            formAccordionNumber.textContent = "Form " + formAccordionCount + ":";

            var file_input = formAccordion.find('.custom-file-input')[0];
            file_input.setAttribute('id', 'extract_' + formAccordionCount)
            var file_label = formAccordion.find('.custom-file-label')[0];
            file_label.setAttribute('for', 'extract_' + formAccordionCount);
            var download_link = formAccordion.find('.btn-link')[0];
            download_link.setAttribute('style', 'display:none;');

            var formAccordionCount = formAccordion.find('.form-count')[0];
            formAccordionCount.setAttribute("id", newID);

            var formAccordionShow = formAccordion.find('.form-count')[0];
            var changed_class_name_for_show = formAccordionShow.getAttribute('class');
            formAccordionShow.setAttribute('class', changed_class_name_for_show + ' show')

            formAccordion.insertAfter("#accordion .form-accordion:last");

            showUploadedFile();

            $(".m_datepicker").datepicker({
                todayHighlight: !0,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                },
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
            
            removeAccordion();
        });

        function removeAccordion() {
            if($('.form-steps-toplinks')) {
                $('.form-steps-toplinks').on('click', '.fa-remove', function(e) {
                    var delete_id=$(this).closest('.form-steps-toplinks').next('form').find("input[name='project_sheet_detail_id']")[0].value;
                    //$(this)[0].closest('.form-accordion').remove();
                    if(delete_id!="")
                    {
                        if(confirm('are you sure?'))
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': '{{csrf_token()}}'
                                }
                            });
                            var thisInstance=$(this);
                            $.ajax({
                                url:"{{route('appointing_architect.delete_project_sheet_detail')}}",
                                method:'POST',
                                data:{delete_imp_project_id:delete_id},
                                success:function(data){
                                    if(data.status==0)
                                    {
                                        thisInstance[0].closest('.form-accordion').remove();
                                    }else
                                    {
                                        alert('something went wrong');
                                    }
                                }
                            })
                        }
                    }else
                    {
                        $(this)[0].closest('.form-accordion').remove();
                    }


                });
            }
        }

        removeAccordion();
    });

</script>
@endsection
