@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.colony.actions')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">View Colony</h3>
                {{ Breadcrumbs::render('colony_view',$colony_data['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="name">Colony Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input disabled type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ $colony_data['name'] }}">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="description">Colony Description:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input disabled type="text" id="description" name="description" class="form-control form-control--custom m-input"  value="{{ $colony_data['description'] }}">
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="layout_id">Layouts:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select disabled data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id">
                                    <option>{{$colony_data['get_ward_name']['get_layout_name']['layout_name']}}</option>
                            </select>
                        </div>
                    </div>

                    <div id="ward" class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="ward_id">Wards:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select disabled data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="ward_id" name="ward_id">
                                    <option>{{$colony_data['get_ward_name']['name']}}</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <a href="{{route('colony.index')}}" class="btn btn-secondary">Cancel</a>
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
