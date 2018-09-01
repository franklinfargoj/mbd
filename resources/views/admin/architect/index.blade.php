@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>FAQ</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> FAQs
  <small>&nbsp;</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    @if(Session::has('success'))
    <div class="note note-success">
      <div class="caption">
        <i class="fa fa-gift"></i> {{Session::get('success')}}
      </div>
      <div class="tools pull-right">
        <a href="" class="remove" data-original-title="" title=""> </a>
      </div>
    </div>
    @endif

    <div class="portlet box ">
      <div class="portlet-body">
        <form method="get" action="{{url('architect_application')}}">
          @csrf
          <div class="row-fluid search-form-wrapper">
            <div class="span12">
              <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span3 control-label" for="form_control_1">Search For</label>
                        <div class="span8 select-wrapper">
                            <input type="text" name="keyword" value="{{old('keyword')}}" placeholder="Application No, Candidate Name, Email ID OR Mobile No" title="Enter Application No, Candidate Name, Email ID OR Mobile No" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span2 control-label" for="form_control_1">From</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="from" value="{{old('from')}}" class="span12 m-wrap">
                        </div>

                        <label class="span2 control-label" for="form_control_1">To</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="to" value="{{old('to')}}" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
            </div>
            <div class="span12">
              <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span3 control-label" for="form_control_1">Sort by Status</label>
                        <div class="span8 select-wrapper">
                            <select name="status" class="span12 m-wrap">
                              
                            </select>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span2 control-label" for="form_control_1">From</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="from" value="{{old('from')}}" class="span12 m-wrap">
                        </div>

                        <label class="span2 control-label" for="form_control_1">To</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="to" value="{{old('to')}}" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
            </div>
          <div>
        </form>
      </div>
    </div>

        <div class="portlet light bordered">
          <div class="portlet-title tabbable-line">
            <div class="caption">
              <span class="caption-subject bold font-yellow-lemon uppercase"> Applications for Architect panel Listing </span>
            </div>
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#portlet_tab1" data-toggle="tab" aria-expanded="true"> Tab 1 </a>
              </li>
              <li class="">
                <a href="#portlet_tab2" data-toggle="tab" aria-expanded="false"> Tab 2 </a>
              </li>
              <li class="">
                <a href="#portlet_tab3" data-toggle="tab" aria-expanded="false"> Tab 3 </a>
              </li>
            </ul>
          </div>
          <div class="portlet-body">
            <div class="tab-content">
              <div class="tab-pane active" id="portlet_tab1">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                  <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Application No.</th>
                        <th>Date</th>
                        <th>Condidate Name</th>
                        <th>Email ID & <br/>Mobile No</th>
                        <th>Status</th>
                        <th>Marks</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=0 @endphp
                      @forelse($applications as $row)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->application_number}}</td>
                        <td>{{$row->application_date}}</td>
                        <td>{{$row->candidate_name}}</td>
                        <td>{{$row->candidate_email}}<br>{{$row->candidate_mobile_no}}</td>
                        <td>{{$row->status}}</td>
                        <td>{{$row->status}}</td>
                        <td>
                          <a title="Edit" href="{{ route('faq.edit', $row->id) }}">Edit</a>
                          &nbsp;
                          <a title="Edit" href="{{ url('faq/change_status/'. $row->id) }}">{{($row->status==0)? 'Inactive' : 'Active'}}</a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="8">No record found</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 104.439px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
              </div>
              <div class="tab-pane" id="portlet_tab2">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                  <h4>Tab 2 Content</h4>
                  <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo. </p>
                    <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                      luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                      erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna. </p>
                    </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                  </div>
                  <div class="tab-pane " id="portlet_tab3">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                      <h4>Tab 3 Content</h4>
                      <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                        luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                        erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna. </p>
                        <p> Ut wisi enim ad btn-smm veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse
                          molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                        </p>
                      </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 109.89px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- BEGIN SAMPLE TABLE PORTLET-->
              <div class="portlet box purple">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-cogs"></i>Applications for Architect panel Listing </div>
                    <div class="tools1 pull-right">

                    </div>
                  </div>
                  <div class="portlet-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
                        <thead>
                          <tr>
                            <th>Sr No.</th>
                            <th>Application No.</th>
                            <th>Date</th>
                            <th>Condidate Name</th>
                            <th>Email ID & <br/>Mobile No</th>
                            <th>Status</th>
                            <th>Marks</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i=0 @endphp
                          @forelse($applications as $row)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->application_number}}</td>
                            <td>{{$row->application_date}}</td>
                            <td>{{$row->candidate_name}}</td>
                            <td>{{$row->candidate_email}}<br>{{$row->candidate_mobile_no}}</td>
                            <td>{{$row->status}}</td>
                            <td>{{$row->status}}</td>
                            <td>
                              <a title="Edit" href="{{ route('faq.edit', $row->id) }}">Edit</a>
                              &nbsp;
                              <a title="Edit" href="{{ url('faq/change_status/'. $row->id) }}">{{($row->status==0)? 'Inactive' : 'Active'}}</a>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="8">No record found</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
              </div>
            </div>
            @endsection
