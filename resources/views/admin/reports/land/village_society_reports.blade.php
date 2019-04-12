@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Reports - Village Society Report</h3>
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
            </div>
            @if(Session::has('error1'))
                <p class="alert alert-danger mt-2">{{ Session::get('error1') }}</p>
            @endif
            <div class="m-portlet m-portlet--compact filter-wrap">
                <div class="row align-items-center row--filter">
                    <div class="col-md-12">

                        <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ route('village_society_reports') }}">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label mhada-multiple-label" for="villages-select" style="">Villages:<span class="star">*</span></label>
                                <select required title="Please Select Village" data-live-search="true" id="villages-select" multiple class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        name="village_id[]">
                                    @foreach($villages as $key=>$value)
                                        <option value="{{ $value->id  }}">{{ $value->village_name }}</option>
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

        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Reports - Village Society Area Report</h3>
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
            </div>
            @if(Session::has('error2'))
                <p class="alert alert-danger mt-2">{{ Session::get('error2') }}</p>
            @endif
            <div class="m-portlet m-portlet--compact filter-wrap">
                <div class="row align-items-center row--filter">
                    <div class="col-md-12">

                        <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ route('village_society_area_reports') }}">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label mhada-multiple-label" for="villages-select" style="">Villages:<span class="star">*</span></label>
                                <select required title="Please Select Village" data-live-search="true" id="villages-select" multiple class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        name="village_id[]">
                                    @foreach($villages as $key=>$value)
                                        <option value="{{ $value->id  }}">{{ $value->village_name }}</option>
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

        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Reports - Layout Village Society Area Report</h3>
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
            </div>
            @if(Session::has('error3'))
                <p class="alert alert-danger mt-2">{{ Session::get('error3') }}</p>
            @endif
            <div class="m-portlet m-portlet--compact filter-wrap">
                <div class="row align-items-center row--filter">
                    <div class="col-md-12">

                        <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ route('village_society_layout_area_reports') }}">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label mhada-multiple-label" for="villages-select" style="">Layouts:<span class="star">*</span></label>
                                <select required title="Please Select Layout" data-live-search="true" id="layout-select" multiple class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        name="layout_id[]">
                                    @foreach($layouts as $key=>$value)
                                        <option value="{{ $value->id  }}">{{ $value->layout_name }}</option>
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
