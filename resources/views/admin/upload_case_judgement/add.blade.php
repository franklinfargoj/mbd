@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
 
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload Case Judgement</h3>
            {{ Breadcrumbs::render('Upload Case Judgement', $arrData['hearing_data']->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form id="uploadCaseJudgement" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('upload_case_judgement.store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing_data']->id }}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->id }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="upload_judgement_case">Case Template:</label>
                        <div class="custom-file">
                            <input type="file" id="upload_judgement_case" name="upload_judgement_case" class="custom-file-input"
                                value="{{ old('upload_judgement_case') }}">
                            <label class="custom-file-label" for="upload_judgement_case">Choose file...</label>
                            <span class="help-block">{{$errors->first('upload_judgement_case')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('description') }}</textarea>
                            <span class="help-block">{{$errors->first('description')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--primary">
                                <input type="checkbox" name="close_case" value="1"> Close case
                                <span></span>
                            </label>
                        </div>
                    </div>


                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
    <div class="portlet-body">
        <div class="m-portlet__body m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
            <div class="remark-body">
                <div class="pb-2">
                    <h3 class="section-title section-title--small mb-2">
                        History:
                    </h3>
                </div>
            </div>
            <div class="col-md-12 table-responsive">  
                <table id="dtBasicExample" class="table">
                  <thead>
                    <tr>
                      <th class="th-sm">sr.</th>
                      <th class="th-sm">Date</th>
                      <th class="th-sm">Time</th>
                      <th class="th-sm">User</th> 
                      <th class="th-sm">Role</th>
                      <th class="th-sm">Description</th>
                      <th class="th-sm">Case Template</th>
                    </tr>
                  </thead>                         
                      <tbody>
                      @if($hearingLogs)
                        @foreach($hearingLogs->hearingUploadCaseJudgement as $log)                      
                          <tr>
                            <td> 1</td>
                            <td> {{ isset($log->date) ? $log->date : '' }}</td>
                            <td> {{ isset($log->time) ? $log->time : '' }}</td>
                            <td> {{ isset($log->userDetails->name) ? $log->userDetails->name : '' }}</td>
                            <td> {{ isset($log->userDetails->roleDetails->name) ? $log->userDetails->roleDetails->name : '' }}</td>
                            <td> {{ isset($log->description) ? $log->description : '' }}</td>
                            <td>
                            @if($log->upload_judgement_case)
                            <a href="{{ config('commanConfig.storage_server').'/'.$log->upload_judgement_case }}" target="_blank"> <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                            @endif
                            </td>
                          </tr>   
                        @endforeach
                      @endif
                    </tbody>
                </table>
            </div>                             
        </div>
    </div>
</div>

@include('admin.hearing.delete_hearing')
@endsection

