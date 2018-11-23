@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
            <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 1<span>Basic Details</span></a>
            <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 2<span>Enclosuers</span></a>
            <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 3<span>Details of Consultants</span></a>
            <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 4<span>Important Projects</span></a>
            <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 5<span>Work Handled</span></a>
            <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 6<span>Details of Firm</span></a>
            <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 7<span>Work In Hand</span></a>
            <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 8<span>Work Completed</span></a>
            <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step 9<span>Supporting Documents</span></a>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view m-portlet--forms-compact">
        <h3 class="section-title section-title--small">ARCHITECT/CONSULTANT</h3>
        <form id="appointing_architect_step3" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('appointing_architect.step3_post',['id'=>encrypt($application->id)])}}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            {{-- @include('employment_of_architect.partial_personal_details',compact('application')) --}}
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Details of Establishment:</label>
                    <input type="text" id="" name="details_of_establishment" class="form-control form-control--custom m-input"
                        value="{{$application->details_of_establishment}}">
                    @if ($errors->has('details_of_establishment'))
                    <span class="text-danger">{{ $errors->first('details_of_establishment') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Branch Office Details:</label>
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
                    <label class="col-form-label" for="">Architects:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_architects" name="staff_architects" class="form-control form-control--custom m-input"
                        value="{{$application->staff_architects}}">
                    @if ($errors->has('staff_architects'))
                    <span class="text-danger">{{ $errors->first('staff_architects') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Engineer:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_engineers" name="staff_engineers" class="form-control form-control--custom m-input"
                        value="{{$application->staff_engineers}}">
                    @if ($errors->has('staff_engineers'))
                    <span class="text-danger">{{ $errors->first('staff_engineers') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Supporting (Tech.):</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_supporting_tech" name="staff_supporting_tech" class="form-control form-control--custom m-input"
                        value="{{$application->staff_supporting_tech}}">
                    @if ($errors->has('staff_supporting_tech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_tech') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Supporting (Non Tech.):</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_supporting_nontech" name="staff_supporting_nontech" class="form-control form-control--custom m-input"
                        value="{{$application->staff_supporting_nontech}}">
                    @if ($errors->has('staff_supporting_nontech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_nontech') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Others:</label>
                    <input onchange="get_total_staff()" onkeyup="get_total_staff()" type="number" min="0" id="staff_others" name="staff_others" class="form-control form-control--custom m-input"
                        value="{{$application->staff_others}}">
                    @if ($errors->has('staff_others'))
                    <span class="text-danger">{{ $errors->first('staff_others') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Total:</label>
                    <input readonly type="number" min="0" id="staff_total" name="staff_total" class="form-control form-control--custom m-input" value="{{$application->staff_total}}">
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
                                    <input type="radio" name="is_cad_facility" value="0" {{$application->is_cad_facility==0?'checked':''}}>
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
                    <label class="col-form-label" for="">Principle:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_principle" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_principle}}">
                    @if ($errors->has('reg_with_council_of_architecture_principle'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_principle') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Associate:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_associate" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_associate}}">
                    @if ($errors->has('reg_with_council_of_architecture_associate'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_associate') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Partner:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_partner" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_partner}}">
                    @if ($errors->has('reg_with_council_of_architecture_partner'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_partner') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Total Registered Persons:</label>
                    <input type="number" min="0" id="" name="reg_with_council_of_architecture_total_registered_persons" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_total_registered_persons}}">
                    @if ($errors->has('reg_with_council_of_architecture_total_registered_persons'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_total_registered_persons') }}</span>
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
var cas_facility=$('input[name=is_cad_facility]:checked').val();
if(cas_facility==1)
{
    $('.cad_facality').show();
}else
{
    $('.cad_facality').hide();
}
$('input[name=is_cad_facility]').click(function(){
    var is_cad_facality=$('input[name=is_cad_facility]:checked').val();
    if(is_cad_facality==1)
    {
        $('.cad_facality').show();
    }else
    {
        $('.cad_facality').hide();
    }
})
function get_total_staff()
{
    var staff_architects=$('#staff_architects').val();
    var staff_engineers=$('#staff_engineers').val();
    var staff_supporting_tech=$('#staff_supporting_tech').val();
    var staff_supporting_nontech=$('#staff_supporting_nontech').val();
    var staff_others=$('#staff_others').val();
    var total_staff=+staff_architects+ +staff_engineers+ +staff_supporting_tech+ +staff_supporting_nontech+ +staff_others;
    $('#staff_total').val(total_staff)
}
</script>
@endsection