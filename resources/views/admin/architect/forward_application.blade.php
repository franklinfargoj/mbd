@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect.actions',compact('ArchitectApplication'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{ Breadcrumbs::render('forward_architect_application',$ArchitectApplication->id) }}
            <div class="ml-auto btn-list mb-0">
                <a href="{{route('architect_application')}}" class="btn btn-link"><i
                        class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="">
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
            <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
                    <i class="la la-cog"></i> Scrutiny History
                </a>
            </li>
        @php
        $status=getLastStatusIdArchitectApplication($ArchitectApplication->id);
        $app=DB::table('eoa_applications')->where('id',$ArchitectApplication->id)->first();
        @endphp
        @if($status)
            @if($status['status_id']!=config('commanConfig.architect_applicationStatus.forward'))
                @if(($ArchitectApplication->application_status!='Final') ||
                config('commanConfig.architect')!=session()->get('role_name'))
                    @if(config('commanConfig.selection_commitee')!=session()->get('role_name') && $app->application_status >= config('commanConfig.architect_application_status.shortListed'))
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link show" data-toggle="tab" href="#forward-application-tab">
                            <i class="la la-cog"></i> Forward Application
                        </a>
                    </li>
                    @endif
                    @if(config('commanConfig.selection_commitee')==session()->get('role_name') && $app->application_status >= config('commanConfig.architect_application_status.final'))
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link show" data-toggle="tab" href="#forward-application-tab">
                            <i class="la la-cog"></i> Forward Application
                        </a>
                    </li>
                    @endif
                @endif
            @endif
        @endif
        </ul>

        <div class="tab-content">

            <div class="tab-pane active show" id="scrutiny-history-tab">
                
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                            <table class="table">
                                <thead class="thead-default">
                                    <tr>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    @forelse($master_log as $log)
                                    <tr>
                                        <td>{{$log['role_id']}}</td>
                                        <td>{{$log['date']}}</td>
                                        <td>{{$log['time']}}</td>
                                        <td>{{$log['action']}}</td>
                                        <td>{{$log['description']}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No Records Found</td>
                                    </tr>
                                    @endforelse
            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane show" id="forward-application-tab">
                <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
                    {{-- <span class="text-danger">Note:-Click on forward to send application for verification </span> --}}
                    <form action="{{route('architect.post_forward_application')}}" id="forwardApplication" method="post">
                        @csrf
                        <input type="hidden" name="application_id" value="{{ $arrData['architect_details']->id }}">
                        <input type="hidden" name="to_role_id" id="to_role_id">
            
                        <div class="m-portlet__body m-portlet__body--spaced">
                            <div class="m-form__group form-group">
                                <div class="form-group m-form__group row mt-3 parent-data">
                                    <label class="col-form-label col-sm-2">Forward To:</label>
                                    <div class="col-sm-4 form-group">
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            name="to_user_id" id="to_user_id">
                                            @if($arrData['parentData'])
                                            @foreach($arrData['parentData'] as $parent)
                                            <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }}
                                                ({{
                                                $arrData['role_name'] }})</option>
                                            @endforeach
                                            @else
                                            @foreach($arrData['get_forward_commitee'] as $parent)
                                            <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }}
                                                ({{
                                                $arrData['commitee_role_name'] }})</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
            
                                <div class="mt-3 table--box-input">
                                    <label for="remark">Remark : [Forward for Approval/Scrutiny/Certificate Generation]</label>
                                    <textarea class="form-control form-control--custom" name="remark" id="remark" cols="30" rows="5"></textarea>
                                </div>
                                <div class="mt-4 btn-list">
                                    <button type="submit" class="btn btn-primary">Forward</button>
                                    {{--<button type="submit" class="btn btn-primary">Sign & Forward</button>
                                    <button type="submit" class="btn btn-primary">Forward</button>--}}
                                    <button type="button" onclick="window.location.href='{{ url("/architect_application") }}'"
                                        class="btn btn-secondary">Cancel</button>
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
@section('js')
<script>
    $("#forwardApplication").on("submit", function () {
        var data = $(".check_status").val();
        var id = $("#to_user_id").find('option:selected').attr("data-role");
        $("#to_role_id").val(id);
    });

</script>
@endsection
