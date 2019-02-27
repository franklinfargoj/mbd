@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.ee_department.action',compact('ol_application'))
@endsection
@section('content')
        <div class="col-md-12">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title m-subheader__title--separator">Document Submitted By Society</h3>
                    {{ Breadcrumbs::render('document-submitted',$ol_application->id) }}
                    <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
  
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">

                <div class="m-portlet__body m-portlet__body--table">
                    <div class="m-section mb-0">
                        <div class="m-section__content mb-0 table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-default">
                                <tr>
                                    <th width="10%">
                                        Sr.No
                                    </th>
                                    <th width="90%">
                                        तपशील
                                    </th>
                                    <th>
                                        दस्तावेज
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i=1; ?>
                                @if(count($societyDocument) > 0)
                                    @foreach($societyDocument as $value)
                                        @foreach($value as $document)
                                           
                                            <tr>
                                                <td>{{ isset($document->group) ? $document->group : $i }}.{{$document->sort_by}}</td>
                                                <td>{{(isset($document->name) ? $document->name : '')}}

                                                @if(isset($document->is_optional) && $document->is_optional == 1)

                                                <span style="color: green;display:block">
                                                <small>(Optional Document)</span></small>
                                                @else
                                                <span class="compulsory-text">
                                                <small>(Compulsory Document)</small></span>
                                                @endif
                                                
                                                </td>  
                                                <td class="text-center">
                                                @if($document->is_multiple == 1)

                                                    <a href="{{ route('view_multiple_document',[encrypt($ol_application->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                                                            view documents</a>


                                                @else
                                                    @if(isset($document->documents_uploaded[0]->society_document_path))

                                                        <a href="{{config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->society_document_path }}" target="_blank">
                                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                                    @else    
                                                        <h2 class="m--font-danger">
                                                            <i class="fa fa-remove"></i>
                                                        </h2>
                                                    @endif
                                                @endif
                                                </td>
                                            </tr>

                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    @if($societyComments)        
        <div class="col-md-12">
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
                <div class="m-portlet__body m-portlet__body--table">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <div class="">
                            <h3 class="section-title section-title--small">Society Comments :</h3>
                        </div>
                            <div class="remarks-suggestions table--box-input">
                                <div class="mt-3">
                                    <label for="society_documents_comment">Additional Information</label>
                                    <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $societyComments->society_documents_comment }}</textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>  
        </div>     
    @endif        
@endsection