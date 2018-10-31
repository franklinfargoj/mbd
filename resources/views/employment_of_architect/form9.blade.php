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
    <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step9_post',['id'=>encrypt($application->id)])}}"
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
                                    <th>Name of Document</th>
                                    <th>Attachment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $project_count=$application->supporting_documents->count();
                                @endphp
                                @if($project_count>1)
                                @php $k=($project_count-1); @endphp
                                @else
                                @php $k=0; @endphp
                                @endif
                                @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="doc_id[]" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->id:''):''}}">
                                        <input required name="document_name[]" placeholder="Name of document" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_name:''):''}}"
                                            type="text" class="form-control form-control--custom">
                                    </td>
                                    <td>
                                        <div class="custom-file mb-0">
                                            <input type="file" id="extract_{{$j+1}}" name="document_path[]" class="custom-file-input">
                                            <label title="" class="custom-file-label" for="extract_{{$j+1}}">Choose
                                                File...</label>
                                            <span class="help-block"></span>
                                            @php
                                            $file="";
                                            $file=isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_path:'';
                                            @endphp 
                                            <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                                        </div>
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
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="btn-list">
                        <input type="submit" id="" class="btn btn-primary" name="Save">
                        <a href="" class="btn btn-secondary">Cancel</a>
                    </div>
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
        clone.find("td:last").append(
            "<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
    });

    $('.imp_projects').on('click', '.fa-remove', function () {
        //$(this).closest('tr').remove();
        var delete_id = $(this).closest('tr').find("input[name='doc_id[]']")[0].value;
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

</script>
@endsection
