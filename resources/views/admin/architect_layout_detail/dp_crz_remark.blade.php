<div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <h3 class="section-title section-title--small">
                DP Remark
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table text-center">
                <tr class="thead-default">
                    <th>Letter</th>
                    <th>DP Plan</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
                @forelse ($ArchitectLayoutDetail->ArchitectLayoutDetailDpRemark as $item)
                <tr>
                    <td>
                        <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->dp_letter}}">download</a>
                    </td>
                    <td>
                        <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->dp_plan}}">download</a>
                    </td>
                    <td>
                        {{$item->dp_comment}}
                    </td>
                    <td>
                        <h2 class='m--font-danger mb-0'>
                            <i title='Delete' class='fa fa-remove' onclick="deleteDpRemark(this,{{$item->id}})"></i>
                        </h2>
                    </td>
                </tr>
                @empty
                <tr class="thead-default">
                    <td colspan="4"><span class="text-danger">No record found</span></td>
                </tr>
                @endforelse
            </table>
        </div>
        <form id="dp_remark_form" action="{{route('post_architect_detail_dp_crz_remark_add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
            <input type="hidden" name="remark_type" value="dp">
            <div class="table-responeive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <label class="font-weight-semi-bold">Letter</label>
                                <div class="custom-file">
                                    <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input"
                                        required name="dp_remark_letter" type="file" id="dp_remark_letter_file">
                                    <label class="custom-file-label" for="dp_remark_letter_file">Choose file...</label>
                                    @if ($errors->has('dp_remark_letter'))
                                    <span class="error">{{ $errors->first('dp_remark_letter') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <label class="font-weight-semi-bold">DP Plan</label>
                                <div class="custom-file">
                                    <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input"
                                        required name="dp_remark_plan" type="file" id="dp_remark_plan_file">
                                    <label class="custom-file-label" for="dp_remark_plan_file">Choose file...</label>
                                    @if ($errors->has('dp_remark_plan'))
                                    <span class="error">{{ $errors->first('dp_remark_plan') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <label class="font-weight-semi-bold">Comments</label>
                                <div class="custom-file">
                                    <textarea type="text" name="dp_comment" id="dp_comment" class="form-control form-control--custom form-control--fixed-height">{{old('dp_comment')}}</textarea>
                                    @if ($errors->has('dp_comment'))
                                    <span class="error">{{ $errors->first('dp_comment') }}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <h3 class="section-title section-title--small">
                CRZ Remark
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table text-center">
                <tr class="thead-default">
                    <th>Letter</th>
                    <th>CRZ Plan</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
                @forelse ($ArchitectLayoutDetail->ArchitectLayoutDetailCrzRemark as $item)
                <tr>
                    <td>
                        <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->crz_letter}}">download</a>
                    </td>
                    <td>
                        <a class="text-primary" target="_blank" href="{{config('commanConfig.storage_server').'/'.$item->crz_plan}}">download</a>
                    </td>
                    <td>
                        {{$item->crz_comment}}
                    </td>
                    <td>
                        <h2 class='m--font-danger mb-0'>
                            <i title='Delete' class='fa fa-remove' onclick="deleteCrzRemark(this,{{$item->id}})"></i>
                        </h2>
                    </td>
                </tr>
                @empty
                <tr class="thead-default">
                    <td colspan="4"><span class="text-danger">No record found</span></td>
                </tr>
                @endforelse
            </table>
        </div>
        <form id="crz_remark_form" action="{{route('post_architect_detail_dp_crz_remark_add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
            <input type="hidden" name="remark_type" value="crz">
            <div class="table-responeive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <label class="font-weight-semi-bold">Letter</label>
                                <div class="custom-file">
                                    <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input"
                                        required name="crz_remark_letter" type="file" id="crz_remark_letter_file">
                                    <label class="custom-file-label" for="crz_remark_letter_file">Choose file...</label>
                                    @if ($errors->has('crz_remark_letter'))
                                    <span class="error">{{ $errors->first('crz_remark_letter') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <label class="font-weight-semi-bold">CRZ Plan</label>
                                <div class="custom-file">
                                    <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input"
                                        required name="crz_remark_plan" type="file" id="crz_remark_plan_file">
                                    <label class="custom-file-label" for="crz_remark_plan_file">Choose file...</label>
                                    @if ($errors->has('crz_remark_plan'))
                                    <span class="error">{{ $errors->first('crz_remark_plan') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <label class="font-weight-semi-bold">Comments</label>
                                <div class="custom-file">
                                    <textarea type="text" name="crz_comment" id="crz_comment" class="form-control form-control--custom form-control--fixed-height">{{old('crz_comment')}}</textarea>
                                    @if ($errors->has('crz_comment'))
                                    <span class="error">{{ $errors->first('crz_comment') }}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>
