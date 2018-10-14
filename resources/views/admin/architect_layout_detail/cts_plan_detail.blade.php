@extends('admin.layouts.app')
@section('js')
<script>
    $(document).ready(function() {  
        $('.add').click(function() {
            $('.block:last').after('<div class="block"><input placeholder="CTS no" type="text" name="cts_no[]" class="form-control form-control--custom" required><a href="#" class="remove">Remove</a></div>');
        });
        $('.optionBox').on('click','.remove',function() {
            $(this).parent().remove();
        }); 
    });
    function deleteCtsDetail(tt,id)
    {
        if(confirm('Are you sure?'))
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
            });
            $.ajax({
                url:'{{route("delete_cts_detail")}}',
                method:'POST',
                data:{cts_detail_id:id},
                success:function(data){
                    console.log(data);
                    $(tt).parent().remove();
                }
            })
        }
    }

</script>
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View CTS Plan Details -
                {{$ArchitectLayoutDetail->architect_layout->layout_name}}</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            @if(Session::has('success'))
            <div class="alert alert-success">
                <p> {{ Session::get('success') }} </p>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <p> {{ Session::get('error') }} </p>
            </div>
            @endif
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            CTS plan
                        </h3>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="{{route('post_cts_detail')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="Upload_Cts_Plan">Upload CTS Plan</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="cts_plan_file" type="file" id="cts_plan_file">
                                    <label class="custom-file-label" for="cts_plan_file">Choose file...</label>
                                    <a target="_blank" id="cts_plan" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->cts_plan}}"
                                        style="display:{{$ArchitectLayoutDetail->cts_plan!=''?'block':'none'}};">uploaded
                                        file</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="Upload_Cts_Plan">List of CTS No</label>
                            </div>
                            <div class="col-lg-6 form-group">
                                <!-- <label class="col-form-label">List of CTS No</label> -->
                                <div class="optionBox">
                                    @if(count($ArchitectLayoutDetail->cts_plan_details)>0)
                                    @php $j=1; @endphp
                                    @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                    <div class="block">
                                        <input type="hidden" name="cts_plan_detail_id[]" value="{{$cts_plan_detail->id}}">
                                        <input placeholder="CTS no" type="text" name="cts_no[]" class="form-control form-control--custom"
                                            value="{{ $cts_plan_detail->cts_no }}" required>
                                        @if($j!=1)
                                        <a href="#" onclick="deleteCtsDetail(this,{{$cts_plan_detail->id}})" class="remove">Remove</a>
                                        @endif
                                    </div>
                                    @php $j++; @endphp
                                    @endforeach
                                    @else
                                    <div class="block">
                                        <input type="hidden">
                                        <input placeholder="CTS no" type="text" name="cts_no[]" class="form-control form-control--custom"
                                            required>
                                        <a href="#" class="remove">Remove</a>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <div class="col-lg-7 form-group">
                                        <a class="add" href="javascript:void">add more<a>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                                    <a href="{{route('architect_layout_detail.add',['layout_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                        class="btn btn-primary btn-custom">Back</a>
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
