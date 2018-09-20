<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="deleteHearing" role="form" method="post" class="form-horizontal" action="{{route('hearing.destroy', $id)}}">
            <div class="modal-body">
                <!-- <p>Some text in the modal.</p> -->
                {{ method_field('DELETE') }}
                @csrf
                <!-- <label class="col-md-4 control-label">Board Name</label> -->
                <div class="mb-0 @if($errors->has('delete_reason')) has-error @endif">
                    <label for="delete_reason">Reason:</label>
                    <textarea name="delete_reason" class="form-control form-control--custom" rows="5" id="delete_reason"
                        required>{{old('delete_reason')}}</textarea>
                    <span class="help-block">{{$errors->first('delete_reason')}}</span>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="{{url('/resolution')}}" role="button" class="btn default">Cancel</a> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </form>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>

</div>