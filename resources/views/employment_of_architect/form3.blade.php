@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step
            1<span>Basic Details</span></a>
        <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step
            2<span>Enclosures</span></a>
        <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step
            3<span>Details of Consultants</span></a>
        <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            4<span>Important Projects</span></a>
        <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            5<span>Work Handled</span></a>
        <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            6<span>Details of Firm</span></a>
        <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            7<span>Work In Hand</span></a>
        <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            8<span>Works Completed</span></a>
        <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step
            9<span>Supporting Documents</span></a>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view m-portlet--forms-compact">
        {{-- <h3 class="section-title section-title--small">ARCHITECT/CONSULTANT</h3> --}}
        <form id="appointing_architect_step3" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('appointing_architect.step3_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            {{-- @include('employment_of_architect.partial_personal_details',compact('application')) --}}
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Consultant's details of Establishment:</label>
                    <input type="text" id="" name="details_of_establishment" class="form-control form-control--custom m-input"
                        value="{{$application->details_of_establishment}}">
                    @if ($errors->has('details_of_establishment'))
                    <span class="text-danger">{{ $errors->first('details_of_establishment') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Consultant's Branch Details:</label>
                    <input type="text" id="" name="branch_office_details" class="form-control form-control--custom m-input"
                        value="{{$application->branch_office_details}}">
                    @if ($errors->has('branch_office_details'))
                    <span class="text-danger">{{ $errors->first('branch_office_details') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Details of Staff
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Architects:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_architects"
                        name="staff_architects" class="form-control form-control--custom m-input" value="{{$application->staff_architects}}">
                    @if ($errors->has('staff_architects'))
                    <span class="text-danger">{{ $errors->first('staff_architects') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Engineer:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_engineers"
                        name="staff_engineers" class="form-control form-control--custom m-input" value="{{$application->staff_engineers}}">
                    @if ($errors->has('staff_engineers'))
                    <span class="text-danger">{{ $errors->first('staff_engineers') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Supporting (Tech.):</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_supporting_tech"
                        name="staff_supporting_tech" class="form-control form-control--custom m-input" value="{{$application->staff_supporting_tech}}">
                    @if ($errors->has('staff_supporting_tech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_tech') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Supporting (Non Tech.):</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_supporting_nontech"
                        name="staff_supporting_nontech" class="form-control form-control--custom m-input" value="{{$application->staff_supporting_nontech}}">
                    @if ($errors->has('staff_supporting_nontech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_nontech') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Others:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_others"
                        name="staff_others" class="form-control form-control--custom m-input" value="{{$application->staff_others}}">
                    @if ($errors->has('staff_others'))
                    <span class="text-danger">{{ $errors->first('staff_others') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Total:</label>
                    <input readonly type="number" min="0" id="staff_total" name="staff_total" class="form-control form-control--custom m-input"
                        value="{{$application->staff_total}}">
                    @if ($errors->has('staff_total'))
                    <span class="text-danger">{{ $errors->first('staff_total') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text mr-5">
                                Details of C.A.D Facility
                            </h3>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" id="is_cad_facility_yes" name="is_cad_facility" value="1"
                                        {{$application->is_cad_facility==1?'checked':''}}> Yes
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" name="is_cad_facility" value="0"
                                        {{$application->is_cad_facility==0?'checked':''}}>
                                    No
                                    <span></span>
                                </label>
                                @if ($errors->has('is_cad_facility'))
                                <span class="text-danger">{{ $errors->first('is_cad_facility') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row  cad_facality">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Computers:</label>
                    <input type="number" min="0" id="" name="cad_facility_no_of_computers" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_computers}}">
                    @if ($errors->has('cad_facility_no_of_computers'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_computers') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Printers:</label>
                    <input type="number" min="0" id="" name="cad_facility_no_of_printers" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_printers}}">
                    @if ($errors->has('cad_facility_no_of_printers'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_printers') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Plotters:</label>
                    <input type="number" min="0" id="" name="cad_facility_no_of_plotters" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_plotters}}">
                    @if ($errors->has('cad_facility_no_of_plotters'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_plotters') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Operators:</label>
                    <input type="number" min="0" id="" name="cad_facility_no_of_operators" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_operators}}">
                    @if ($errors->has('cad_facility_no_of_operators'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_operators') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Details of Registration with Council of Architecture
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Principle:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_principle" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_principle}}">
                    @if ($errors->has('reg_with_council_of_architecture_principle'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_principle') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Associate:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_associate" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_associate}}">
                    @if ($errors->has('reg_with_council_of_architecture_associate'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_associate') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Partner:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_partner" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_partner}}">
                    @if ($errors->has('reg_with_council_of_architecture_partner'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_partner') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Partner details
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <table class="table partners">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Registration No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                    $project_count=$application->partners_details->count();
                    @endphp
                    @if($project_count>1)
                    @php $k=($project_count-1); @endphp
                    @else
                    @php $k=0; @endphp
                    @endif
                    <tbody>
                        @for($j=0;$j<(1+$k);$j++) @php $id="" ; $id=$application->partners_details!=''?(isset($application->partners_details[$j])?$application->partners_details[$j]->id:''):'';
                            @endphp
                            <tr class="cloneme">
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="partner_id[{{$j}}]" value="{{$application->partners_details!=''?(isset($application->partners_details[$j])?$application->partners_details[$j]->id:''):''}}">
                                        <input required type="text" id="" name="partner_details_name[{{$j}}]" class="form-control form-control--custom"
                                            value="{{$application->partners_details!=''?(isset($application->partners_details[$j])?$application->partners_details[$j]->name:''):''}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input required type="text" id="" name="partner_details_reg_no[{{$j}}]" class="form-control form-control--custom"
                                            value="{{$application->partners_details!=''?(isset($application->partners_details[$j])?$application->partners_details[$j]->registration_no:''):''}}">
                                    </div>
                                </td>
                                <td>
                                    @if($j>0)
                                    <h2 class='m--font-danger mb-0'>
                                        <i title='Delete' class='fa fa-remove' onclick=""></i>
                                    </h2>
                                    @endif
                                </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
                <table class="table">
                    <tr>
                        <td colspan="3" class="text-center">
                            <button type="button" id="add-more" class="btn btn-primary add_partner">Add</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">COA registration no:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_coa_registration_no"
                        class="form-control form-control--custom m-input" value="{{$application->reg_with_council_of_architecture_coa_registration_no}}">
                    @if ($errors->has('reg_with_council_of_architecture_coa_registration_no'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_coa_registration_no')
                        }}</span>
                    @endif
                </div>

                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Total Registered Persons:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_total_registered_persons"
                        class="form-control form-control--custom m-input" value="{{$application->reg_with_council_of_architecture_total_registered_persons}}">
                    @if ($errors->has('reg_with_council_of_architecture_total_registered_persons'))
                    <span class="text-danger">{{
                        $errors->first('reg_with_council_of_architecture_total_registered_persons') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Awards, Prizes Etc:</label>
                    <input type="text" id="" name="award_prizes_etc" class="form-control form-control--custom m-input"
                        value="{{$application->award_prizes_etc}}">
                    @if ($errors->has('award_prizes_etc'))
                    <span class="text-danger">{{ $errors->first('award_prizes_etc') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Awardz and Prizes
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <table class="table award_prizes">
                    <thead>
                        <tr>
                            <th>Award Name</th>
                            <th>Award Certificate</th>
                            <th>award drawings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                    $awards_prizes_count=$application->award_prizes->count();
                    @endphp
                    @if($awards_prizes_count>1)
                    @php $k=($awards_prizes_count-1); @endphp
                    @else
                    @php $k=0; @endphp
                    @endif
                    <tbody>
                        @for($j=0;$j<(1+$k);$j++) @php $id="" ; $id=$application->award_prizes!=''?(isset($application->award_prizes[$j])?$application->award_prizes[$j]->id:''):'';
                            @endphp
                            <tr class="clonemeAwardPrizes">
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" id="award_rewardz_id_{{$j}}" name="award_rewardz_id[{{$j}}]"
                                            value="{{$application->award_prizes!=''?(isset($application->award_prizes[$j])?$application->award_prizes[$j]->id:''):''}}">
                                        <input placeholder="Award Name" required type="text" id="" name="award_name[{{$j}}]"
                                            class="form-control form-control--custom" value="{{$application->award_prizes!=''?(isset($application->award_prizes[$j])?$application->award_prizes[$j]->award_name:''):''}}">
                                    </div>
                                </td>
                                <td>
                                    @php
                                    $file="";
                                    $file=isset($application->award_prizes[$j])?$application->award_prizes[$j]->award_certificate:'';
                                    @endphp
                                    <div class="custom-file mb-0 form-group">
                                        <input data-file-type="award_certificate" accept="pdf" title="please upload file with pdf extension"
                                            {{ $file!=""?"":"required" }} type="file" id="extract_certificate_{{$j}}"
                                            name="award_certificate[{{$j}}]" class="custom-file-input" onChange="upload_certificate(this,'award_rewardz_id_{{$j}}','certificate_link_{{$j}}')">
                                        <label title="" class="custom-file-label" for="extract_certificate_{{$j}}">Choose
                                            File...</label>
                                        <span class="help-block"></span>
                                        <a id="certificate_link_{{$j}}" style="display:{{$file!=''?'block':'none'}}"
                                            target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                                    </div>
                                </td>
                                <td>
                                    @php
                                    $file="";
                                    $file=isset($application->award_prizes[$j])?$application->award_prizes[$j]->award_drawing:'';
                                    @endphp
                                    <div class="custom-file mb-0 form-group">
                                        <input data-file-type="award_drawing" accept="pdf" title="please upload file with pdf extension"
                                            {{ $file!=""?"":"required" }} type="file" id="extract_drawing_{{$j}}" name="award_drawing[{{$j}}]"
                                            class="custom-file-input" onChange="upload_certificate(this,'award_rewardz_id_{{$j}}','drawing_link_{{$j}}')">
                                        <label title="" class="custom-file-label" for="extract_drawing_{{$j}}">Choose
                                            File...</label>
                                        <span class="help-block"></span>

                                        <a id="drawing_link_{{$j}}" style="display:{{$file!=''?'block':'none'}}" target="_blank"
                                            class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                                    </div>
                                </td>
                                <td>
                                    @if($j>0)
                                    <h2 class='m--font-danger mb-0'>
                                        <i title='Delete' class='fa fa-remove' onclick=""></i>
                                    </h2>
                                    @endif
                                </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
                <table class="table">
                    <tr>
                        <td colspan="3" class="text-center">
                            <button type="button" id="add-more_award" class="btn btn-primary add_award_prizes">Add</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Other Information:</label>
                    <input type="text" id="" name="other_information" class="form-control form-control--custom m-input"
                        value="{{$application->other_information}}">
                    @if ($errors->has('other_information'))
                    <span class="text-danger">{{ $errors->first('other_information') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        {{-- <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Extra Details
                            </h3>
                        </div> --}}
                    </div>
                </div>
            </div>
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
@section('js')
<script>
    function upload_certificate(e, certificate_id, file_link_id) {
        var file_id = e.getAttribute('id');
        var form_data = new FormData();
        var file_data = $('#' + file_id).prop('files')[0];
        var award_cartificate_id = $('#' + certificate_id).val();
        form_data.append('file', file_data);
        form_data.append('award_cartificate_id', award_cartificate_id);
        form_data.append('field_name', e.getAttribute('data-file-type'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{route('appointing_architect.upload_award_certificate')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function (data) {
                $(".loader").hide();
                if (data.status == true) {
                    $("#" + file_link_id).prop("href", data.file_path)
                    $("#" + file_link_id).css("display", "block");
                    $("#" + file_id).removeAttr('required');
                    // $("#latest_layout_error").html('');
                } else {
                    // $("#latest_layout_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    }

    $('#add-more_award').click(function (e) {
        e.preventDefault();
        var application_id = $('input[name=application_id]').val();
        var count = $('.clonemeAwardPrizes').length;
        var clone = $('table.award_prizes tr.clonemeAwardPrizes:first').clone().find('input').val('').end();

        var uploadInput = clone.find('.custom-file-input');
        clone.find('.custom-file-input').each(function (index, input) {
            var newCount = count;
            if (input.getAttribute('id').indexOf('drawing') !== -1) {
                input.setAttribute('id', 'extract_drawing_' + newCount);
                input.setAttribute('name', 'award_drawing[' + newCount + ']');
                input.setAttribute('accept', 'pdf')
                input.setAttribute('required', 'required');
            }
            if (input.getAttribute('id').indexOf('certificate') !== -1) {
                input.setAttribute('id', 'extract_certificate_' + newCount);
                input.setAttribute('name', 'award_certificate[' + newCount + ']');
                input.setAttribute('accept', 'pdf')
                input.setAttribute('required', 'required');
            }
        });

        var uploadLabel = clone.find('.custom-file-label');
        clone.find('#drawing_link_0')[0].setAttribute('id', 'drawing_link_[' + count +']');
        clone.find('#certificate_link_0')[0].setAttribute('id', 'certificate_link_[' + count +']');
        clone.find('.custom-file-label').each(function (index, label) {
            var newCount = count;
            if (label.getAttribute('for').indexOf('drawing') !== -1) {
                label.setAttribute('for', 'extract_drawing_' + newCount);
            }
            if (label.getAttribute('for').indexOf('certificate') !== -1) {
                label.setAttribute('for', 'extract_certificate_' + newCount);
            }

            label.textContent = "Choose File...";

            var customFileWrap = $(label.closest('.form-group'));


            if (customFileWrap.hasClass('has-success')) {
                customFileWrap.removeClass('has-success');
            }
        });

        clone.find('input[name="award_rewardz_id[0]"]')[0].setAttribute('name', 'award_rewardz_id[' + count +
            ']')

        clone.find('input[name="award_name[0]"]')[0].setAttribute('aria-describedby', 'award_name[' + count +
            ']-error')
        clone.find('input[name="award_name[0]"]')[0].setAttribute('name', 'award_name[' + count + ']')
        clone.find('.btn-link')[0].style.display = "none";
        clone.find("td:last").append(
            "<h2 class='m--font-danger mb-0'><i title='Delete' class='fa fa-remove' onclick=''></i></h2>");

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        var thisInstance = $(this);
        $.ajax({
            url: "{{route('appointing_architect.add_award_prizes')}}",
            method: 'POST',
            data: {
                application_id: application_id
            },
            success: function (data) {
                if (data.status == 0) {
                    clone.find('input[name="award_rewardz_id[' + count + ']"]')[0].setAttribute(
                        'value', data.award_id)
                    $('table.award_prizes').append(clone);
                    showUploadedFile();
                } else {
                    alert('something went wrong');
                }
            }
        })
    });

    function showUploadedFile() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }
    $('#add-more').click(function (e) {
        e.preventDefault();
        var count = $('.cloneme').length;
        var clone = $('table.partners tr.cloneme:first').clone().find('input').val('').end();
        clone.find('input[name="partner_id[0]"]')[0].setAttribute('name', 'partner_id[' + count + ']');
        console.log("clone", clone.find('input[name="partner_details_name[0]"]')[0]);
        clone.find('input[name="partner_details_name[0]"]')[0].setAttribute('aria-describedby',
            'partner_details_name[' + count + ']-error')
        clone.find('input[name="partner_details_name[0]"]')[0].setAttribute('name', 'partner_details_name[' +
            count + ']')

        clone.find('input[name="partner_details_reg_no[0]"]')[0].setAttribute('aria-describedby',
            'partner_details_reg_no[' + count + ']-error')
        clone.find('input[name="partner_details_reg_no[0]"]')[0].setAttribute('name', 'partner_details_reg_no[' +
            count + ']')

        clone.find("td:last").append(
            "<h2 class='m--font-danger mb-0'><i title='Delete' class='fa fa-remove' onclick=''></i></h2>");
        $('table.partners').append(clone);
    });

    $('.award_prizes').on('click', '.fa-remove', function () {
        $(this).closest('tr').remove();
        var delete_id = $(this).closest('tr').find("input")[0].value;
        //alert(delete_id)
        if (delete_id != "") {
            if (confirm('are you sure?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                var thisInstance = $(this);
                $.ajax({
                    url: "{{route('appointing_architect.delete_award_prizes')}}",
                    method: 'POST',
                    data: {
                        delete_award_id: delete_id
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            thisInstance.closest('tr').remove();
                        } else {
                            alert('something went wrong');
                        }
                    }
                })
            }
        } else {
            $(this).closest('tr').remove();
        }

    });

    var cas_facility = $('input[name=is_cad_facility]:checked').val();
    if (cas_facility == 1) {
        $('.cad_facality').show();
    } else {
        $('.cad_facality').hide();
    }
    $('input[name=is_cad_facility]').click(function () {
        var is_cad_facality = $('input[name=is_cad_facility]:checked').val();
        if (is_cad_facality == 1) {
            $('.cad_facality').show();
        } else {
            $('.cad_facality').hide();
        }
    })

    function get_total_staff() {
        var staff_architects = $('#staff_architects').val();
        var staff_engineers = $('#staff_engineers').val();
        var staff_supporting_tech = $('#staff_supporting_tech').val();
        var staff_supporting_nontech = $('#staff_supporting_nontech').val();
        var staff_others = $('#staff_others').val();
        var total_staff = +staff_architects + +staff_engineers + +staff_supporting_tech + +staff_supporting_nontech + +
            staff_others;
        $('#staff_total').val(total_staff)
    }

    $('.partners').on('click', '.fa-remove', function () {
        // $(this).closest('tr').remove();
        var delete_id = $(this).closest('tr').find("input")[0].value;
        //alert(delete_id)
        if (delete_id != "") {
            if (confirm('are you sure?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                var thisInstance = $(this);
                $.ajax({
                    url: "{{route('appointing_architect.delete_partners')}}",
                    method: 'POST',
                    data: {
                        delete_partner_id: delete_id
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            thisInstance.closest('tr').remove();
                        } else {
                            alert('something went wrong');
                        }
                    }
                })
            }
        } else {
            $(this).closest('tr').remove();
        }

    });

    $.validator.prototype.checkForm = function () {
        //overriden in a specific page
        this.prepareForm();
        for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
            if (this.findByName(elements[i].name).length !== undefined && this.findByName(elements[i].name).length >
                1) {
                for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                    this.check(this.findByName(elements[i].name)[cnt]);
                }
            } else {
                this.check(elements[i]);
            }
        }
        return this.valid();
    };

    $("#appointing_architect_step3").validate({
        rules: {
            "partner_details_name[]": "required",
            "partner_details_reg_no[]": "required",
            "award_name[]": "required",
            "award_certificate[]": "required",
            "award_certificate[]": {
                required: true,
                extension: "pdf|doc|docx",
            },
            "award_drawing[]": "required",
            "award_drawing[]": {
                required: true,
                extension: "pdf|doc|docx",
            },
            category_of_panel: "required",
            name_of_applicant: "required",
            address: "required",
            city: "required",
            pin: {
                required: true,
                number: true
            },
            off: {
                required: true,
                number: true
            },
            res: {
                required: true,
                number: true
            },
            mobile: {
                required: true,
                number: true
            },
            fax: {
                required: true,
                number: true
            },
            cash: {
                required: true,
                number: true
            },
            pay_order_no: {
                required: true,
                number: true
            },
            bank: "required",
            branch: "required",
            date_of_payment: "required",
            receipt_no: {
                required: true,
                number: true
            },
            receipt_date: "required",
            details_of_establishment: "required",
            branch_office_details: "required",
            staff_architects: {
                required: true,
                number: true
            },
            staff_engineers: {
                required: true,
                number: true
            },
            staff_supporting_tech: {
                required: true,
                number: true
            },
            staff_supporting_nontech: {
                required: true,
                number: true
            },
            staff_others: {
                required: true,
                number: true
            },
            staff_total: {
                required: true,
                number: true
            },
            is_cad_facility: "required",
            cad_facility_no_of_computers: {
                required: function (element) {
                    return $('#is_cad_facility_yes').is(':checked')
                }
            },
            cad_facility_no_of_printers: {
                required: function (element) {
                    return $('#is_cad_facility_yes').is(':checked')
                }
            },
            cad_facility_no_of_plotters: {
                required: function (element) {
                    return $('#is_cad_facility_yes').is(':checked')
                }
            },
            cad_facility_no_of_operators: {
                required: function (element) {
                    return $('#is_cad_facility_yes').is(':checked')
                }
            },
            reg_with_council_of_architecture_principle: {
                required: true,
                number: true
            },
            reg_with_council_of_architecture_associate: {
                required: true,
                number: true
            },
            reg_with_council_of_architecture_partner: {
                required: true,
                number: true
            },
            reg_with_council_of_architecture_total_registered_persons: {
                required: true,
                number: true
            },
            reg_with_council_of_architecture_coa_registration_no: {
                required: true,
                number: true
            },
            award_prizes_etc: "required"

        }
    });

</script>
@endsection
