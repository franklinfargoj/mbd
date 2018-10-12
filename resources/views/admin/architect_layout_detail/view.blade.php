@extends('admin.layouts.app')
@section('content')
<div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Detail - {{$ArchitectLayout->layout_name}}</h3>
        </div>
</div>
<div class="m-portlet m-portlet--mobile m_panel">
    <div class="portlet-body">
        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
            <div class="m-subheader">
                <div class="d-flex align-items-center">
                    <h3 class="section-title section-title--small">
                    View Detail - {{$ArchitectLayout->layout_name}}
                    </h3>
                </div>
            </div>
            <button class="btn btn-primary">Add Detail</button>
        </div>
    </div>
</div>
<div class="m-portlet m-portlet--mobile m_panel">
<div class="portlet-body">
        <table border="1">
            <tr>
                <th>Date of update</th>
                <th>Latest layout</th>
                <th>Old Approved Layout</th>
                <th>Last submitted layout for approval</th>
                <th>CTS plan</th>
                <th>PRC</th>
                <th>DP remark, CRZ remark and other</th>
                <th>Survey report</th>
                <th>Executive Engineering report</th>
                <th>EM report</th>
                <th>Land Report</th>
                <th>REE</th>
                <th>Court matters or Disputes on land</th>
                <th>Action</th>
            </tr>
            @foreach($ArchitectLayout->layout_details as $layout_detail)
            <tr>
                <td><a target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->latest_layout}}">download</a></td>
                <td><a target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->old_approved_layout}}">download</a></td>
                <td><a target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->last_submitted_layout_for_approval}}">download</a></td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td>Dummy text</td>
                <td><a href="{{route('architect_layout_detail.add',['layout_id'=>encrypt($layout_detail->id)])}}">Edit</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
