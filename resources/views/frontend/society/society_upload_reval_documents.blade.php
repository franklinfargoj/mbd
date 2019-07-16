@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.reval_actions',compact('ol_applications'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div> 
@endif
@if(session()->has('error'))
<div class="alert alert-danger display_msg">
    {{ session()->get('error') }}
</div> 
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
            {{ Breadcrumbs::render('revalidation_documents_upload',encrypt($ol_applications->id)) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- display nd upload documents section-->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th>Sr. No</th>
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
                                    @if(count($document->reval_documents) > 0 )
                                        <td class="text-center">
                                            <h2 class="m--font-danger">
                                                 <i class="fa fa-check"></i>
                                            </h2>
                                        </td>
                                        <td>
                                        @if($document->is_other == 1) 
                                            <a href="{{ route('reval_other_documents',[encrypt($ol_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                                            upload other documents</a>    
                                        @else 
                                            <span>
                                            <a href="{{ asset($document->reval_documents->society_document_path) }}" data-value='{{ $document->id }}' class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom"> Download</button></a>
                                            <a href="{{ url('/delete_uploaded_reval_documents/'.$document->id) }}" data-value='{{ $document->id }}'
                                                class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                    <i class="fa fa-trash"></i></button></a>
                                            </span>
                                        @endif    
                                        </td>
                                    @else 
                                        <td class="text-center">
                                            <h2 class="m--font-danger">
                                                <i class="fa fa-remove"></i>
                                            </h2>
                                        </td>
                                        <td>
                                        @if($document->is_other == 1) 
                                            <a href="{{ route('reval_other_documents',[encrypt($ol_applications->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                                            upload other documents</a>    
                                        @else 
                                            <form action="{{ route('uploaded_reval_documents') }}" method="post" enctype='multipart/form-data'
                                            id="upload_documents_form_{{ $document->id }}">
                                            @csrf
                                            <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
                                            <div class="custom-file">
                                                <input class="custom-file-input" name="document_name" type="file" class=""
                                                    id="test-upload_{{ $document->id }}" required>
                                                <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                                <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                                    file ...</label>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-custom uploadBtn" id="{{ $document->id }}">Upload</button>
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

    <!-- remark section -->
    @if($docs_count == $docs_uploaded_count)
        <div class="m-portlet">
            <div>
                @if($application->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.reverted'))
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
                                    <form action="{{ route('add_uploaded_reval_documents_remark') }}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
                                        <div class="form-group">
                                            <label class="col-form-label">Remark</label>
                                            <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                                <div class="input-icon right">
                                                    <textarea name="remark" id="remark" class="form-control m-input">{{old('remark')}}</textarea>
                                                    <span class="help-block">{{$errors->first('remark')}}</span>
                                                    <input type="hidden" name="user_id" id="user_id" class="form-control m-input"
                                                        value="{{ $application->olApplicationStatus[0]->user_id }}">
                                                    <input type="hidden" name="role_id" id="role_id" class="form-control m-input"
                                                        value="{{ $application->olApplicationStatus[0]->role_id }}">
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
                @else
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                            <div class="">
                                <h3 class="section-title section-title--small">Submit Application:</h3>
                            </div>
                            <form action="{{ route('add_reval_documents_comment') }}" method="post" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
                                <div class="remarks-suggestions table--box-input">
                                    <div class="mt-3">
                                        <label for="society_documents_comment">Additional Information:</label>
                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom"> {{ isset($documents_comment) ? $documents_comment->society_documents_comment : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3 btn-list">
                                    <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                    <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
@section('actions_js')
<script type="text/javascript">
    $(".uploadBtn").click(function(){
       var id = this.id;
       var form = 'upload_documents_form_'+id;
        $("#"+form).validate({
            rules: {
                document_name: {
                    extension: "pdf"
                }          
            }, messages: {
                document_name: {
                    extension: "Invalid type of file uploaded (only pdf allowed)."
                }
            }
        });
    });
</script>
@endsection
