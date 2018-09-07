@extends('admin.layouts.app')
@section('content')          
  <div class="m-content"></div>
  <div class="m-portlet m-portlet--mobile">
     <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
           <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
                 Edit Email Template
              </h3>
           </div>
        </div>
     </div>
     <form id="edit_email_template" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('email_templates.update', $email_template->id)}}" enctype="multipart/form-data">
      @csrf
        <div class="m-portlet__body">
          <div class="form-group m-form__group">
            <div class="form-group">
                <label class="col-form-label">Email type</label>
                <div class="col-md-8 @if($errors->has('type')) has-error @endif">
                    <div class="input-icon right">
                        <input type="text" name="type" id="type" class="form-control m-input" value="{{ $email_template->type }}">
                        <span class="help-block">{{$errors->first('type')}}</span>
                    </div>
                </div>
            </div>          

            <div class="form-group">
                <label class="col-form-label">Body</label>
                <div class="col-md-8 @if($errors->has('body')) has-error @endif">
                    <div class="input-icon right">
                        <textarea type="text" name="body" id="summary-ckeditor" class="form-control m-input">{{ $email_template->body }}</textarea>
                        <span class="help-block">{{$errors->first('body')}}</span>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
           <div class="m-form__actions m-form__actions--solid">
              <div class="row">
                 <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('email_templates.index')}}" class="btn btn-secondary">Cancel</a>
                 </div>
              </div>
           </div>
        </div>
    </form>
  </div>
  <!-- END EXAMPLE TABLE PORTLET--> 
@endsection
@section('add_email_templates_js')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
    <script>
      // loadDepartmentsOfBoard();

      // $('#board_id').change(function(){
      //   loadDepartmentsOfBoard();
      // });

      // function loadDepartmentsOfBoard()
      // {
      //   var board_id = $('#board_id').val();
      //   if(board_id != "")
      //   {
      //     $.ajax({
      //       headers: {
      //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //       },
      //       type:"POST",
      //       data:{
      //         board_id:board_id
      //       },
      //       url:"{{ route('loadDepartmentsOfBoardUsingAjax') }}",
      //       success:function(res){
      //         $('#department_id').html(res);
      //       }
      //     });
      //   }
      // }
    </script>
  @endsection  
