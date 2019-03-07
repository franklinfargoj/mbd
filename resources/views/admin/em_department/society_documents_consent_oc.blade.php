@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.em_department.action_oc',compact('oc_application'))
@endsection
@section('content')
<div class="col-md-12">
   <div class="m-subheader px-0 m-subheader--top">
      <div class="d-flex align-items-center">
         <h3 class="m-subheader__title m-subheader__title--separator">Document Submitted By Society</h3>
         {{ Breadcrumbs::render('em_society_documents_oc',$oc_application->id) }}
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
                           #
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
                     <?php $i=0; ?>
                     @if($societyDocuments)
                        @foreach($societyDocuments as $data)
                           <tr>
                              <td>{{ $i+1}}.</td>
                              <td>{{($data->name)}}
                                @if(isset($data->is_optional) && $data->is_optional == 1)
                                      <span style="color: green;display:block"><small>(Optional Document)</small></span>
                                  @else
                                      <span class="compulsory-text"><small>(Compulsory Document)</small></span>
                                  @endif
                              </td>
                              <td class="text-center">
                                 @if(isset($data->oc_documents_uploaded[0]->society_document_path))
                                 <a target="_blank" href="{{ asset($data->oc_documents_uploaded[0]->society_document_path) }}">
                                 <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                 @endif
                              </td>
                           </tr>
                        @php $i++; @endphp
                        @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@if($comments)        
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
                        <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $comments->society_documents_comment }}</textarea>
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>
@endif        
@endsection