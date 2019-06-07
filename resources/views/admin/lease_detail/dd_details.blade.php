<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">DD Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

            <div class="modal-body">
                <!-- <p>Some text in the modal.</p> -->
                <div class="table--box-input mb-0">
                    <span>Bill No.: {{$dd_details[0]['bill_no']}}</span><br/>
                    <span>DD No.: {{$dd_details[0]['dd_no']}}</span><br/>
                    <span>Bank Name: {{$dd_details[0]['bank_name']}}</span><br/>
                    <span>DD Amount: {{$dd_details[0]['dd_amount']}}</span><br/>
                    <span>DD Status: {{$dd_details[0]['status']}}</span>
{{--                    <span>DD Created At: {{$dd_details[0]['created_at']}}</span>--}}
                </div>
            </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
