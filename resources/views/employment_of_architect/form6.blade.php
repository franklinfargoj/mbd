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
            <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 4<span>Important Projects</span></a>
            <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 5<span>Work Handled</span></a>
            <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 6<span>Details of Firm</span></a>
            <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 7<span>Work In Hand</span></a>
            <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step 8<span>Works Completed</span></a>
            <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step 9<span>Supporting Documents</span></a>
    </div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
    @endif
    <form id="appointing_architect_step6" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box"
        action="{{route('appointing_architect.step6_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">DETAILS OF IMPORTANT/SENIOR PROFESSIONAL IN THE FIRM</h3>
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
                                    <th>Length of Service Firm Total <br>( Year's & Month's)</th>
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
                                @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="imp_senior_professional_id[{{$j}}]" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->id:''):''}}">
                                        <select required class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="category[{{$j}}]">
                                            @foreach(config('commanConfig.eoa_imp_senior_professionals_category') as
                                            $key=>$cat)
                                            <option
                                                {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->category==$key?'selected':''):''):''}}
                                                value="{{$key}}">{{$cat}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input required  value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->name:''):''}}"
                                            placeholder="Name" name="name[{{$j}}]" type="text" class="form-control form-control--custom"></td>
                                    <td>
                                        <select required class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="" name="qualifications[{{$j}}]">
                                            @foreach(config('commanConfig.eoa_imp_senior_professionals_qualifications')
                                            as $key=>$qual)
                                            <option
                                                {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->qualifications==$key?'selected':''):''):''}}
                                                value="{{$key}}">{{$qual}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input required name="year_of_qualification[{{$j}}]" placeholder="Year of Qualification"
                                            type="number" class="form-control form-control--custom" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->year_of_qualification:''):''}}"></td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input required value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_year:''):''}}"
                                                        name="len_of_service_with_firm_in_year[{{$j}}]" placeholder="Length (Firm)"
                                                        type="number" class="form-control form-control--custom select-box-list">
                                                </div>
                                                <div class="col-md-6">
                                                    <input required value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_month:''):''}}"
                                                        name="len_of_service_with_firm_in_month[{{$j}}]" placeholder="Length (Total)"
                                                        type="number" class="form-control form-control--custom select-box-list">
                                                </div>
                                            </div>
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
        var count = $('.cloneme').length;
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        clone.find('input[name="imp_senior_professional_id[0]"]')[0].setAttribute('name',
            'imp_senior_professional_id[' + count + ']')
        clone.find('select[name="category[0]"]')[0].setAttribute('name', 'category[' + count + ']')

        clone.find('input[name="name[0]"]')[0].setAttribute('aria-describedby','name['+count+']-error')
        clone.find('input[name="name[0]"]')[0].setAttribute('name', 'name[' + count + ']')

        clone.find('select[name="qualifications[0]"]')[0].setAttribute('aria-describedby','qualifications['+count+']-error')
        clone.find('select[name="qualifications[0]"]')[0].setAttribute('name', 'qualifications[' + count + ']')

        clone.find('input[name="year_of_qualification[0]"]')[0].setAttribute('aria-describedby','year_of_qualification['+count+']-error')
        clone.find('input[name="year_of_qualification[0]"]')[0].setAttribute('name', 'year_of_qualification[' +
            count + ']')

        clone.find('input[name="len_of_service_with_firm_in_year[0]"]')[0].setAttribute('aria-describedby','len_of_service_with_firm_in_year['+count+']-error')
        clone.find('input[name="len_of_service_with_firm_in_year[0]"]')[0].setAttribute('name',
            'len_of_service_with_firm_in_year[' + count + ']')

        clone.find('input[name="len_of_service_with_firm_in_month[0]"]')[0].setAttribute('aria-describedby','len_of_service_with_firm_in_month['+count+']-error')
        clone.find('input[name="len_of_service_with_firm_in_month[0]"]')[0].setAttribute('name',
            'len_of_service_with_firm_in_month[' + count + ']')
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
                    url: "{{route('appointing_architect.delete_imp_senior_professional')}}",
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

    $('#appointing_architect_step6').validate({
        rules: {
            "category[]": "required",
            "name[]": "required",
            "qualifications[]": "required",
            "year_of_qualification[]": {
                required:true,
                number:true
            },
            "len_of_service_with_firm_in_year[]": {
                required:true,
                number:true
            },
            "len_of_service_with_firm_in_month[]": {
                required:true,
                number:true
            }
        }
    });

</script>
@endsection
