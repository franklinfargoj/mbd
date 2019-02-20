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
            {{ Breadcrumbs::render('documents_upload',$ol_applications->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>  
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> Sr.No </th>
                                <th> Document Name </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @php $i=1; @endphp
                            @if(count($societyDocument) > 0)
                                @foreach($documentsList as $value)
                                    @foreach($value as $document)
                                    
                                        <tr>
                                            <td>{{ isset($document->group) ? $document->group : $i }}.{{$document->sort_by}}</td>
                                            <td>
                                                {{ $document->name }}
                                                @if($document->is_optional == 0)
                                                <span class="compulsory-text">
                                                <small>(Compulsory Document)</small></span>
                                                
                                                @else
                                                <span class="compulsory-text"> <small>
                                                <span style="color: green;">
                                                (Optional Document)</small> </span>
                                                @endif
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
                                                        <a href="{{ route('upload_multiple_documents',[encrypt($ol_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0">
                                                        click to upload documents</a>
                                                    @else 
                                                        @foreach($document->documents_uploaded as $document_uploaded)
                                                            <span>
                                                                <a href="{{ config('commanConfig.storage_server').$document_uploaded['society_document_path'] }}" data-value='{{ $document->id }}'
                                                                    class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                                        Download</button></a>
                                                                <a href="{{ route('delete_uploaded_documents', [encrypt($ol_applications->id),encrypt($document->id)]) }}" data-value='{{ $document->id }}'
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
                                                        <a href="{{ route('upload_multiple_documents',[encrypt($ol_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0">
                                                        click to upload documents</a>
                                                    @else
                                                        <form action="{{ route('uploaded_documents') }}" method="post" enctype='multipart/form-data' id="upload_documents_form_{{ $document->id }}">
                                                        @csrf
                                                        <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
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
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet">
        <div>
            @if($application->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.reverted'))
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
            <div>
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <div class="">
                            <h3 class="section-title section-title--small">Submit Application:</h3>
                        </div>
                        <form action="{{ route('add_documents_comment') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
                            <div class="remarks-suggestions table--box-input">
                                <div class="mt-3">
                                    <label for="society_documents_comment">Additional Information:</label>
                                    <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom">@if(!empty($documents_comment) && isset($documents_comment->society_documents_comment)){{ $documents_comment->society_documents_comment }}@endif</textarea>
                                        <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                                    </div>
                                    @if($docs_count != $docs_uploaded_count)
                                    <p style="color:red;">*Upload all the compulsory documents for submitting application.</p>
                                    @endif
                                </div>

                            @if($application->olApplicationStatus[0]->status_id != config('commanConfig.applicationStatus.forwarded'))
                                <div class="mt-3 btn-list">
                                    <button class="btn btn-primary" type="submit" id="uploadBtn" {{ ($docs_count != $docs_uploaded_count) ? 'disabled' : ''}}>Submit</button>
                                    <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            @endif    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@endsection


