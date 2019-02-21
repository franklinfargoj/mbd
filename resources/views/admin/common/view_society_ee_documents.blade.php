@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.'.$folder.'.action',compact('ol_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

<!-- </style> -->
@endsection
@section('content') 

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Society & EE Documents</h3>
 
             @if(session()->get('role_name') == config('commanConfig.dyce_jr_user') || session()->get('role_name') == config('commanConfig.dyce_branch_head') || session()->get('role_name') == config('commanConfig.dyce_deputy_engineer')) 
                
                {{ Breadcrumbs::render('society_EE_documents',$ol_application->id) }}

            @elseif (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_deputy_engineer') || session()->get('role_name') == config('commanConfig.ree_assistant_engineer') || session()->get('role_name') == config('commanConfig.ree_branch_head')) 

            {{ Breadcrumbs::render('society_EE_documents_ree',$ol_application->id) }}

            @elseif(session()->get('role_name') == config('commanConfig.co_engineer'))

            {{ Breadcrumbs::render('society_EE_documents_co',$ol_application->id) }}

            @elseif(session()->get('role_name') == config('commanConfig.cap_engineer'))

            {{ Breadcrumbs::render('society_EE_documents_cap',$ol_application->id) }}

            @elseif(session()->get('role_name') == config('commanConfig.vp_engineer')) 

            {{ Breadcrumbs::render('society_EE_documents_vp',$ol_application->id) }} 
            @endif    
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

    <!-- society and Appointed Architect details -->
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body m-portlet__body--table main_panel">
            <table class="table mb-0">
                <thead class="thead-default">
                    <th class="table-data--xs">अ क्र.</th>
                    <th>तपशील</th>
                    <th class="table-data--xs">सोसायटी दस्तावेज</th>
                    <th class="table-data--xs">EE दस्तावेज</th>
                    <th class="table-data--lg">टिप्पणी</th>
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
                                        <small>(Optional Document)</small></span>
                                    @else
                                        <span class="compulsory-text">
                                        <small>(Compulsory Document)</small></span>
                                    @endif

                                </td>
                                <td class="text-center"> 
                                    @if($document->is_multiple == 1)
                                        <a href="{{ route('view_multiple_document',[encrypt($ol_application->id),encrypt($document->id)]) }}" class="app-card__details mb-0">
                                        view documents</a>
                                    @else
                                        @if(isset($document->documents_uploaded[0]->society_document_path))
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->society_document_path }}" target="_blank">
                                            <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(isset($document->documents_uploaded[0]->EE_document_path))
                                    <a href="{{ config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->EE_document_path }}" target="_blank">
                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                        
                                    @endif
                                </td>
                                <td>
                                    <p class="mb-2">{{(isset($document->documents_uploaded[0]->comment_by_EE) ? $document->documents_uploaded[0]->comment_by_EE : '')}}</p>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
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
