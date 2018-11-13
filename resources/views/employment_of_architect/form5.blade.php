@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button onclick="window.location='{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button onclick="window.location='{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button onclick="window.location='{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button onclick="window.location='{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button onclick="window.location='{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab active">Step 5</button>
        <button onclick="window.location='{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button onclick="window.location='{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button onclick="window.location='{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
        <button onclick="window.location='{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab ">Step 9</button>
        <button onclick="window.location='{{ route("appointing_architect.step10",['id'=>encrypt($application->id)]) }}'"
            class="btn--unstyled flex-grow-1 form-step-tab ">Step 10</button>
    </div>
    <form id="appointing_architect_step5" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box"
        action="{{route('appointing_architect.step5_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">DETAILS OF WORK HANDLED</h3>
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="">
                    <div class="table-responsive">
                        <table id="table-form-4" class="table table--box-input imp_projects">
                            <thead class="thead-default">
                                <tr>
                                    <th>Name of Client</th>
                                    <th>No. of Dwelling Units / Flats</th>
                                    <th>Land Area in Sq. mt</th>
                                    <th>Built Up Area in Sq. mt</th>
                                    <th>Value of Works in Rs. (Lakhs)</th>
                                    <th>Year of Completion / Start</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $project_count=$application->imp_project_work_handled->count();
                                @endphp
                                @if($project_count>1)
                                @php $k=($project_count-1); @endphp
                                @else
                                @php $k=0; @endphp
                                @endif
                                @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="imp_project_work_handled_id[{{$j}}]" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->id:''):''}}">
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="eoa_application_imp_project_detail_id[{{$j}}]">
                                            @foreach($application->imp_projects as $imp_projects)
                                            <option
                                                {{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?($application->imp_project_work_handled[$j]->eoa_application_imp_project_detail_id==$imp_projects->id?'selected':''):''):''}}
                                                value="{{$imp_projects->id}}">{{$imp_projects->name_of_client}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input required name="no_of_dwelling[{{$j}}]" placeholder="No. of Dwelling" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->no_of_dwelling:''):''}}"
                                            type="number" min="0" class="form-control form-control--custom"></td>
                                    <td><input required name="land_area_in_sq_mt[{{$j}}]" placeholder="Land Area" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->land_area_in_sq_mt:''):''}}"
                                            type="number" min="0" class="form-control form-control--custom"></td>
                                    <td><input required name="built_up_area_in_sq_mt[{{$j}}]" placeholder="Built Up Area"
                                            value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->built_up_area_in_sq_mt:''):''}}"
                                            type="number" min="0" class="form-control form-control--custom"></td>
                                    <td><input required name="value_of_work_in_rs[{{$j}}]" placeholder="Value of Works" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->value_of_work_in_rs:''):''}}"
                                            type="number" min="0" class="form-control form-control--custom"></td>
                                    <td><input required name="year_of_completion_start[{{$j}}]" placeholder="Year" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->year_of_completion_start:''):''}}"
                                            type="number" min="0" class="form-control form-control--custom">
                                        @if($j>0)
                                        <h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <a id="add-more" class="btn--add-delete add">add more<a>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions p-0">
                <div class="row">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <button type="submit" id="" class="btn btn-primary">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
<script>
    $('#add-more').click(function (e) {
        e.preventDefault();
        var count=$('.cloneme').length;
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        clone.find('input[name="imp_project_work_handled_id[0]"]')[0].setAttribute('name','imp_project_work_handled_id['+count+']')
        clone.find('select[name="eoa_application_imp_project_detail_id[0]"]')[0].setAttribute('name','eoa_application_imp_project_detail_id['+count+']')
        
        clone.find('input[name="no_of_dwelling[0]"]')[0].setAttribute('aria-describedby','no_of_dwelling['+count+']-error')
        clone.find('input[name="no_of_dwelling[0]"]')[0].setAttribute('name','no_of_dwelling['+count+']')

        clone.find('input[name="land_area_in_sq_mt[0]"]')[0].setAttribute('aria-describedby','land_area_in_sq_mt['+count+']-error')
        clone.find('input[name="land_area_in_sq_mt[0]"]')[0].setAttribute('name','land_area_in_sq_mt['+count+']')

        clone.find('input[name="built_up_area_in_sq_mt[0]"]')[0].setAttribute('aria-describedby','built_up_area_in_sq_mt['+count+']-error')
        clone.find('input[name="built_up_area_in_sq_mt[0]"]')[0].setAttribute('name','built_up_area_in_sq_mt['+count+']')

        clone.find('input[name="value_of_work_in_rs[0]"]')[0].setAttribute('aria-describedby','value_of_work_in_rs['+count+']-error')
        clone.find('input[name="value_of_work_in_rs[0]"]')[0].setAttribute('name','value_of_work_in_rs['+count+']')

        clone.find('input[name="year_of_completion_start[0]"]')[0].setAttribute('aria-describedby','year_of_completion_start['+count+']-error')
        clone.find('input[name="year_of_completion_start[0]"]')[0].setAttribute('name','year_of_completion_start['+count+']')
        clone.find('.bootstrap-select').replaceWith(function () {
            return $('select', this);
        });
        clone.find('select').selectpicker();
        clone.find("td:last").append(
            "<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
    });

    $('.imp_projects').on('click', '.fa-remove', function () {
        //$(this).closest('tr').remove();
        //var delete_id = $(this).closest('tr').find("input[name='imp_project_work_handled_id[]']")[0].value;
        var delete_id = $(this).closest('tr').find("input")[0].value;
        if (delete_id != "") {
            if (confirm('are you sure?')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                var thisInstance = $(this);
                $.ajax({
                    url: "{{route('appointing_architect.delete_imp_project_work_handled')}}",
                    method: 'POST',
                    data: {
                        delete_imp_project_id: delete_id
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
    
    $('#appointing_architect_step5').validate({
        rules: {
            "no_of_dwelling[]": {
                required:true,
                number:true
            },
            "land_area_in_sq_mt[]": {
                required:true,
                number:true
            },
            "built_up_area_in_sq_mt[]": {
                required:true,
                number:true
            },
            "value_of_work_in_rs[]": {
                required:true,
                number:true
            },
            "year_of_completion_start[]":{
                required:true,
                number:true
            },
        }
    });

   
</script>
@endsection
