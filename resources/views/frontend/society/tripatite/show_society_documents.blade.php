@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.tripatite.actions',compact('ol_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
                {{ Breadcrumbs::render('society_tripartite_documents_upload', $id) }}
                <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
            <!-- <div class="m-portlet__head main-sub-title">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="flaticon-statistics"></i>
                        </span>
                        <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                            <span>
                                Upload Attachments
                            </span>
                        </h2>
                    </div>
                </div>
            </div> -->

            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-section mb-0">
                    <div class="m-section__content mb-0 table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-default">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Document Name
                                </th>
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
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $document->name }}<span class="compulsory-text">@if($document->is_optional == 1)<small><span style="color: green;">(Optional
                                            Document)</span></small> @else <small>(Compulsory Document)</small> @endif</span>
                                    </td>
                                    <td class="text-center">
                                        <h2 class="m--font-danger">
                                            @if(count($document->documents_uploaded) > 0 )
                                                @foreach($document->documents_uploaded as $document_uploaded)
                                                    @if($document_uploaded['society_id'] == $society->id)
                                                        <i class="fa fa-check"></i>
                                                    @else
                                                        <i class="fa fa-remove"></i>
                                                    @endif
                                                @endforeach
                                            @else
                                                <i class="fa fa-remove"></i>
                                            @endif
                                        </h2>
                                    </td>
                                    <td>
                                        @if(count($document->documents_uploaded) > 0 )
                                            @foreach($document->documents_uploaded as $document_uploaded)
                                                @if($document_uploaded['society_id'] == $society->id)
                                                    <span>
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document_uploaded['society_document_path'] }}" data-value='{{ $document->id }}'
                                           class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                Download</button></a>
                                                        @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending'))
                                        <a href="{{ route('delete_tripartite_docs', $document->id) }}" data-value='{{ $document->id }}'
                                           class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                <i class="fa fa-trash"></i></button></a>
                                                            @endif
                                    </span>
                                                @else
                                                    @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending'))
                                                        <form action="{{ route('upload_tripartite_docs') }}" method="post" enctype='multipart/form-data'
                                                              id="upload_documents_form_{{ $document->id }}">
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
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending'))
                                                <form action="{{ route('upload_tripartite_docs') }}" method="post" enctype='multipart/form-data'
                                                      id="upload_documents_form_{{ $document->id }}">
                                                    @csrf
                                                    <div class="custom-file @if(session('error_'.$document->id)) has-error @endif">
                                                        <input class="custom-file-input" name="document_name" type="file" id="test-upload_{{ $document->id }}"
                                                               required>
                                                        <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                                        <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                                            file ...</label>
                                                        <span class="help-block text-danger">
                                                    @if(session('error_'.$document->id))
                                                                {{session('error_'.$document->id)}}
                                                            @endif
                                                </span>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn_{{ $document->id }}">Upload</button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($show_comment_tab))
            @if($show_comment_tab == 1)
                <div class="m-portlet">
                    <div>
                        @if($ol_applications->olApplicationStatus[0]->status_id == 3)
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
                                            strtotime($ol_applications->olApplicationStatus[0]->created_at))}}</span>
                                                    </p>
                                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{date('h:i:sa',
                                            strtotime($ol_applications->olApplicationStatus[0]->created_at))}}</span></p>
                                                    <p class="remarks-section__data__row"><span>Action:</span><span>Sent
                                            to Society</span></p>
                                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{$ol_applications->olApplicationStatus[0]->remark}}</span></p>
                                                </div>

                                                <div class="remarks-section__data">
                                                    <form action="{{ route('add_uploaded_documents_remark') }}" method="post" enctype='multipart/form-data'>
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="col-form-label">Remark</label>
                                                            <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                                                <div class="input-icon right">
                                                                    <textarea name="remark" id="remark" class="form-control m-input">{{old('remark')}}</textarea>
                                                                    <span class="help-block">{{$errors->first('remark')}}</span>
                                                                    <input type="hidden" name="user_id" id="user_id" class="form-control m-input"
                                                                           value="{{ $ol_applications->olApplicationStatus[0]->user_id }}">
                                                                    <input type="hidden" name="role_id" id="role_id" class="form-control m-input"
                                                                           value="{{ $ol_applications->olApplicationStatus[0]->role_id }}">
                                                                    <input type="hidden" name="application_id" id="application_id" class="form-control m-input"
                                                                           value="{{ $ol_applications->id }}">
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
                                        <form action="{{ route('add_tripartite_documents_comment') }}" method="post" enctype='multipart/form-data'>
                                            @csrf
                                            <div class="remarks-suggestions table--box-input">
                                                <div class="mt-3">
                                                    <label for="society_documents_comment">Additional Information:</label>
                                                    <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" @if($ol_applications->olApplicationStatus[0]->status_id !== config('commanConfig.applicationStatus.pending')) readonly @endif>@if($documents_comment) {{ $documents_comment->society_documents_comment }} @endif</textarea>
                                                        <input type="hidden" name="application_id" id="application_id" class="form-control m-input"
                                                               value="{{ $ol_applications->id }}">
                                                        <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                                                    </div>
                                                </div>
                                                @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending'))
                                                    <div class="mt-3 btn-list">
                                                        <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                                        <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                                    </div>
                                                @endif
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
@endsection