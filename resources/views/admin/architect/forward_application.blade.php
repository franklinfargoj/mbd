@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form action="{{route('architect.post_forward_application')}}" id="forwardApplication" method="post">
            @csrf
            <input type="hidden" name="application_id" value="{{ $arrData['architect_details']->id }}">
            <input type="hidden" name="to_role_id" id="to_role_id">

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="m-form__group form-group">
                    <div class="form-group m-form__group row mt-3 parent-data">
                        <label class="col-form-label col-sm-2">Forward To:</label>
                        <div class="col-sm-4 form-group">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                name="to_user_id" id="to_user_id">
                                @if($arrData['parentData'])
                                @foreach($arrData['parentData'] as $parent)
                                <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }}
                                    ({{
                                    $arrData['role_name'] }})</option>
                                @endforeach
                                @else
                                @foreach($arrData['get_forward_commitee'] as $parent)
                                <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }}
                                    ({{
                                    $arrData['commitee_role_name'] }})</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 table--box-input">
                        <label for="remark">Remark:</label>
                        <textarea class="form-control form-control--custom" name="remark" id="remark" cols="30" rows="5"></textarea>
                    </div>
                    <div class="mt-4 btn-list">
                        <button type="submit" class="btn btn-primary">Save</button>
                        {{--<button type="submit" class="btn btn-primary">Sign & Forward</button>
                        <button type="submit" class="btn btn-primary">Forward</button>--}}
                        <button type="button" onclick="window.location.href='{{ url("/architect_application") }}'"
                            class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    $("#forwardApplication").on("submit", function () {
        var data = $(".check_status").val();
        var id = $("#to_user_id").find('option:selected').attr("data-role");
        $("#to_role_id").val(id);
    });

</script>
@endsection
