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
                        <i class="la la-cog"></i> Submit Report
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#forward-application-tab">
                        <i class="la la-cog"></i> Checklist & Remarks
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="scrutiny-history-tab">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Scrutiny Report
                                    </h3>
                                </div>
                            <a href="{{route('architect_layout_add_scrutiny_report',['layout_id'=>encrypt($ArchitectLayout->id)])}}" class="btn btn-primary mb-2">Add report</a>
                                <div class="remarks-suggestions">
                                    <table class="table">
                                        <tr>
                                            <th>Date</th>
                                            <th>Name Of Document</th>
                                            <th>File</th>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>Name Of Document</td>
                                            <td>File</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane show" id="forward-application-tab">
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
                </div>
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
