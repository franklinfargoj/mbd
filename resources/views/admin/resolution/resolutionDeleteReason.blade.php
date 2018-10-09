<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="deleteMessage" role="form" method="post" class="form-horizontal" action="{{route('resolution.destroy', $id)}}">
            <div class="modal-body">
                <!-- <p>Some text in the modal.</p> -->
                {{ method_field('DELETE') }}
                @csrf
                <div class="table--box-input  mb-0">
                    <!-- <label class="col-md-4 control-label">Board Name</label> -->
                    <div class="@if($errors->has('board_name')) has-error @endif">
                        <label for="comment">Reason:</label>
                        <textarea name="delete_message" class="form-control form-control--custom" rows="5" id="comment">{{old('board_name')}}</textarea>
                        <span class="help-block">{{$errors->first('board_name')}}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </form>
        <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

</div>
