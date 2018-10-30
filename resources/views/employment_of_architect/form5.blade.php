@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step5_post')}}"
        enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">Form 5:</h3>
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
                                        <input type="hidden" name="imp_project_work_handled_id[]" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->id:''):''}}">
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="eoa_application_imp_project_detail_id[]">
                                            @foreach($application->imp_projects as $imp_projects)
                                            <option
                                                {{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?($application->imp_project_work_handled[$j]->eoa_application_imp_project_detail_id==$imp_projects->id?'selected':''):''):''}}
                                                value="{{$imp_projects->id}}">{{$imp_projects->name_of_client}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input name="no_of_dwelling[]" placeholder="No. of Dwelling" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->no_of_dwelling:''):''}}"
                                            type="text" class="form-control form-control--custom"></td>
                                    <td><input name="land_area_in_sq_mt[]" placeholder="Land Area" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->land_area_in_sq_mt:''):''}}"
                                            type="text" class="form-control form-control--custom"></td>
                                    <td><input name="built_up_area_in_sq_mt[]" placeholder="Built Up Area" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->built_up_area_in_sq_mt:''):''}}"
                                            type="text" class="form-control form-control--custom"></td>
                                    <td><input name="value_of_work_in_rs[]" placeholder="Value of Works" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->value_of_work_in_rs:''):''}}"
                                            type="text" class="form-control form-control--custom"></td>
                                    <td><input name="year_of_completion_start[]" placeholder="Year" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->year_of_completion_start:''):''}}"
                                            type="text" class="form-control form-control--custom"></td>
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
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        clone.append("<h2 class='m--font-danger remove-row'><i class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
    });

    $('.imp_projects').on('click', '.fa-remove', function () {
        $(this).closest('tr').remove();
    });

</script>
@endsection
