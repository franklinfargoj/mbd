@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
@endsection
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{-- {{ Breadcrumbs::render('forward_application-dyce',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
                        <i class="la la-cog"></i> Add Report
                    </a>
                </li>

                {{-- <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#forward-application-tab">
                        <i class="la la-cog"></i> Checklist & Remarks
                    </a>
                </li> --}}
            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="scrutiny-history-tab">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Upload  Report
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">
                                        <form action="{{route('architect_layout_post_scrutiny_report')}}" id="forwardApplication"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="architect_layout_id" value="{{$ArchitectLayout->id}}">
                                        <div class="row">
                                            <div class="col-lg-2 form-group">
                                                <label>Document Name</label>
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                <div class="custom-file">
                                                <input type="text" name="document_name" class="form-control form-control--custom" value="{{old('document_name')}}">
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
                                                    @if ($errors->has('doc_file'))
                                                        <span class="text-danger">{{ $errors->first('doc_file') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto">
                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                                            <a href="{{route('architect_layout_get_scrtiny',['layout_id'=>encrypt($ArchitectLayout->id)])}}"
                                                    class="btn btn-primary btn-custom">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tab-pane show" id="forward-application-tab">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Checklist & Remarks
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">
                                    <form action="{{route('post_forward_architect_layout')}}" id="forwardApplication"
                                        method="post">
                                        @csrf

                                        <input type="hidden" name="architect_layout_id" value="{{$ArchitectLayout->id}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".forward-application").change(function () {
            var data = $(this).val();

            if (data == 1) {
                $(".parent-data").show();
                $(".child-data").hide();
                $(".check_status").val(1)
            } else {
                $(".parent-data").hide();
                $(".child-data").show();
                $(".check_status").val(0);
            }
        });

        $("#forwardApplication").on("submit", function () {
            var data = $(".check_status").val();
            if (data == 1) {
                var id = $("#to_user_id").find('option:selected').attr("data-role");
            } else {
                var id = $("#to_child_id").find('option:selected').attr("data-role");
            }

            $("#to_role_id").val(id);
        });
    });

</script>

@endsection
