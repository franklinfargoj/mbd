@extends('admin.layouts.app')
@section('content')
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
                      Upload Attachments
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
                                        @if(count($documents_uploaded) > 0 )
                                            @foreach($documents_uploaded as $document_uploaded)
                                                @if($document_uploaded['document_id'] == $document->id)
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
                                   <form action="{{ route('uploaded_documents') }}" method="post" enctype='multipart/form-data'>
                                   @csrf
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="document_name"  type="file" class="" id="test-upload" required>
                                            <input class="custom-file-input" type="hidden" name="document_id" class="" id="test-upload" value="{{ $document->id }}">
                                            <label class="custom-file-label" for="test-upload">Choose file...</label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                   </form>
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
@endsection
