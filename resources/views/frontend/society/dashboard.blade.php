@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
 <div class="m-subheader ">
    <div class="d-flex align-items-center">
       <div class="mr-auto">
          <h3 class="m-subheader__title m-subheader__title--separator">Dashboard </h3>
          {{ Breadcrumbs::render('society_dashboard') }}
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
      @if($ol_application_count == 0)
        <a class="btn btn-danger" href="{{asset('application')}}" style="float: right;margin-top: 3%">Fill Application for Offer Letter</a>
      @endif
    </div>
    <div class="m-portlet__body">
       <!--begin: Search Form -->
       <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
          <div class="row align-items-center">
             <div class="col-md-12 order-2 order-xl-1">
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

