@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
@endsection
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('architect_layout_scrutiny_remarks',$ArchitectLayout->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
                        <i class="la la-cog"></i> Scrutiny Report
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
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                {{-- <div class="">
                                    <h3 class="section-title section-title--small">
                                        Scrutiny Report
                                    </h3>
                                </div> --}}
                                {{-- {{$read_only}} --}}
                                @if($read_only!=1)
                                <a href="{{route('architect_layout_add_scrutiny_report',['layout_id'=>encrypt($ArchitectLayout->id)])}}"
                                    class="btn btn-primary mb-2">Add report</a>
                                @endif
                                <div class="remarks-suggestions">
                                    <table class="table" style="width:50%">
                                        <tr>
                                            <th>Date</th>
                                            <th>Name Of Document</th>
                                            <th>File</th>
                                            @if($read_only!=1)
                                            <th>Delete</th>
                                            @endif
                                        </tr>
                                        @foreach($scrutiny_reports as $scrutiny_report)
                                        @forelse($scrutiny_report as $report)
                                        <tr>
                                            <td>{{
                                                date('d/m/Y',strtotime($report->created_at))
                                                }}</td>
                                            <td>{{ $report->name_of_document }}</td>
                                            <td>
                                                <a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$report->file}}">download</a>
                                            </td>
                                            @if($read_only!=1)
                                            <td>
                                                <form method="post" action="{{route('delete_architect_layout_scrutiny_report')}}">
                                                    @csrf
                                                    <input type="hidden" name="report_id" value="{{encrypt($report->id)}}">
                                                    <button type="submit" onclick="return confirm('are you sure?')" name="final" value="final" class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column">
                                                        <span class="btn-icon btn-icon--delete">
                                                            <img src="{{ asset('/img/delete-icon.svg')}}">
                                                        </span>
                                                    </button>
                                                </form>
                                                {{-- <a class="d-flex flex-column align-items-center" title="Delete"
                                                    href="Javascript:void(0);">
                                                    <span class="btn-icon btn-icon--delete">
                                                        <img src="{{ asset('/img/delete-icon.svg')}}">
                                                    </span>
                                                </a> --}}
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{$read_only!=1?4:3}}">No Record Found</td>
                                        </tr>
                                        @endforelse
                                        @endforeach
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
                                    {{-- <h3 class="section-title section-title--small">
                                        Checklist & Remarks
                                    </h3> --}}
                                </div>
                                <div class="remarks-suggestions scrutiny-checklist_and_remarks">
                                    <div id="wrapper">
                                        @if(isset($post_route_name) && isset($upload_file_route_name))
                                        @include('admin.architect_layout.scrutiny.checklist_and_remark',compact('read_only','check_list_and_remarks','post_route_name','upload_file_route_name'))
                                        @endif
                                        {{-- @if(session()->get('role_name')==config('commanConfig.land_manager'))
                                        @include('admin.architect_layout.scrutiny.lm_checklist_and_remark',compact('check_list_and_remarks',''))
                                        @endif
                                        @if(session()->get('role_name')==config('commanConfig.estate_manager'))
                                        @include('admin.architect_layout.scrutiny.em_checklist_and_remark',compact('check_list_and_remarks','post_route_name','upload_file_route_name'))
                                        @endif --}}
                                    </div>
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

        $('body').on('click', '.add_report', function () {
            var count = $(".optionBox > div").length;
            count++;
            $('.block:last').after(
                '<div class="block">' +
                '<input type="hidden" name="report_id[]" id="report_id_' + count + '" value="">' +
                '<div class="m-form__group row">' +
                '<div class="col-lg-3 form-group">' +
                '<label for="Upload_Cts_Plan">Remark</label>' +
                '</div>' +
                '<div class="col-lg-7 form-group">' +
                '<div class="custom-file">' +
                '<textarea type="text" name="remark[]" id="remark" class="form-control form-control--custom form-control--fixed-height"></textarea>' +
                '<span class="error"></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="m-form__group row">' +
                '<div class="col-lg-3 form-group">' +
                '<label for="Upload_Cts_Plan">Upload Report</label>' +
                '</div>' +
                '<div class="col-lg-7 form-group">' +
                '<div class="custom-file">' +
                '<input class="custom-file-input" name="crz_remark_plan[]" type="file" onchange="upload_report(this.id,\'report_id_' +
                count + '\',\'report_file_' + count + '\',\'report_file_link_' + count +
                '\')" id="report_file_' + count + '">' +
                '<label class="custom-file-label" for="report_file_' + count +
                '">Choose file...</label>' +
                '<input type="hidden" name="report_file_name[]" id="report_file_' + count +
                '" value="">' +
                '<a class="btn-link" target="_blank" id="report_file_link_' + count +
                '" style="display:none">download</a>' +
                '</div>' +
                '</div>' +
                '<div class="col-lg-2 form-group mt-2">' +
                '<a href="" class="removeChecklistAndRemark"><i class="fa fa-close btn--add-delete"></i></a>' +
                '</div>' +
                '</div>'
            );
            $('.m-bootstrap-select').selectpicker('refresh');
            showUploadedFileName();
        });

        $('body').on('click', '.removeChecklistAndRemark', function (e) {
            e.preventDefault()
            //console.log($(this).parent().parent().parent().parent()[0])
            $(this).parent().parent().parent()[0].remove()
        })

        function showUploadedFileName() {
            $('.custom-file-input').change(function (e) {
                $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
            });
        }

    });

    function upload_report(current_id, report_id, report_file_name, report_file_link) {
        var upload_file_route_name = $("#upload_file_route_name").val();
        $(".loader").show();
        var architect_layout_id = $('#architect_layout_id').val();
        var report_id = document.getElementById(report_id).value;
        var filename = $("#" + current_id).val();
        var extension = filename.replace(/^.*\./, '');
        if (extension == 'pdf') {
            var file_data = $('#' + current_id).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('architect_layout_id', architect_layout_id);
            form_data.append('report_id', report_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });
            $.ajax({
                url: upload_file_route_name, // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function (data) {
                    console.log(data)
                    $(".loader").hide();
                    if (data.status == true) {

                        $("#" + report_file_link).prop("href", data.file_path)
                        $("#" + report_file_link).css("display", "block");
                        var res = report_file_link.split("_");
                        var report_id = res[res.length - 1]
                        $('#report_id_' + report_id).val(data.doc_id)
                    } else {}
                }
            });
        } else {
            var filename = $("#" + current_id).val('');
            alert('please upload pdf file');
            $(".loader").hide();
        }

    }

            //tab localstorage
$(document).ready(function () {

// **Start** Save tabs location on window refresh or submit

// Set first tab to active if user visits page for the first time

if (localStorage.getItem("activeTab") === null) {
    document.querySelector(".nav-link.m-tabs__link").classList.add("active", "show");
} else {
    document.querySelector(".nav-link.m-tabs__link").classList.remove("active", "show");
}

if (location.hash) {
    $('a[href=\'' + location.hash + '\']').tab('show');
}
var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
    $('a[href="' + activeTab + '"]').tab('show');
}

$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
    e.preventDefault()
    var tab_name = this.getAttribute('href')
    if (history.pushState) {
        history.pushState(null, null, tab_name)
    } else {
        location.hash = tab_name
    }
    localStorage.setItem('activeTab', tab_name)

    $(this).tab('show');

    localStorage.clear();
    return false;
});

$(window).on('popstate', function () {
    var anchor = location.hash ||
        $('a[data-toggle=\'tab\']').first().attr('href');
    $('a[href=\'' + anchor + '\']').tab('show');
    window.scrollTo(0, 0);
});

// // **End** Save tabs location on window refresh or submit

})

</script>

@endsection
@section('css')
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }

</style>
@endsection
