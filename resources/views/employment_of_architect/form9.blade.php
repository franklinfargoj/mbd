@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
            <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 1<span>Basic Details</span></a>
            <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 2<span>Enclosures</span></a>
            <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 3<span>Details of Consultants</span></a>
            <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 4<span>Important Projects</span></a>
            <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 5<span>Work Handled</span></a>
            <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 6<span>Details of Firm</span></a>
            <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 7<span>Work In Hand</span></a>
            <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 8<span>Works Completed</span></a>
            <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 9<span>Supporting Documents</span></a>
    </div>
    <form id="appointing_architect_step9" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="{{route('appointing_architect.step9_post',['id'=>encrypt($application->id)])}}"
        enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            {{-- <h3 class="section-title section-title--small">SUPPORTING DOCUMENTS</h3> --}}
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
                                @for($j=0;$j<(1+$k);$j++) 
                                <tr class="cloneme">
                                    <td>
                                        <input type="hidden" name="doc_id[{{$j}}]" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->id:''):''}}">
                                        <input required name="document_name[{{$j}}]" placeholder="Name of document" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_name:''):''}}"
                                            type="text" class="form-control form-control--custom">
                                    </td>
                                    <td>
                                            @php
                                            $file="";
                                            $file=isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_path:'';
                                            @endphp 
                                        <div class="custom-file mb-0">
                                            <input accept="pdf" title="please upload file with pdf extension" {{ $file!=""?"":"required" }} type="file" id="extract_{{$j}}" name="document_path[{{$j}}]" class="custom-file-input">
                                            <label title="" class="custom-file-label" for="extract_{{$j}}">Choose
                                                File...</label>
                                            <span class="help-block"></span>
                                           
                                            <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
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
            {{-- <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="btn-list">
                        <input type="submit" id="" class="btn btn-primary" name="Save">
                        <a href="" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div> --}}
            <div class="m-form__actions p-0">
                <div class="row">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                        <button type="submit" id="" class="btn btn-primary">Finish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions p-0">
                <div class="row">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                        <a href="{{route('appointing_architect.step10',['id'=>encrypt($application->id)])}}" id="" class="btn btn-primary">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </form>
</div>

@endsection

@section('js')
<script>
    $('#add-more').click(function (e) {
        e.preventDefault();
        var clone = $('table.imp_projects tr.cloneme:first').clone().find('input').val('').end();
        //console.log("clone", clone.find('.custom-file-label')[0].textContent);
        var tableRowCount = $('#table-form-4 tbody tr').length;
        clone.find('.custom-file-label')[0].setAttribute('for', 'extract_' + tableRowCount);
        clone.find('.custom-file-label')[0].textContent = "Choose File...";
        clone.find('.custom-file-input')[0].setAttribute('id', 'extract_' + tableRowCount);
        clone.find('.custom-file-input')[0].setAttribute('accept', 'pdf');
        clone.find('.custom-file-input')[0].setAttribute('required', 'required');

        clone.find('input[name="document_path[0]"]')[0].setAttribute('aria-describedby','document_path['+tableRowCount+']-error')
        clone.find('input[name="document_path[0]"]')[0].setAttribute('name', 'document_path[' + tableRowCount + ']')

        clone.find('input[name="document_name[0]"]')[0].setAttribute('aria-describedby','document_name['+tableRowCount+']-error')
        clone.find('input[name="document_name[0]"]')[0].setAttribute('name', 'document_name[' + tableRowCount + ']')
        clone.find('input[name="doc_id[0]"]')[0].setAttribute('name', 'doc_id[' + tableRowCount + ']')
        clone.find('.btn-link')[0].style.display = "none";
        clone.find("td:last").append(
            "<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
        $('table.imp_projects').append(clone);
        showUploadedFile();
    });

    function showUploadedFile() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }

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
                    url: "{{route('appointing_architect.delete_supporting_document')}}",
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
    
    $('#appointing_architect_step9').validate({
        rules: {
            "document_name[]": "required",
            "document_path[]": {
                required:true,
                extension: "pdf|doc|docx",
            },
        }
    });

   

</script>
@endsection
