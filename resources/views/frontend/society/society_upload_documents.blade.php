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
                                        @if(count($document->documents_uploaded) > 0 )
                                            @foreach($document->documents_uploaded as $document_uploaded)
                                                @if($document_uploaded['society_id'] == '1')
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
                                            @if($document_uploaded['society_id'] == '1')
                                               <span>
                                                    <a href="{{ asset($document_uploaded['society_document_path']) }}" data-value='{{ $document->id }}' class="upload_documents" download><button type="submit" class="btn btn-primary btn-custom"> Download</button></a>
                                                    <a href="{{ url('/delete_uploaded_documents/'.$document->id) }}" data-value='{{ $document->id }}' class="upload_documents"><button type="submit" class="btn btn-primary btn-custom"> <i class="fa fa-trash"></i></button></a>
                                               </span>
                                            @else
                                                <form action="{{ route('uploaded_documents') }}" method="post" enctype='multipart/form-data' id="upload_documents_form_{{ $document->id }}">
                                                @csrf
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" name="document_name"  type="file" class="" id="test-upload_{{ $document->id }}" required>
                                                        <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                                        <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose file ...</label>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                               </form>
                                            @endif
                                        @endforeach
                                    @else
                                        <form action="{{ route('uploaded_documents') }}" method="post" enctype='multipart/form-data' id="upload_documents_form_{{ $document->id }}">
                                        @csrf
                                            <div class="custom-file">
                                                <input class="custom-file-input" name="document_name"  type="file" id="test-upload_{{ $document->id }}" required>
                                                <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                                <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose file ...</label>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn_{{ $document->id }}">Upload</button>
                                       </form>
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
                    <form action="{{ route('add_documents_comment') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                        <div class="form-group">
                            <label class="col-form-label">Comment</label>
                            <div class="col-md-8 @if($errors->has('society_documents_comment')) has-error @endif">
                                <div class="input-icon right">
                                    <textarea name="society_documents_comment" id="society_documents_comment" class="form-control m-input">{{old('society_documents_comment')}}</textarea>
                                    <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
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
@endif
@endsection
<!-- @section('upload_documents_js')
<script type="text/javascript">
    
</script>
@endsection -->
