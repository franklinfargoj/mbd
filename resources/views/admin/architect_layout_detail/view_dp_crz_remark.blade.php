@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View DP Remark & CRZ Remark Details -
                {{$ArchitectLayoutDetail->architect_layout->master_layout!=""?$ArchitectLayoutDetail->architect_layout->master_layout->layout_name:''}}</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            DP Remark
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <tr class="thead-default">
                                <th>Letter</th>
                                <th>DP Plan</th>
                                <th>Comment</th>
                            </tr>
                            @forelse ($ArchitectLayoutDetail->ArchitectLayoutDetailDpRemark as $item)
                            <tr>
                                <td>
                                    <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->dp_letter}}">download</a>
                                </td>
                                <td>
                                    <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->dp_plan}}">download</a>
                                </td>
                                <td>
                                    {{$item->dp_comment}}
                                </td>

                            </tr>
                            @empty
                            <tr class="thead-default">
                                <td colspan="4"><span class="text-danger">No record found</span></td>
                            </tr>
                            @endforelse
                        </table>
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
                    <div class="table-responsive">
                        <table class="table text-center">
                            <tr class="thead-default">
                                <th>Letter</th>
                                <th>CRZ Plan</th>
                                <th>Comment</th>
                            </tr>
                            @forelse ($ArchitectLayoutDetail->ArchitectLayoutDetailCrzRemark as $item)
                            <tr>
                                <td>
                                    <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->crz_letter}}">download</a>
                                </td>
                                <td>
                                    <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->crz_plan}}">download</a>
                                </td>
                                <td>
                                    {{$item->crz_comment}}
                                </td>

                            </tr>
                            @empty
                            <tr class="thead-default">
                                <td colspan="4"><span class="text-danger">No record found</span></td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
