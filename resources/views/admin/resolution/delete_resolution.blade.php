    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>   
@section('add_resolution_js')
<script>
 $(document).ready(function () {
        $(document).on("click", ".delete-resolution", function () {
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
                url:"{{ route('loadDeleteReasonOfResolutionUsingAjax') }}",
                success:function(res)
                {
                    $("#myModal").html(res);
                    $("#myModalBtn").click();
                }
            });
        });
    });
</script>    
@endsection