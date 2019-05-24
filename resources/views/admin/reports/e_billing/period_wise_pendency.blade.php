@extends('admin.layouts.app')
@section('content')

    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Reports - Period Wise Pendency (E-Billing)</h3>
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
            </div>
            @if(Session::has('error'))
                <p class="alert alert-danger mt-2">{{ Session::get('error') }}</p>
            @endif
            <div class="m-portlet m-portlet--compact filter-wrap">
                <div class="row align-items-center row--filter">
                    <div class="col-md-12">

                        <form class="form-group m-form__group row align-items-center mb-0 floating-labels-form" method="get" action="{{ route('ebilling_pending_reports') }}">
                            {{-- <div class="col-md-2">
                                <div class="form-group m-form__group">
                                    <input type="text" name="from_date" id="from_date" class="form-control form-control--custom m-input m_datepicker"
                                        value="{{ isset($getData['from_date'])? $getData['from_date'] : '' }}" placeholder="From Date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group m-form__group">
                                    <input type="text" name="to_date" id="to_date" class="form-control form-control--custom m-input m_datepicker"
                                        value="{{ isset($getData['to_date'])? $getData['to_date'] : '' }}" placeholder="To Date">
                                </div>
                            </div> --}}
                            <div class="col-md-3 form-group">
                                <label class="col-form-label mhada-multiple-label" for="ebilling_type" style="">E-Billing Type:<span class="star">*</span></label>
                                <select required name="ebilling_type" title="Please Select Type" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                    {{--<option value="">Please select type</option>--}}
                                    @foreach($e_billing_type as $key=>$value)
                                        <option value="{{$value}}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="report_date_from" class="col-form-label" for="report_date_from">From Date</label>
                                <input required type="text" id="report_date_from" name="report_date_from" class="form-control form-control--custom m-input m_datepicker"
                                       placeholder="" value="">

                            </div>
                            <div class="col-md-3 form-group">
                                <label for="report_date_to" class="col-form-label" for="report_date_to">To Date</label>
                                <input required type="text" id="report_date_to" name="report_date_to" class="form-control form-control--custom m-input m_datepicker"
                                       placeholder="" value="">

                            </div>

                            {{--<div class="col-md-4 form-group">--}}
                                {{--<label class="col-form-label mhada-multiple-label" for="period" style="">Period Range:<span class="star">*</span></label>--}}
                                {{--<select required name="period" title="Please Select Period" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">--}}
                                    {{--<option value="">Please select Period</option>--}}
                                    {{--@foreach(config('commanConfig.ebilling_pendency_report_periods') as $key=>$value)--}}
                                        {{--<option value="{{ $key }}">{{ $value }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-3 form-group">--}}
                                {{--<label class="col-form-label" for="date_of_meeting">Date of Resolution: <span class="star">*</span></label>--}}
                                {{--<input type="text" id="date_of_meeting" name="date_of_meeting" data-date-end-date="+0d" class="form-control form-control--custom m-input m_datepicker" value="{{ (isset($data) && $data->request_form->date_of_meeting) ? date(config('commanConfig.dateFormat'), strtotime($data->request_form->date_of_meeting)) : '' }}" required readonly>--}}
                                {{--<span class="help-block">{{$errors->first('date_of_meeting')}}</span>--}}
                            {{--</div>--}}

                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        {{--<input type="submit" class="btn mhada-custom-pdf" name="pdf" value="pdf">--}}
                                        <input type="submit" class="btn mhada-custom-excel" name="excel" value="excel">
                                        {{-- <button type="submit" class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                                        --}}
                                        {{-- <a href="{{route('pending_rti')}}" class="btn m-btn--pill m-btn--custom btn-metal">Reset</a>
                                        --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="m-portlet m-portlet--compact m-portlet--mobile">
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right">
                    <!-- <div class="form-group m-form__group row align-items-center"> -->

                    <!-- </div> -->
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                 <table class="table">
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <th>RTI Application No</th>
                        <th>Date of Submission</th>
                        <th>Applicant Name</th>
                        <th>Name of Department</th>
                        <th>Subject of Submitted RTI Application</th>
                        <th>Case Status</th>
                    </tr>
                    @foreach ($data['pending_rti'] as $data)
                    <tr>
                        <td>{{$data->unique_id}}</td>
                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                        <td>{{$data->applicant_name}}</td>
                        <td>{{$data->department->department_name}}</td>
                        <td>{{$data->info_subject}}</td>
                        <td>{{$data->current_status->status_title}}</td>
                    </tr>
                    @endforeach
                </table>
                <!--end: Datatable -->
            </div>
        </div> --}}
    </div>

@endsection


