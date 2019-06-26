
<div class="m_portlet">
    <form id="OfferLetterFRM" action="{{ route('dyco.save_draft_NOC') }}" method="post">
        @csrf
        <input type="hidden" id="applicationId" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
        <div style="margin-left: 130px">
        <textarea id="ckeditorText" name="ckeditorText" style="display:none;">
        <div style="" id="">


                <!-- Header starts here -->
                <div>
                        <p > </p>
                    <div style="">
                        <div style="margin-top: 90px; text-align: right;">
                            <div style="float: left; width: 56%;"></div>
                            <div style="float: left; width: 44%;">
                                <div style="text-align: left;">
                                    <span>No.MB/DYCO(West)/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018</span>
                                </div>
                                <div style="text-align: left;">
                                    <span>Date:</span>
                                </div> 
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <h3 style="text-decoration: underline; text-align: center;">Final Letter of Conveyance </h3>
                        <p style="margin-bottom:0; line-height:0.25;">To,</p>
                        <span style="margin-bottom:0; line-height:0.25;">The Secretary,</span>
                        <p style="margin-bottom:0; line-height:1;">{{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</p>
                        <p style="margin-bottom:0; line-height:0.25;">Building No.
                        <span style="font-weight: bold;"></span>{{ isset($data->societyApplication->building_no) ? $data->societyApplication->building_no : '' }}</p>
                        <p style="margin-bottom:0; line-height:0.25;">_______________________________________</p>
                        <!-- <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400 083.</p> -->
                    </div>
                </div>

                <!-- Header ends here -->

                <!-- Subject starts here -->
                <div style="padding-left: 200px; margin-top: 30px; line-height: 1.5;">
                    <span style="font-weight: bold;">Sub:</span>
                    <span>Execution of Lease Deed & Sale Deed in respect of {{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</span>
                </div>
                <!-- Subject ends here -->

                <!-- Letter Body starts here --> 
                <div style="line-height: 1.5;">
                    <p style="margin-bottom: 5px;">Sir,</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">The necessary documents viz the <span style="font-weight: bold;"> Lease Deed & Sale Deed </span> in respect of above Office Buildings has been executed between M.H.& A.D Authority and the Assignees on <span style="font-weight: bold;"> {{ isset($data->sale_registration->registration_year) ? $data->sale_registration->registration_year : '' }}</span> The said Documents have also been lodged for registration by you with the Joint- Sub- Registrar <span style="font-weight: bold;"> {{ isset($data->sale_registration->sub_registrar_name) ? $data->sale_registration->sub_registrar_name : '' }}</span> Mumbai Suburban District under Registration Number <span style="font-weight: bold;">{{ isset($data->sale_registration->registration_no) ? $data->sale_registration->registration_no : '' }} .</span> </p>
                    <p> As per the terms and conditions of the documents executed, the Assignees is required to pay the Service Charges, Lease Rent for the further period in advance to the Estate Manager M.H & A.D Board, Mumbai regularly as and when it becomes due and whether formally demanded or not. The Property taxes, and the N.A Assessment will have to be paid by the Assignees directly to the concerned Local Authority.</p>

                    <p style="margin-left:450px;margin-top: 25px;font-weight: bold;">Yours Faithfully,</p>
                </div>

                <!-- Letter Body ends here -->

                <!-- Table 1 starts here -->
   
                        </tbody>

        

</textarea> 
        <input type="submit" id="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
</div>

    </form>
    </div>

<script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        width:900,
        allowedContent: true
    });
$(document)
// $("#OfferLetterFRM").submit(function(){
//     $("#header_start").css("display","block !important");
//     alert();
// });
</script>
<script>


