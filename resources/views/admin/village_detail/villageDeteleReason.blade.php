<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="DeleteVillageReason" role="form" method="post" class="form-horizontal" action="{{route('village_detail.destroy', $id)}}">
            {{ method_field('DELETE') }}
            @csrf
            <div class="modal-body">
                <!-- <p>Some text in the modal.</p> -->
                <div class="mb-0">
                    <label for="delete_message">Reason:</label>
                    <textarea name="delete_message" class="form-control form-control--custom" rows="5" id="delete_message"
                        required></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="{{url('/resolution')}}" role="button" class="btn default">Cancel</a> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
