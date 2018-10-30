@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    {{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
    @endif --}}
    <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step4_post')}}"
        enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <h3 class="section-title section-title--small">Form 4:</h3>
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
                                @if($project_count>5)
                                @php $k=($project_count-5); @endphp
                                @else
                                @php $k=0; @endphp
                                @endif
                                @for($j=0;$j<(5+$k);$j++) 
                                <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="imp_project_id[]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->id:''):''}}">
                                        <input name="name_of_client[]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->name_of_client:''):''}}"
                                            placeholder="Name of Client" type="text" class="form-control form-control--custom">
                                    </td>
                                    <td>
                                        <input name="location[]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->location:''):''}}"
                                            placeholder="Location" type="text" class="form-control form-control--custom">
                                    </td>
                                    <td>
                                        <input name="category_of_client[]" value="{{$application->imp_projects!=''?(isset($application->imp_projects[$j])?$application->imp_projects[$j]->category_of_client:''):''}}"
                                            placeholder="Category of Client" type="text" class="form-control form-control--custom">
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
        $(this).closest('tr').remove();
    });

</script>
@endsection
