@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Reports - RTI Submitted by Users</h3>
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
        </div>
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ route('rti_submitted_reports_by_users') }}">
                        <div class="col-md-2">
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
                        </div>
                        <div class="col">
                            <div class="form-group m-form__group">
                                <div class="btn-list">
                                    <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                    <a href="{{route('rti_submitted_reports_by_users')}}" class="btn m-btn--pill m-btn--custom btn-metal">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
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
                        <th>Name of User</th>
                        <th>Email ID</th>
                        <th>Mobile No</th>
                        <th>Address</th>
                        <th>Subject of Submitted RTI Application</th>
                    </tr>
                   @foreach ($data['report_submitted_by_users'] as $data)
                   <tr>
                        <td>{{$data->applicant_name}}</td>
                        <td>{{$data->users->email}}</td>
                        <td>{{$data->users->mobile_no}}</td>
                        <td>{{$data->applicant_addr}}</td>
                        <td>{{$data->info_subject}}</td>
                    </tr>
                   @endforeach
               </table>
                <!--end: Datatable -->
            </div>
    </div>
</div>
@endsection
