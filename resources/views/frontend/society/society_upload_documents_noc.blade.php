@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc',compact('noc_applications'))
@endsection
@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
            {{ Breadcrumbs::render('noc_documents_upload',encrypt($noc_applications->id)) }}
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
                                <th>Sr.No</th>
                                <th>Document Name</th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @php $i=1; @endphp
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{$document->group }}.{{($document->sort_by != 0) ? $document->sort_by : ''}}
                                    </td>
                                    <td>{{ $document->name }}
                                        @if($document->is_optional == 0)
                                            <span class="compulsory-text">
                                            <small>(Compulsory Document)</small></span>
                                            
                                            @else
                                            <span class="compulsory-text"> <small>
                                            <span style="color: green;">
                                            (Optional Document)</small> </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <h2 class="m--font-danger">
                                            @if(isset($document->uploadedDocuments) && count($document->uploadedDocuments) > 0 )
                                                <i class="fa fa-check"></i>
                                            @else
                                                <i class="fa fa-remove"></i>
                                            @endif
                                        </h2>
                                    </td>
                                    
                                    <td>
                                        @if(isset($document->uploadedDocuments) && count($document->uploadedDocuments) > 0 )
                                            @if($document->is_other == 1) 
                                                <a href="{{ route('upload_noc_other_documents',[encrypt($noc_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                                                upload other documents</a> 
                                            @else    
                                            <span>
                                                <a href="{{ asset($document->uploadedDocuments->society_document_path) }}" data-value='{{ $document->id }}'
                                                    class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                        Download</button></a>
                                                <a onclick="return confirm('Are you sure you want to delete this document?');" href="{{ url('/delete_uploaded_documents_noc',([encrypt($noc_applications->id), encrypt($document->id)])) }}" data-value='{{ $document->id }}'
                                                    class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                        <i class="fa fa-trash"></i></button></a>
                                            </span>
                                            @endif
                                        @else
                                            @if($document->is_other == 1) 
                                                <a href="{{ route('upload_noc_other_documents',[encrypt($noc_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                                                upload other documents</a>
                                            @else    
                                                <form action="{{ route('uploaded_documents_noc') }}" method="post" enctype='multipart/form-data'
                                                    id="upload_documents_form_{{ $document->id }}">
                                                    @csrf
                                                    <input type="hidden" name="applicationId" value="{{ isset($noc_applications->id) ? $noc_applications->id : '' }}">
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
                                        @endif    
                                    </td>
                                </tr>
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
            @if($application->nocApplicationStatus[0]->status_id == 3)
            <div>
                <div>
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                            <div class="border-bottom pb-2">
                                <h3 class="section-title section-title--small mb-2">
                                    Remark History:
                                </h3>
                                <span class="hint-text d-block">Remark by REE</span>
                            </div>
                            <div class="remarks-section">
                                <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{date('d-m-Y',
                                            strtotime($application->nocApplicationStatus[0]->created_at))}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{date('h:i:sa',
                                            strtotime($application->nocApplicationStatus[0]->created_at))}}</span></p>
                                    <p class="remarks-section__data__row"><span>Action:</span><span>Sent
                                            to Society</span></p>
                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{$application->nocApplicationStatus[0]->remark}}</span></p>
                                </div>

                                <div class="remarks-section__data">
                                    <form action="{{ route('resubmit_noc_application') }}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-form-label">Remark</label>
                                            <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                                <div class="input-icon right">
                                                    <textarea name="remark" id="remark" class="form-control m-input">{{old('remark')}}</textarea>
                                                    <span class="help-block">{{$errors->first('remark')}}</span>
                                                    <input type="hidden" name="user_id" id="user_id" class="form-control m-input"
                                                        value="{{ $application->nocApplicationStatus[0]->user_id }}">
                                                    <input type="hidden" name="role_id" id="role_id" class="form-control m-input"
                                                        value="{{ $application->nocApplicationStatus[0]->role_id }}">
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
                        <form action="{{ route('add_documents_comment_noc') }}" method="post" enctype='multipart/form-data'>
                            @csrf 
                            <input type="hidden" name="applicationId" value="{{ isset($noc_applications->id) ? $noc_applications->id : '' }}">
                            <div class="remarks-suggestions table--box-input">
                                <div class="mt-3">
                                    <label for="society_documents_comment">Additional Information:</label>
                                    <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom">{{isset($documents_comment) ? $documents_comment->society_documents_comment : ''}}</textarea>
                                        <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                                    </div>
                                </div>
                                <div class="mt-3 btn-list">
                                    <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                    <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
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
@endsection
