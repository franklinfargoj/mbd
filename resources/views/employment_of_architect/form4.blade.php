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
            class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
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
    {{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
    @endif --}}
    <form id="appointing_architect_step4" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box"
        action="{{route('appointing_architect.step4_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <h3 class="section-title section-title--small">DETAIL OF 5 IMPORTANT PROJECTS</h3>
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="">
                    <div class="table-responsive">
                        <table id="table-form-4" class="table table--box-input imp_projects">
                            <thead class="thead-default">
                                <tr>
                                    <th>Name of Client</th>
                                    <th>Location</th>
                                    <th>Category of Client</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $project_count=$application->imp_projects->count();
                                @endphp
                                @if($project_count>2)
                                @php $k=($project_count-2); @endphp
                                @else
                                @php $k=0; @endphp
                                @endif
                                @for($j=0;$j<(2+$k);$j++) @php $id="" ; $id=$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->id:''):'';
                                    @endphp
                                    <tr class="cloneme">
                                        <td>
                                            <input type="hidden" name="imp_project_id[{{$j}}]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->id:''):''}}">
                                            <input required name="name_of_client[{{$j}}]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->name_of_client:''):''}}"
                                                placeholder="Name of Client" type="text" class="form-control form-control--custom">
                                        </td>
                                        <td>
                                            <input required name="location[{{$j}}]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->location:''):''}}"
                                                placeholder="Location" type="text" class="form-control form-control--custom">
                                        </td>
                                        <td>
                                            <input required name="category_of_client[{{$j}}]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->category_of_client:''):''}}"
                                                placeholder="Category of Client" type="text" class="form-control form-control--custom">
                                            @if($j>1)
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
        //count++;aria-describedby="name_of_client[5]-error"
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        clone.find('input[name="imp_project_id[0]"]')[0].setAttribute('name', 'imp_project_id[' + count + ']')

        clone.find('input[name="name_of_client[0]"]')[0].setAttribute('aria-describedby', 'name_of_client[' +
            count + ']-error')
        clone.find('input[name="name_of_client[0]"]')[0].setAttribute('name', 'name_of_client[' + count + ']')

        clone.find('input[name="location[0]"]')[0].setAttribute('aria-describedby', 'location[' + count +
            ']-error')
        clone.find('input[name="location[0]"]')[0].setAttribute('name', 'location[' + count + ']')

        clone.find('input[name="category_of_client[0]"]')[0].setAttribute('aria-describedby',
            'category_of_client[' + count + ']-error')
        clone.find('input[name="category_of_client[0]"]')[0].setAttribute('name', 'category_of_client[' + count +
            ']')
        clone.find("td:last").append(
            "<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
    });

    $('.imp_projects').on('click', '.fa-remove', function () {
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
                    url: "{{route('appointing_architect.delete_imp_project')}}",
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

    function delete_imp_project(id) {
        if (id != "") {
            if (confirm('are you sure?')) {

            }
        }
    }

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
    $('#appointing_architect_step4').validate({
        rules: {
            "name_of_client[]": "required",
            "location[]": "required",
            "category_of_client[]": "required"
        }
    });

</script>
@endsection
