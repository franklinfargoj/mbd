@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.application_status.actions')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">View Role</h3>
                {{ Breadcrumbs::render('application_status_view',$status['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="status_name">Application Status Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" disabled id="status_name" name="status_name" class="form-control form-control--custom m-input"  value="{{ $status['status_name'] }}">
                            <span class="text-danger">{{$errors->first('status_name')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <a href="{{route('application_status.index')}}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@section('js')--}}
    {{--<script>--}}
        {{--var file = "{{ $arrData['village_data']['7_12_extract'] }}";--}}

        {{--if (file == 1) {--}}
            {{--$(".extract_upload").show();--}}
        {{--} else {--}}
            {{--$(".extract_upload").hide();--}}
        {{--}--}}
        {{--$(".file_upload").on("change", function () {--}}
            {{--if ($(this).val() == 1) {--}}
                {{--$(".extract_upload").show();--}}
            {{--} else {--}}
                {{--$(".extract_upload").hide();--}}
            {{--}--}}
        {{--});--}}

    {{--</script>--}}
{{--@endsection--}}
