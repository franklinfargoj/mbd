@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
 <div class="m-subheader ">
    <div class="d-flex align-items-center">
       <div class="mr-auto">
          <h3 class="m-subheader__title m-subheader__title--separator">Dashboard </h3>
          {{ Breadcrumbs::render('documents_uploaded') }}
       </div>
       <div>
       </div>
    </div>
 </div>
 <!-- END: Subheader -->
<div class="row" style="margin-top: 5%">
    <div class="col-md-12">
       <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">
          <div class="m-portlet__head main-sub-title">
             <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                   <span class="m-portlet__head-icon m--hide">
                   <i class="flaticon-statistics"></i>
                   </span>
                   <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                      <span>
                      Uploaded Attachments
                      </span>
                   </h2>
                </div>
             </div>
          </div>
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
                                    {{ $document->name }}<span class="compulsory-text"><small>(Compulsory Document)</small></span>
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
                                                    <a href="{{ asset($document_uploaded['society_document_path']) }}" data-value='{{ $document->id }}' class="upload_documents" download><button type="submit" class="btn btn-primary btn-custom"> Download</button></a>
                                               </span>                                      
                                            @endif
                                        @endforeach
                                    @else
                                        
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
     </div>
</div>
@if(count($documents) == count($documents_uploaded))
<div class="row" style="margin-top: 5%">
    <div class="col-md-12">
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">
            <div class="m-portlet__head main-sub-title">
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
              </div>
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-section mb-0">
                    <h3>
                        <span>
                          Comment
                        </span>
                     </h3>
                    <p>{{ ($documents_comment->society_documents_comment != 'N.A.') ? $documents_comment->society_documents_comment : '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection