{{-- <div class="col-md-12">
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body"> --}}
           
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            CTS plan
                        </h3>
                    </div>
                    <form id="add_cts_plan" enctype="multipart/form-data" method="post" action="{{route('post_cts_detail')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="Upload_Cts_Plan">Upload CTS Plan</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
                                <div class="custom-file">
                                    <input {{ $ArchitectLayoutDetail->cts_plan!=""?"":"required" }} accept="pdf" title="please upload file with pdf extension" class="custom-file-input" name="cts_plan_file" type="file" id="cts_plan_file">
                                    <label class="custom-file-label" for="cts_plan_file">Choose file...</label>
                                    <a class="btn-link" target="_blank" id="cts_plan" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->cts_plan}}"
                                        style="display:{{$ArchitectLayoutDetail->cts_plan!=''?'block':'none'}};">download</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="Upload_Cts_Plan">List of CTS No</label>
                            </div>
                            <div class="col-sm-4 form-group">
                                <!-- <label class="col-form-label">List of CTS No</label> -->
                                <div class="optionBoxCTS">
                                        @php $j=0; @endphp
                                    @if(count($ArchitectLayoutDetail->cts_plan_details)>0)
                                    
                                    @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                    <input type="hidden" name="cts_plan_detail_id[{{$j}}]" value="{{$cts_plan_detail->id}}">
                                    <div class="blockCTS position-relative form-group">
                                        <input required placeholder="CTS no" type="text" name="cts_no[{{$j}}]" class="form-control form-control--custom"
                                            value="{{ $cts_plan_detail->cts_no }}" >
                                        @if($j>0)
                                        <i onclick="deleteCtsDetail(this,{{$cts_plan_detail->id}})" class="fa fa-close btn--add-delete remove"></i>
                                        @endif
                                    </div>
                                    @php $j++; @endphp
                                    @endforeach
                                    @else
                                    <div class="blockCTS">
                                        <input type="hidden">
                                        <input placeholder="CTS no" type="text" name="cts_no[{{$j}}]" class="form-control form-control--custom"
                                            required>
                                        <a href="#" class=" remove"></a>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <a class="btn--add-delete addCTS" href="javascript:void(0)">add more<a>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                                    <a href="{{route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                        class="btn btn-primary btn-custom">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- </div>
    </div>
</div> --}}
