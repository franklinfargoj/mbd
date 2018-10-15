@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Court case or Dispute on land Details -
                {{$ArchitectLayoutDetail->architect_layout->layout_name}}</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            @if(Session::has('success'))
            <div class="alert alert-success">
                <p> {{ Session::get('success') }} </p>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <p> {{ Session::get('error') }} </p>
            </div>
            @endif
        <form method="post" action="{{route('architect_layout_detail_court_case_or_dispute_on_land.update')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
            <input type="hidden" name="court_case_or_dispute_on_land_id" value="{{$courCassesOrDisputes->id}}">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    {{-- <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                        </h3>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-2 form-group">
                            <label>Document Name</label>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div class="custom-file">
                            <input type="text" name="document_name" class="form-control form-control--custom" value="{{old('document_name')!=""?old('document_name'):$courCassesOrDisputes->document_name}}">
                                @if ($errors->has('document_name'))
                                    <span class="text-danger">{{ $errors->first('document_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 form-group">
                            <label>File</label>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div class="custom-file">
                                <input type="file" id="doc_file" name="doc_file" class="custom-file-input">
                                <label title="" class="custom-file-label" for="doc_file">Choose file</label>
                                <a target="_blank" style="display:{{isset($ArchitectLayoutDetail->land_reports[0])?'block':'none'}}"
                                        id="land_report_uploaded_file" href="{{config('commanConfig.storage_server').'/'.(isset($courCassesOrDisputes->document_file)?$courCassesOrDisputes->document_file:'')}}">uploaded
                                        file</a>
                                @if ($errors->has('doc_file'))
                                    <span class="text-danger">{{ $errors->first('doc_file') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-2 form-group">
                                <label>Description</label>
                            </div>
                            <div class="col-lg-6 form-group">
                                <div class="custom-file">
                                        <textarea type="text" name="description" id="description" class="form-control form-control--custom form-control--fixed-height">{{old('description')!=""?old('description'):$courCassesOrDisputes->description}}</textarea>
                                        
                                        @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    <div class="mt-auto">
                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Update</Button>
                        <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.index',['layout_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                            class="btn btn-primary btn-custom">Back</a>
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
