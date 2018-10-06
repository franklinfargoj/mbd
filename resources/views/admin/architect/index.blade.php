@extends('admin.layouts.app')
@section('css')
<style>
  /* Add a black background color to the top navigation */
.topnav {
    background-color: #F05C1B;
    overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 13px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: white;
  color: black;
}

/* Right-aligned section inside the top navigation */
.topnav-right {
  float: right;
}
  </style>
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Architect Applications
        </div>
        </h3>
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-md-12 order-2 order-xl-1">
                        <!-- <div class="form-group m-form__group row align-items-center"> -->
                        <form class="form-group m-form__group row align-items-end" method="get" action="{{url('architect_application')}}">
                            <div class="col-md-3">
                                <label for="exampleSelect1">Search For</label>
                                <input type="text" class="form-control form-control--custom m-input" placeholder="Application No, Candidate Name, Email ID OR Mobile No" title="Enter Application No, Candidate Name, Email ID OR Mobile No"
                                    id="m_form_search" name="keyword" value="{{ (!empty($getData) ? (isset($getData['keyword'])?$getData['keyword']:'') : '') }}">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" name="from" value="{{ (!empty($getData) ? (isset($getData['from'])?$getData['from']:'') : '') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" name="to" value="{{ (!empty($getData) ? (isset($getData['ro'])?$getData['to']:'') : '') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>Sort by Status</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="exampleSelect1" name="status">
                                        <option value="">All</option>
                                        @foreach(config('commanConfig.architect_applicationStatus') as $key=>$value)
                                        <option {{ (!empty($getData) ? (isset($getData['status'])?($getData['status']==$value?'selected':''):'') : '') }} value="{{$value}}">{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="submit" name="reset" value="Reset" class="btn btn-primary">Reset</button>
                            </div>
                            <!-- <div class="col-md-6 mt-5">
                                <div class="btn-list text-right">
                                    <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button>
                                    <a target="_blank" href=""
                                        class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
                                </div>
                            </div> -->
                            
                        </form>
                        
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="topnav">
            <a>Revision Requests</a>
              <div class="topnav-right">
                <a class="{{isset($_GET['application_status'])?($_GET['application_status']==0?'active':''):''}}" href="?application_status=0">All</a>
                <a class="{{isset($_GET['application_status'])?($_GET['application_status']==1?'active':''):''}}" href="?application_status=1">Shortlisted</a>
                <a class="{{isset($_GET['application_status'])?($_GET['application_status']==2?'active':''):''}}"  href="?application_status=2">Final</a>
              </div>
          </div>
            @if($is_commitee==true)
            <form method="post" action="{{route('finalise_architect_application')}}">
            @else
            <form method="post" action="{{route('shortlist_architect_application')}}">
            @endif
              @csrf
              @if($is_view==true)
              <div class="col-md-6 mt-5">
                  <button type="submit" name="shortlist" value="shortlist" class="btn btn-primary">Shortlist</button>
                  <button type="submit" name="remove_shortlist" value="remove_shortlist" class="btn btn-primary">Remove from Shortlisted Lis</button>
              </div>
              @endif 
              @if($is_commitee==true)
              <div class="col-md-6 mt-5">
                  <button type="submit" name="final" value="final" class="btn btn-primary">Add to Final list</button>
                  <button type="submit" name="remove_final" value="remove_final" class="btn btn-primary">Remaove from  Final list</button>
              </div>
              @endif
              {!! $html->table() !!}
            <!--end: Datatable -->
            </form>
            
        </div>
    </div>
    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
<?php //dd($html->scripts()); ?>
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    /*$( function() {
        $( "#published_from_date, #published_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );*/

</script>

@endsection
