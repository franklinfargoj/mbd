
<input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">

</div>
<!-- END EXAMPLE TABLE PORTLET-->


@section('js')
    <script>
        $(document).ready(function () {
            $(document).on("click", ".delete-hearing", function () {
                var id = $(this).attr("data-id");
                console.log(id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    data:{
                        id:id
                    },
                    url:"{{ route('loadDeleteReasonOfHearingUsingAjax') }}",
                    success:function(res)
                    {
                        $("#myModal").html(res);
                        $("#myModalBtn").click();
                    }
                });
            });
        });

    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('table').dataTable({searching: false, ordering:false, info: false});    

    </script>    
@endsection