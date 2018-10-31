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
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
<form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step6_post')}}"
        enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">Form 6:</h3>
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="">
                    <div class="table-responsive">
                        <table id="table-form-4" class="table table--box-input imp_projects">
                            <thead class="thead-default">
                                <tr>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Qualifications</th>
                                    <th>Year of Qualification</th>
                                    <th>Length of Service Firm Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $project_count=$application->imp_senior_professionals->count();
                                @endphp
                                @if($project_count>1)
                                @php $k=($project_count-1); @endphp
                                @else
                                @php $k=0; @endphp
                                @endif
                                @for($j=0;$j<(1+$k);$j++) 
                                <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="imp_senior_professional_id[]" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->id:''):''}}">
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="category[]">
                                            @foreach(config('commanConfig.eoa_imp_senior_professionals_category') as
                                            $key=>$cat)
                                            <option {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->category==$key?'selected':''):''):''}} value="{{$key}}">{{$cat}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->name:''):''}}" placeholder="Name" name="name[]" type="text" class="form-control form-control--custom"></td>
                                    <td>
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="qualifications[]">
                                            @foreach(config('commanConfig.eoa_imp_senior_professionals_qualifications')
                                            as
                                            $key=>$qual)
                                            <option {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->qualifications==$key?'selected':''):''):''}} value="{{$key}}">{{$qual}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input name="year_of_qualification[]" placeholder="Year of Qualification" type="text"
                                            class="form-control form-control--custom" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->year_of_qualification:''):''}}"></td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_year:''):''}}" name="len_of_service_with_firm_in_year[]" placeholder="Length (Firm)" type="text"
                                                class="form-control form-control--custom select-box-list">
                                            <input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_month:''):''}}" name="len_of_service_with_firm_in_month[]" placeholder="Length (Total)"
                                                type="text" class="form-control form-control--custom select-box-list">
                                        </div>
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
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        clone.find("td:last").append("<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
    });

    $('.imp_projects').on('click', '.fa-remove', function () {
        //$(this).closest('tr').remove();
        var delete_id=$(this).closest('tr').find("input[name='imp_senior_professional_id[]']")[0].value;
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
                    url:"{{route('appointing_architect.delete_imp_senior_professional')}}",
                    method:'POST',
                    data:{delete_imp_project_id:delete_id},
                    success:function(data){
                        if(data.status==0)
                        {
                            thisInstance.closest('tr').remove();
                        }else
                        {
                            alert('something went wrong');
                        }
                    }
                })
            }
        }else
        {
            $(this).closest('tr').remove();
        }
    });

</script>
@endsection
