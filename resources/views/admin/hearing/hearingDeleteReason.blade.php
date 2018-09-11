<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete Reason</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <!-- <p>Some text in the modal.</p> -->
            <form id="deleteHearing" role="form" method="post" class="form-horizontal" action="{{route('hearing.destroy', $id)}}">
                {{ method_field('DELETE') }}
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <!-- <label class="col-md-4 control-label">Board Name</label> -->
                        <div class="col-md-12 @if($errors->has('delete_reason')) has-error @endif">
                            <div class="input-icon right">
                                <textarea name="delete_reason" class="form-control" rows="5" id="delete_reason" required>{{old('delete_reason')}}</textarea>
                                <span class="help-block">{{$errors->first('delete_reason')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-8">
                        <!-- <a href="{{url('/resolution')}}" role="button" class="btn default">Cancel</a> -->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn blue">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>

</div>