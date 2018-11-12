<div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <h3 class="section-title section-title--small">
                Add PR Card
            </h3>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{route('post_prc_detail')}}">
            @csrf
            <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
            <div class="row">
                <div class="col-sm-5">
                    <label class="col-form-label" for="">CTS Number:</label>
                </div>
                <div class="col-sm-5">
                    <label class="col-form-label" for="extract">Upload PR Card:</label>
                </div>
            </div>

            <!-- Row -->
            <div class="optionBoxPrc">
                @if(count($ArchitectLayoutDetail->pr_card_details)>0)
                @php $j=1; @endphp
                @foreach($ArchitectLayoutDetail->pr_card_details as $pr_card_detail)
                <div class="blockPrc">
                    <div class="form-group m-form__group row mb-0">
                        <div class="col-lg-5 form-group">
                            <input type="hidden" name="pr_card_detail_id[]" value="{{$pr_card_detail->id}}">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
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
                                <input type="file" id="extract_{{$j}}" name="pr_cards[]" class="custom-file-input">
                                <label title="" class="custom-file-label" for="extract_{{$j}}">Choose file</label>
                                <a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$pr_card_detail->upload_pr_card}}">uploaded
                                    file</a>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        @if($j!=1)
                        <div class="col-lg-2 form-group mt-2">
                            <i class="fa fa-close btn--add-delete" id="" class="remove" onclick="deletePrCardDetail(this,{{$pr_card_detail->id}})"></i>
                        </div>
                        @endif
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

            <div class="row">
                <div class="col-sm-12">
                    <a class="btn--add-delete addPrc">add more </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                        <a href="{{route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                            class="btn btn-primary btn-custom">Back</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
