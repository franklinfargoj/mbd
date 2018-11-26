@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
            <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 1<span>Basic Details</span></a>
            <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 2<span>Enclosuers</span></a>
            <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 3<span>Details of Consultants</span></a>
            <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 4<span>Important Projects</span></a>
            <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 5<span>Work Handled</span></a>
            <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 6<span>Details of Firm</span></a>
            <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 7<span>Work In Hand</span></a>
            <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 8<span>Works Completed</span></a>
            <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step 9<span>Supporting Documents</span></a>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view m-portlet--forms-compact">
        <h3 class="section-title section-title--small">EMPANELMENT OF ARCHITECT/CONSULTANT WITH MHADA</h3>
        <form id="appointing_architect_step2" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
    action="{{route('appointing_architect.step2_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            {{-- @include('employment_of_architect.partial_personal_details',compact('application'))
            @include('employment_of_architect.partial_payment_details',compact('application')) --}}
            {{-- <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Enclosures
                        </h3>
                    </div>
                </div>
            </div> --}}
            @php
                $enclosuers_count=0;
                $enclosuers_count=$application->enclosures->count();
                $enclosuers_count=$enclosuers_count>4?$enclosuers_count:4;
            @endphp
            <div class="enclosuers col-md-6">
            @for($i=0;$i<$enclosuers_count;$i++)
            <div class="cloneme">
                <div class="input-row-list">
                    <div class="d-flex align-items-end">
                        <label class="mb-0 mr-4 font-weight-semi-bold sr_no" for="">{{$i+1}}.</label>
                    <input type="hidden" name="enclosure_id[{{$i}}]" value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->id:''}}">
                        <input type="text" id="" name="enclosures[{{$i}}]" class="form-control form-control--custom m-input w-100" value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->enclosure:''}}">
                    </div>
                    <span class="help-block"></span>
                    @if($i>3)
                    <h2 class='m--font-danger'><i title='Delete' class='fa fa-remove'></i></h2>
                    @endif
                </div>
            </div>
            @endfor
            </div>
            <div class="form-group mt-3">
                <a id="add-more" class="btn--add-delete add">add more<a>
            </div>

            <div class="m-checkbox-list mt-2">
                <label class="m-checkbox m-checkbox--primary">
                    <input {{$application->application_info_and_its_enclosures_verify==1?"checked":""}} type="checkbox" name="application_info_and_its_enclosures_verify" value="1"> Is verified by me and the same is correct by my knowledge
                    <span class=""></span>
                </label>
                @if ($errors->has('application_info_and_its_enclosures_verify'))
                    <span class="text-danger">{{ $errors->first('application_info_and_its_enclosures_verify') }}</span>
                @endif
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
    $(document).ready(function(){
        $('#add-more').click(function (e) {
            e.preventDefault();
            var count=$('.cloneme').length+1;
            var clone = $('.enclosuers .cloneme:first').clone().find('input').val('').end();
            clone.find('input[name="enclosure_id[0]"]')[0].setAttribute('name','enclosure_id['+count+']-error')
            clone.find('input[name="enclosures[0]"]')[0].setAttribute('name','enclosures['+count+']-error')
            clone.find('.sr_no').html(count+'.')
            clone.find(".input-row-list").append("<h2 class='m--font-danger'><i title='Delete' class='fa fa-remove'></i></h2>");
            $('.enclosuers').append(clone);
        });

        $('.enclosuers').on('click', '.fa-remove', function () {
            var delete_id=$(this).closest('div').find('input')[0].value;
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
                        url:"{{route('appointing_architect.delete_enclosure')}}",
                        method:'POST',
                        data:{delete_imp_project_id:delete_id},
                        success:function(data){
                            //console.log(data);
                            if(data.status==0)
                            {
                                thisInstance.closest('div').parent().remove()
                            }else
                            {
                                alert('something went wrong');
                            }
                        }
                    })
                }
            }else
            {
                $(this).closest('div').parent().remove()
            }
            
        })
    })
    
</script>
@endsection
