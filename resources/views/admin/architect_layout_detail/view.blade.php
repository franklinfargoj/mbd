@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
@endsection
{{-- @extends('admin.layouts.app') --}}
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Layout Details -
                {{$ArchitectLayout->master_layout!=""?$ArchitectLayout->master_layout->layout_name:''}}</h3>
                {{ Breadcrumbs::render('architect_layout_details',$ArchitectLayout->id) }}
        </div>
    </div>
    {{-- <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            View Detail - {{$ArchitectLayout->layout_name}}
                        </h3>
                    </div>
                </div>
                @if($check_layout_details_complete_status==0 &&
                (session()->get('role_name')==config('commanConfig.junior_architect')))
                <a href="{{route('architect_layout_detail.add',['layout_id'=>encrypt($ArchitectLayout->id)])}}" class="btn btn-primary">Add
                    Detail</a>
                @endif
            </div>
        </div>
    </div> --}}
</div>
<div class="m-portlet m-portlet--mobile m_panel">
    <div class="portlet-body" style="overflow-y: scroll">
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
            @php $i=1; @endphp
            @foreach($ArchitectLayoutDetail as $layout_detail)
            <tr>
                <td>{{ date('d/m/Y', strtotime($layout_detail->created_at)) }}</td>
                <td><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->latest_layout}}">{!!$layout_detail->latest_layout!=""?'<img class="pdf-icon" src="'.asset('/img/pdf-icon.svg').'">':'-'!!}</a></td>
                <td><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->old_approved_layout}}">{!!$layout_detail->old_approved_layout!=""?'<img class="pdf-icon" src="'.asset('/img/pdf-icon.svg').'">':'-'!!}</a></td>
                <td><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->last_submitted_layout_for_approval}}">{!!$layout_detail->last_submitted_layout_for_approval!=""?'<img class="pdf-icon" src="'.asset('/img/pdf-icon.svg').'">':'-'!!}</a></td>

                <td><a class="btn-link" href="{{route('architect_layout_detail_view_cts_plan',['layout_detail_id'=>encrypt($layout_detail->id)])}}">View
                        Details</a></td>
                <td><a class="btn-link" href="{{route('architect_layout_detail_view_prc_detail',['layout_detail_id'=>encrypt($layout_detail->id)])}}">View
                        Details</a></td>
                <td><a class="btn-link" href="{{route('architect_detail_dp_crz_remark_view',['layout_detail_id'=>encrypt($layout_detail->id)])}}">View
                        Details</a></td>
                <td><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$layout_detail->survey_report}}">{!!$layout_detail->survey_report!=""?'<img class="pdf-icon" src="'.asset('/img/pdf-icon.svg').'">':'-'!!}</a></td>
                <td>
                    <ul>
                        @foreach($layout_detail->ee_reports as $ee_report)
                        <li><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$ee_report->upload_file}}">{{$ee_report->name_of_documents}}</a></li>
                        @endforeach
                        @if($layout_detail->ee_scrutiny_reports!=null)
                        <li><a href="javascript:void(0)" class="btn-link report-by" data-toggle="modal" data-target="#myModal" data-id="{{$layout_detail->id}}" data-branch="EE">report by EE</a></li>                        
                        @endif
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($layout_detail->em_reports as $em_report)
                        <li><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$em_report->upload_file}}">{{$em_report->name_of_documents}}</a></li>
                        @endforeach
                        @if($layout_detail->em_scrutiny_reports!=null)
                        <li><a href="javascript:void(0)" class="btn-link report-by" data-toggle="modal" data-target="#myModal" data-id="{{$layout_detail->id}}" data-branch="EM">report by EM</a></li>
                        @endif
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($layout_detail->land_reports as $land_report)
                        <li><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$land_report->upload_file}}">{{$land_report->name_of_documents}}</a></li>
                        @endforeach
                        @if($layout_detail->land_scrutiny_reports!=null)
                        <li><a href="javascript:void(0)"  class="btn-link report-by" data-toggle="modal" data-target="#myModal" data-id="{{$layout_detail->id}}" data-branch="Land">report by Land</a></li>
                        @endif
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($layout_detail->ree_reports as $ree_report)
                        <li><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$ree_report->upload_file}}">{{$ree_report->name_of_documents}}</a></li>
                        @endforeach
                        @if($layout_detail->ree_scrutiny_reports!=null)
                        <li><a href="javascript:void(0)" class="btn-link report-by" data-toggle="modal" data-target="#myModal" data-id="{{$layout_detail->id}}" data-branch="REE">report by REE</a></li>
                        @endif
                    </ul>
                </td>
                <td><a class="btn-link" href="{{route('view_court_case_or_dispute_on_land',['layout_detail_id'=>encrypt($layout_detail->id)])}}">View
                        Details</a></td>
                    <td>
                        <ul>
                        @if($i==1 && (session()->get('role_name') == config('commanConfig.junior_architect')))
                        @php $status=getLastStatusIdArchitectLayout($ArchitectLayout->id); @endphp
                        @if($status!="")
                        @if($status->status_id!=config('commanConfig.architect_layout_status.forward') &&
                        $status->status_id!=config('commanConfig.architect_layout_status.reverted') )
                        <li><a class="btn-link" href="{{route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($layout_detail->id)])}}">Edit</a></li>
                        @else
                        <center> - </center>
                        @endif
                        @endif
                        @else
                        <center> - </center>
                        @endif
                        @if($layout_detail->layout_excel_and_note!=null)
                        <li><a  href="javascript:void(0)" class="btn-link layout-excel" data-toggle="modal" data-mdata="{{$layout_detail->layout_excel_and_note}}" data-target="#layoutAndExcel">excel and layout</a></li>
                        @endif
                        </ul>
                    </td>
                </tr>

                @php $i++; @endphp
                @endforeach
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade mhada-vld-modal test" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
<<<<<<< HEAD
        <div class="modal-body">
          <p id="project-id">No Records Found</p>
=======
        <div class="modal-body p-0">
          <p id="project-id">Some text in the modal.</p>
>>>>>>> 01632e6b6e36d1d2f105429173771345654d8a19
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal -->
<div id="layoutAndExcel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Layout and Excel</h4>
        </div>
        <div class="modal-body excel-layout-data">
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>

<script id="blog" type="template">
    <table class="table">
        <tr>
            <th>Layout</th>
            <td><a target="_blank" href="{{config('commanConfig.storage_server')}}/<%=layout%>"><img class="pdf-icon" src="{{asset('/img/pdf-icon.svg')}}"></a></td>
        </tr>
        <tr>
            <th>Excel</th>
            <td><a target="_blank" href="{{config('commanConfig.storage_server')}}/<%=excel%>"><img class="pdf-icon" src="{{asset('/img/excel-icon.svg')}}"></a></a></td>
        </tr>
        <tr>
            <th>Architect Note</th>
            <td><a target="_blank" href="{{config('commanConfig.storage_server')}}/<%=architect_note%>"><img class="pdf-icon" src="{{asset('/img/pdf-icon.svg')}}"></a></td>
        </tr>
    </table>
</script> 
@endsection
@section('js')
<script>
$(document).ready(function () {
        $(document).on("click", ".report-by", function () {
            var layout_detail_id = $(this).data('id');
            var branch = $(this).data('branch');
            // console.log(branch)
            // console.log(layout_detail_id)
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
            $.ajax({
                    url: '{{route("scrutiny_report_by_em")}}',
                    method: 'post',
                    data: {
                        layout_detail_id: layout_detail_id,
                        branch:branch
                    },
                    success: function (data) {
                        //console.log(data)
                        $(".modal-body #project-id").html(data);
                    }
                })
          //  console.log(projectId)
            //$(".modal-body #project-id").html(projectId);
        });
        $(document).on('click','.layout-excel',function(){
            var data=$(this).data('mdata');
            var temp = $.trim($('#blog').html());
           // $.each(JSON.parse(data), function(index, data) {
                var x = temp.replace(/<%=layout%>/, data.upload_layout_in_pdf_format).replace(/<%=excel%>/, data.upload_layout_in_excel_format).replace(/<%=architect_note%>/, data.upload_architect_note);
                //console.log(x)
                $('.excel-layout-data').html(x);
            //});
            //$("#excel-layout-data").html(data.upload_layout_in_pdf_format)
            console.log(data);
        });
    });
</script>
@endsection
