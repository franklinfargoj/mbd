@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Reports - Period Wise Pendency (Architect)</h3>
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

                        <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ route('architect_pending_reports') }}">

                            <div class="col-md-4 form-group">
                                <select name="period" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                    <option value="">All</option>
                                    @foreach(config('commanConfig.pendency_report_periods') as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="pdf" value="pdf">
                                        <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="excel" value="excel">
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

