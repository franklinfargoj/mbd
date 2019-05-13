@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Hearing Reports </h3>
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

                        <form class="form-group m-form__group row align-items-center mb-0 floating-labels-form" method="get" action="{{ route('hearing.reports.export') }}">
                            <div class="col-md-4 form-group">
                                <label class="col-form-label mhada-multiple-label" for="period" style="">Period Range:<span class="star">*</span></label>
                                <select name="period" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                    <option value="">All</option>
                                    @foreach(config('commanConfig.pendency_report_periods') as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="col-form-label mhada-multiple-label" for="status" style="">Status of applications:<span class="star">*</span></label>
                                <select required name="status" title="Please Select Status" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                    {{--<option value="">All</option>--}}
                                    @foreach($module_names as $key=>$value)
                                        <option value="{{$value}}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <input type="submit" class="btn mhada-custom-pdf" name="pdf" value="pdf">
                                        <input type="submit" class="btn mhada-custom-excel" name="excel" value="excel">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
