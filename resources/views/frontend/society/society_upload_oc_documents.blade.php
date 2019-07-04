@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('css')
    <style type="text/css">
        .heading{
            font-weight: 500;
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
@php
    $floor = ['Ground','Stilt','parking'];
    $i = 1;
@endphp
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
            {{ Breadcrumbs::render('oc_documents_upload',$oc_applications->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- society documents -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">           
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> Sr. No </th>
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
                                        @if($document->full_oc_document == 0)
                                            <span class="compulsory-text">
                                            <small>(Compulsory Document)</small></span>
                                        @elseif($document->full_oc_document == 1 && $oc_applications->request_form->is_full_oc == 1)   
                                            <span class="compulsory-text">
                                            <small>(Compulsory Document)</small></span>
                                        @else
                                            <span class="compulsory-text"> <small>
                                            <span style="color: green;">
                                            (Optional Document)</small> </span>    
                                        @endif    
                                    @else
                                    <span class="compulsory-text"> <small>
                                    <span style="color: green;">
                                    (Optional Document)</small> </span>
                                    @endif
                                </td>
                                @if(count($document->ocDocumentsUploaded) > 0 )
                                    <td class="text-center">
                                        <h2 class="m--font-danger">
                                             <i class="fa fa-check"></i>
                                        </h2>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="{{ asset($document->ocDocumentsUploaded->society_document_path) }}" data-value='{{ $document->id }}'
                                                class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                    Download</button></a>
                                            <a href="{{ route('delete_uploaded_oc_documents',[encrypt($oc_applications->id),encrypt($document->ocDocumentsUploaded->id)]) }}" data-value='{{ $document->id }}'
                                                class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                    <i class="fa fa-trash"></i></button></a>
                                        </span>
                                    </td>    
                                @else 
                                <td class="text-center">
                                    <h2 class="m--font-danger">
                                        <i class="fa fa-remove"></i>
                                    </h2>
                                </td> 
                                <td>
                                    <form action="{{ route('uploaded_oc_documents') }}" method="post" enctype='multipart/form-data' id="upload_documents_form_{{ $document->id }}">
                                                @csrf
                                        <input type="hidden" name="applicationId" value="{{ isset($oc_applications->id) ? $oc_applications->id : '' }}">
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="document_name" type="file" id="test-upload_{{ $document->id }}"
                                                required>
                                            <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                            <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                                file ...</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn_{{ $document->id }}">Upload</button>
                                    </form>
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

    <!-- constructed building details table -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section__content mb-0 table-responsive">
                <span class="heading">Details of newly constructed building</span>
                <form action="{{ route('save_oc_construction') }}" method="post" enctype='multipart/form-data'>
                @csrf
                    <input type="hidden" name="application_id" value="{{ $oc_applications->id }}">
                    <input type="hidden" name="society_id" value="{{ $oc_applications->society_id }}">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> Name </th>
                                <th> Values </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Floors <span class="star">*</span></td>
                                <td>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor" name="floor" required>
                                            @if(isset($floor))
                                                @foreach($floor as $value)
                                                    @if(isset($conDetails) && $value == $conDetails->floor)
                                                        <option value="{{ $value }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach    
                                            @endif
                                            </select>
                                        </div>    
                                        <div class="col-md-6">
                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor_no" name="floor_no" data-live-search="true" required>
                                            @for($i=1;$i<=100;$i++)
                                                @if(isset($conDetails) && $i == $conDetails->floor_no)
                                                    <option value="{{$i}}" selected>{{ $i }}</option>
                                                @else
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endif
                                            @endfor    
                                            </select>
                                        </div>
                                    </div>        
                                </td>
                            </tr>
                            <tr>
                                <td>No of rehab tenements <span class="star">*</span></td>
                                <td>
                                    <input type="text" id="rehab_tenements" name="rehab_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->rehab_tenements : '' }}" required>  
                                </td>
                            </tr>
                            <tr>
                                <td>No of sale tenements <span class="star">*</span></td>
                                <td>
                                    <input type="text" id="sale_tenements" name="sale_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->sale_tenements : '' }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td>No of MHADA tenements <span class="star">*</span></td>
                                <td>
                                   <input type="text" id="mhada_tenements" name="mhada_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->mhada_tenements : '' }}"  required> 
                                </td>
                            </tr>
                            <tr>
                                <td>Total No of constructed tenements <span class="star">*</span></td>
                                <td>
                                   <input type="text" id="constructed_tenements" name="constructed_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->constructed_tenements : '' }}" required> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12 mt-2" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-custom" id="sbtBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    @if(!empty($docs_count) && !empty($docs_uploaded_count) && $docs_count == $docs_uploaded_count)
        <div class="m-portlet">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="">
                        <h3 class="section-title section-title--small">Submit Application:</h3>
                    </div>
                    <form action="{{ route('add_oc_documents_comment') }}" method="post" enctype='multipart/form-data'>
                        @csrf
                         <input type="hidden" name="applicationId" value="{{ isset($oc_applications->id) ? $oc_applications->id : '' }}">
                        <div class="remarks-suggestions table--box-input">
                            <div class="mt-3">
                                <label for="society_documents_comment">Additional Information:</label>
                                <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                    <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom">{{ isset($documents_comment) ? $documents_comment->society_documents_comment : '' }}</textarea>
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
            @if($application->ocApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.reverted'))
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
                                        strtotime($application->ocApplicationStatus[0]->created_at))}}</span>
                                </p>
                                <p class="remarks-section__data__row"><span>Time:</span><span>{{date('h:i:sa',
                                        strtotime($application->ocApplicationStatus[0]->created_at))}}</span></p>
                                <p class="remarks-section__data__row"><span>Action:</span><span>Sent
                                        to Society</span></p>
                                <p class="remarks-section__data__row"><span>Description:</span><span>{{$application->ocApplicationStatus[0]->remark}}</span></p>
                            </div>

                            <div class="remarks-section__data">
                                <form action="{{ route('add_uploaded_oc_documents_remark') }}" method="post" enctype='multipart/form-data'>
                                    @csrf
                                     <input type="hidden" name="applicationId" value="{{ isset($oc_applications->id) ? $oc_applications->id : '' }}">
                                    <div class="form-group">
                                        <label class="col-form-label">Remark</label>
                                        <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                            <div class="input-icon right">
                                                <textarea name="remark" id="remark" class="form-control m-input">{{old('remark')}}</textarea>
                                                <span class="help-block">{{$errors->first('remark')}}</span>
                                                <input type="hidden" name="user_id" id="user_id" class="form-control m-input"
                                                    value="{{ $application->ocApplicationStatus[0]->user_id }}">
                                                <input type="hidden" name="role_id" id="role_id" class="form-control m-input"
                                                    value="{{ $application->ocApplicationStatus[0]->role_id }}">
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
            @endif
        </div>
    @endif
</div>
@endsection
