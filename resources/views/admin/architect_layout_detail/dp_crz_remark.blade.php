@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View DP Remark & CRZ Remark Details -
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
            <form enctype="multipart/form-data" method="post" action="{{route('post_architect_detail_dp_crz_remark_add')}}">
                @csrf
                <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                DP Remark
                            </h3>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">Letter</label>
                            </div>
                            <div class="col-lg-7 form-group">

                                <div class="custom-file">
                                    <input class="custom-file-input" name="dp_remark_letter" type="file" id="dp_remark_letter_file">
                                    <label class="custom-file-label" for="dp_remark_letter_file">Choose file...</label>
                                    <a target="_blank" id="dp_remark_letter_uploaded_file" href=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">DP Plan</label>
                            </div>
                            <div class="col-lg-7 form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="dp_remark_plan" type="file" id="dp_remark_plan_file">
                                    <label class="custom-file-label" for="dp_remark_plan_file">Choose file...</label>
                                    <a target="_blank" id="dp_remark_plan_uploaded_file" href=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">Comments</label>
                            </div>
                            <div class="col-lg-7 form-group">
                                <div class="custom-file">
                                    <textarea type="text" name="dp_comment" id="dp_comment" class="form-control form-control--custom form-control--fixed-height">{{old('dp_comment')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                CRZ Remark
                            </h3>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">Letter</label>
                            </div>
                            <div class="col-lg-7 form-group">

                                <div class="custom-file">
                                    <input class="custom-file-input" name="crz_remark_letter" type="file" id="crz_remark_letter_file">
                                    <label class="custom-file-label" for="crz_remark_letter_file">Choose file...</label>
                                    <a target="_blank" id="crz_remark_letter_uploaded_file" href=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">CRZ Plan</label>
                            </div>
                            <div class="col-lg-7 form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="crz_remark_plan" type="file" id="crz_remark_plan_file">
                                    <label class="custom-file-label" for="crz_remark_plan_file">Choose file...</label>
                                    <a target="_blank" id="crz_remark_plan_uploaded_file" href=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">Comments</label>
                            </div>
                            <div class="col-lg-7 form-group">
                                <div class="custom-file">
                                    <textarea type="text" name="crz_comment" id="crz_comment" class="form-control form-control--custom form-control--fixed-height">{{old('crz_comment')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions px-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="btn-list">
                                            <button type="submit" class="btn btn-primary"> Save </button>
                                            <a href="{{route('architect_layout_detail.add',['layout_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                                role="button" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
