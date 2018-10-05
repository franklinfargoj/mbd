@extends('admin.layouts.app')
@section('content')
<div class="card">
  <div class="card-body">
<form action="{{route('post_forward_application')}}" id="forwardApplication" method="post">
@csrf
<input type="hidden" name="application_id" value="{{ $arrData['architect_details']->id }}">
<input type="hidden" name="to_role_id" id="to_role_id">

<div class="m-form__group form-group">
    <div class="form-group m-form__group row mt-3 parent-data">
        <label class="col-form-label col-lg-2 col-sm-12">
            Forward To:
        </label>

        <div class="col-lg-4 col-md-9 col-sm-12">
            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="to_user_id" id="to_user_id">
                @if($arrData['parentData'])
                    @foreach($arrData['parentData'] as $parent)
                        <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $arrData['role_name'] }})</option>
                    @endforeach
                @else
                    @foreach($arrData['get_forward_commitee'] as $parent)
                        <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $arrData['commitee_role_name'] }})</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="mt-3">
        <label for="remark">Remark:</label>
        <textarea class="form-control form-control--custom" name="remark" id="remark" cols="30" rows="5"></textarea>
    </div>
    <div class="mt-3 btn-list">
        <button type="submit" class="btn btn-primary">Save</button>
        {{--<button type="submit" class="btn btn-primary">Sign & Forward</button>
        <button type="submit" class="btn btn-primary">Forward</button>--}}
        <button type="button" onclick="window.location.href='{{ url("/architect_application") }}'" class="btn btn-secondary">Cancel</button>
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