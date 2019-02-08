@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions',compact('ol_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
            {{ Breadcrumbs::render('documents_upload') }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <p style="color:red">*Upload all the compulsory documents for submitting application.</p>
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> # </th>
                                <th> Document Name </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @php $i=1; @endphp
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $document->name }}<span class="compulsory-text">
                                        @if(in_array($i, $optional_docs))<small>
                                        <span style="color: green;">
                                        (Optional Document)</span></small> 
                                        @else <small>(Compulsory Document)</small> @endif</span>
                                    </td>
                                    @if(count($document->documents_uploaded) > 0 )
                                        <td class="text-center">
                                            <h2 class="m--font-danger">
                                                 <i class="fa fa-check"></i>
                                            </h2>
                                        </td>    
                                        <td>  
                                            @if($document->is_multiple == 1)
                                                <input type="hidden" name="documentId" id="documentId"
                                                value="{{ isset($document->id) ? $document->id : '' }}"> 
                                                <a href="{{ route('upload_multiple_documents',[$society->id,$document->id]) }}" class="app-card__details mb-0">
                                                click to upload documents</a>
                                            @else 
                                                @foreach($document->documents_uploaded as $document_uploaded)
                                                    <span>
                                                        <a href="{{ config('commanConfig.storage_server').$document_uploaded['society_document_path'] }}" data-value='{{ $document->id }}'
                                                            class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                                Download</button></a>
                                                        <a href="{{ route('delete_uploaded_documents', $document->id) }}" data-value='{{ $document->id }}'
                                                            class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                                <i class="fa fa-trash"></i></button></a>
                                                    </span>          
                                                @endforeach
                                            @endif    
                                        </td>    
                                    @else
                                        <td class="text-center">
                                            <h2 class="m--font-danger">
                                                <i class="fa fa-remove"></i>
                                            </h2>
                                        </td> 
                                        <td>
                                            @if($document->is_multiple == 1)
                                        
                                                <input type="hidden" name="documentId" id="documentId"
                                                value="{{ isset($document->id) ? $document->id : '' }}">
                                                <a href="{{ route('upload_multiple_documents',[$society->id,$document->id]) }}" class="app-card__details mb-0">
                                                click to upload documents</a>
                                            @else
                                                <form action="{{ route('uploaded_documents') }}" method="post" enctype='multipart/form-data' id="upload_documents_form_{{ $document->id }}">
                                                @csrf
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" name="document_name" type="file" class=""
                                                            id="test-upload_{{ $document->id }}" required>
                                                        <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                                        <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                                            file ...</label>
                                                        <span class="help-block">
                                                            @if(session('error_'.$document->id))
                                                            session('error_'.$document->id)
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif  
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($docs_count) && !empty($docs_uploaded_count))
    @if($docs_count == $docs_uploaded_count)
    <div class="m-portlet">
        <div>
            @if($application->olApplicationStatus[0]->status_id == 3)
            <div>
                <div>
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                            <div class="border-bottom pb-2">
                                <h3 class="section-title section-title--small mb-2">
                                    Remark History:
                                </h3>
                                <span class="hint-text d-block">Remark by EE</span>
                            </div>
                            <div class="remarks-section">
                                <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{date('d-m-Y',
                                            strtotime($application->olApplicationStatus[0]->created_at))}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{date('h:i:sa',
                                            strtotime($application->olApplicationStatus[0]->created_at))}}</span></p>
                                    <p class="remarks-section__data__row"><span>Action:</span><span>Sent
                                            to Society</span></p>
                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{$application->olApplicationStatus[0]->remark}}</span></p>
                                </div>

                                <div class="remarks-section__data">
                                    <form action="{{ route('add_uploaded_documents_remark') }}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-form-label">Remark</label>
                                            <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                                <div class="input-icon right">
                                                    <textarea name="remark" id="remark" rows="5" cols="30" class="form-control form-control--custom">{{old('remark')}}</textarea>
                                                    <span class="help-block">{{$errors->first('remark')}}</span>
                                                    <input type="hidden" name="user_id" id="user_id" class="form-control m-input" value="{{ $application->olApplicationStatus[0]->user_id }}">
                                                    <input type="hidden" name="role_id" id="role_id" class="form-control m-input" value="{{ $application->olApplicationStatus[0]->role_id }}">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!--               <div class="m-portlet__head main-sub-title">
                   <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                         <span class="m-portlet__head-icon m--hide">
                         <i class="flaticon-statistics"></i>
                         </span>
                         <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                            <span>
                            Submit Application
                            </span>
                         </h2>
                      </div>
                   </div>
                </div> -->

            <div>
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <div class="">
                            <h3 class="section-title section-title--small">Submit Application:</h3>
                        </div>
                        <form action="{{ route('add_documents_comment') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="remarks-suggestions table--box-input">
                                <div class="mt-3">
                                    <label for="society_documents_comment">Additional Information:</label>
                                    <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom">@if(!empty($documents_comment) && isset($documents_comment->society_documents_comment)){{ $documents_comment->society_documents_comment }}@endif</textarea>
                                        <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                                    </div>
                                </div>
                                <div class="mt-3 btn-list">
                                    <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                    <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <!-- <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-primary btn-custom" id="">Cancel</a> -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@endif
@endif

  <!-- Modal for upload multiple documents-->
<div class="modal fade" id="uploadDocModel" role="dialog">
    <div class="modal-dialog modal-lg" style="width:800px !important">
        <div class="modal-content" style="width: 700px;">
            <div class="modal-header" >
              <h4 class="modal-title">Upload documents</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div style="margin-left: 30px;">
                <div class="col-sm-10" style="margin-top: 25px;">
                    <div class="form-group row">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label for="name">Name of Member:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control--custom" name="memberName" id="memberName" value="">
                        </div>
                    </div>
                </div>  
                <div class="col-sm-10">
                    <div class="form-group row">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label for="name">Upload Document:</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file ">
                                <input class="custom-file-input file_upload" name="document_name" type="file" id="test-upload" required="">
                                <label class="custom-file-label" for="test-upload">Choose
                                    file ...</label>
                                <span class="help-block text-danger"> </span>
                            </div>                        
                        </div>
                    </div> 
                </div> 
            </div>  
            <div class="table-responsive">
                <table class="mt-2 table" id="document"> 
                    <tbody>
                        <tr>
                            <td>  ASDF                                                                  
                            </td>
                            <td class="text-center">
                                <a class="btn-link" href="{{ route('society_offer_letter_preview') }}" target="_blank">
                        Download </a> 
                            </td>
                            <td class="text-center" style="">
                                <i class="fa fa-close icon2 d-icon hide-print" ></i>
                                <input type="hidden" name= "oldFile" id="oldFile" value=""> 
                            </td>
                        </tr>
                    </tbody>    
                </table>
            </div>                    
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('actions_js')
<script type="text/javascript">
    $(".file_upload").change(function(){
        var myfile = $(this).val();
        var ext = myfile.split('.').pop();
        var fileData = $(this).prop('files')[0];
        var societyId = '<?php echo $society->id; ?>';
        var documentId = $("#documentId").val();
        var memberName = $("#memberName").val();
        
        var form_data = new FormData();
        form_data.append('file', fileData);   
        form_data.append('societyId', societyId);  
        form_data.append('documentId', documentId);  
        form_data.append('memberName', memberName);  
        form_data.append('_token', document.getElementsByName("_token")[0].value);
  
        $.ajax({
            url: "/society/upload_multiple_documents",
            data: form_data,
            dataType : "json",
            type: 'POST',
            contentType: false, 
            cache: false,
            processData: false,
            success: function(response) {
                $('#document tr').remove();
                $.each(response.data, function(key, value){
                    var a = $('<tr>').append($('<td>').append(value.member_name)).append($('<td>').append(value.member_name)).append($('<td>').append(value.member_name));
                    $('#document').append(a);    
                });
                $(".loader").hide();
                // if(data == 'success')
                    // $("#file_error_"+id).css("display","none");
            }
        });               

    });
</script>
@endsection


