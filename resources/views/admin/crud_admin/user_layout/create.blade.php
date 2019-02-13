@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.user_layout.actions')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Add User Layout</h3>
                {{ Breadcrumbs::render('add_user_layout') }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="adduserlayout" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('user_layouts.store')}}" enctype="multipart/form-data">
                @csrf 

                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="user_id">Users:<span class="star">*</span></label>
                            <select data-live-search="true" title="Please Select User" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="user_id" value="" name="user_id" onchange="getLayout(this)">
                            @if($users)
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}">{{ $user['name']}} ({{isset($user['role_details']) ? $user['role_details']['display_name'] : ''}} )</option>
                                @endforeach
                            @endif    
                            </select>
                            <span class="error">{{$errors->first('user_id')}}</span>

                        </div>

                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="layout_id">Layout:<span class="star">*</span></label>
                            <select data-live-search="true" title="Please Select Layout" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id">
                             <option selected disabled>Select</option>
                            </select>
                            <span class="error">{{$errors->first('layout_id')}}</span>

                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="add_user_layout" class="btn btn-primary">Save</button>
                                    <a href="{{route('user_layouts.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    function getLayout(data){ 
        
        var userId = data.value;
        var form_data = new FormData();
        form_data.append('userId', userId);
        form_data.append('_token', document.getElementsByName("_token")[0].value);

        $.ajax({
            url: "/crudadmin/get_layout",
            data: form_data,
            type: 'post',
            contentType: false,
            cache: false,  
            processData: false,
            success: function(response) {
                var result = JSON.parse(response);
                
                if (result.status == 'success'){
                    $("#layout_id option").remove();
                    $.each(result.data, function(key,value){
                        console.log(value.layout_name);
                        $("#layout_id").append('<option value="'+value.id+'">'+value.layout_name+'</option>').selectpicker('refresh');
                    });
                }else{
                    alert("Something went wrong, Please contact Admin!");
                }
                // $(".loader").hide();
                // if (data == 'success'){
                //     $(".upload_doc_"+id).css("display","none");
                // }
            }
        })         
    }
</script>
@endsection

