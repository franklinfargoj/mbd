@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
 <div class="m-subheader ">
    <div class="d-flex align-items-center">
       <div class="mr-auto">
          <h3 class="m-subheader__title m-subheader__title--separator">RTI Applicants Listing </h3>
       </div>
       <div>
       </div>
    </div>
 </div>
 <!-- END: Subheader -->           
 <div class="m-content"></div>
 <div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
       <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
             <h3 class="m-portlet__head-text">
                
             </h3>
          </div>
       </div>
    </div>
    <div class="m-portlet__body">
       <!--begin: Search Form -->
       <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
          <div class="row align-items-center">
             <div class="col-md-12 order-2 order-xl-1">
                <!-- <div class="form-group m-form__group row align-items-center"> -->
                  <form class="form-group m-form__group row align-items-center" method="get" action="{{ url('rti_applicants') }}">
                    <div class="col-md-6">
                        <label for="date_of_submission" class="col-md-4 control-label">
                            Date of Submission
                        </label>
                        <div class="col-md-8">
                            <input type="date" name="date_of_submission" id="date_of_submission" class="form-control" value="{{ isset($getData['date_of_submission'])? $getData['date_of_submission'] : '' }}">
                        </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group m-form__group">
                        <label class="col-md-3 control-label">
                            Status
                        </label>
                        <div class="col-md-9">
                            <select name="status" class="form-control">
                                <option value="0">  Select Status  </option>
                              @foreach($rti_statuses as $rti_status)
                                <option value="{{ $rti_status['id'] }}" 
                                @if(count($getData) > 0)
                                    {{ ($rti_status['id'] == $getData['status'] ?'selected':'' )}}
                                @endif>{{ $rti_status['status_title'] }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                   </div>
                   <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                     <div class="m-form__actions m-form__actions">
                        <div class="row">
                           <div class="col-lg-6">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </div>
                  </div>
                </form>                   
                <!-- </div> -->
             </div>
          </div>
       </div>
       <!--end: Search Form -->
       <!--begin: Datatable -->
        {!! $html->table() !!}
       <!--end: Datatable -->
    </div>
 </div>
 <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  
</div>
 <!-- END EXAMPLE TABLE PORTLET-->  
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
  <script>
    function deleteResolution(id)
    {
      if(confirm("Are you sure to delete?"))
      {
        console.log(id);
        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            data:{
              id:id
            },
            url:"{{ route('loadDeleteReasonOfResolutionUsingAjax') }}",
            success:function(res)
            {
              $("#myModal").html(res);
              $("#myModalBtn").click();
            }
        });
      }
    }
  </script>
@endsection