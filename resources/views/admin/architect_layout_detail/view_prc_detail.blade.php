@extends('admin.layouts.app')
@section('js')
<script>
    $(document).ready(function () {
        
        
        $('.add').click(function () {
            var count=$(".optionBox > div").length;
            count++;
            $('.block:last').after(
                '<div class="block">'+
                '<div class="form-group m-form__group row mb-0">'+
                            '<div class="col-lg-5 form-group">'+
                                '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="" name="cts_no[]">'+
                                    @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                    '<option value="{{$cts_plan_detail->id}}">{{$cts_plan_detail->cts_no}}</option>'+
                                    @endforeach
                                '</select>'+
                                '<span class="help-block"></span>'+
                            '</div>'+
                            '<div class="col-lg-5 form-group">'+
                                '<div class="custom-file">'+
                                    '<input type="file" id="extract_'+count+'" name="pr_cards[]" class="custom-file-input">'+
                                    '<label title="" class="custom-file-label" for="extract_'+count+'">Choose file</label>'+
                                    '<span class="help-block"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-lg-2 form-group mt-2">'+
                                '<a href="#" class="remove"><i class="fa fa-close btn--add-delete"></i></a>'+
                            '</div>'+
                        '</div>'+
                '</div>'
            );
            $('.m-bootstrap-select').selectpicker('refresh');
            showUploadedFileName();
        });

        function showUploadedFileName() {
            $('.custom-file-input').change(function (e) {
                $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
            });
        }

        $('.optionBox').on('click', '.remove', function () {
            $(this).parent().parent().remove();
        });
    });

    function deletePrCardDetail(tt,id)
    {
        if(confirm('Are you sure?'))
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
            });
            $.ajax({
                url:'{{route("delete_prc_detail")}}',
                method:'POST',
                data:{pr_card_detail_id:id},
                success:function(data){
                    console.log(data);
                    $(tt).parent().parent().remove();
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
            <h3 class="m-subheader__title m-subheader__title--separator">PRC -
                {{$ArchitectLayoutDetail->architect_layout->master_layout!=""?$ArchitectLayoutDetail->architect_layout->master_layout->layout_name:''}}</h3>
            <div class="ml-auto btn-list">
                    <a href="{{route('architect_layout_details.view',['layout_id'=>encrypt($ArchitectLayoutDetail->architect_layout_id)])}}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
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
                            View PR Card
                        </h3>
                    </div>
                    <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="col-form-label" for="">CTS Number:</label>
                        </div>
                        <div class="col-sm-5">
                            <label class="col-form-label" for="extract"> PR Card:</label>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="optionBox">
                        @if(count($ArchitectLayoutDetail->pr_card_details)>0)
                        @php $j=1; @endphp
                        @foreach($ArchitectLayoutDetail->pr_card_details as $pr_card_detail)
                        <div class="block">
                            <div class="form-group m-form__group row mb-0">
                                <div class="col-lg-5 form-group">
                                    <input type="hidden" name="pr_card_detail_id[]" value="{{$pr_card_detail->id}}">
                                    <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="" name="cts_no[]">
                                        @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                        <option
                                            {{$pr_card_detail->architect_layout_detail_cts_plan_detail_id==$cts_plan_detail->id?'selected':''}}
                                            value="{{$cts_plan_detail->id}}">{{$cts_plan_detail->cts_no}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-lg-5 form-group">
                                    <div class="custom-file">
                                       <a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$pr_card_detail->upload_pr_card}}"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $j++; @endphp
                        @endforeach
                        @else
                        <div class="block">
                            <div class="form-group m-form__group row mb-0">
                                <div class="col-lg-5 form-group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="" name="cts_no[]">
                                        @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                        <option value="{{$cts_plan_detail->id}}">{{$cts_plan_detail->cts_no}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-lg-5 form-group">
                                    <div class="custom-file">
                                        <input type="file" id="extract" name="pr_cards[]" class="custom-file-input">
                                        <label title="" class="custom-file-label" for="extract">Choose file</label>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2 form-group mt-2">
                                    <i class="fa fa-close btn--add-delete" id=""></i>
                                </div> -->
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Row ends -->

                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <div class="mt-3">
                                <a href="{{route('architect_layout_details.view',['layout_id'=>encrypt($ArchitectLayoutDetail->architect_layout_id)])}}"
                                    class="btn btn-primary btn-custom">Back</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
