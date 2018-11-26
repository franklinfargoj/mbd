<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<div class="m_portlet">
    <form id="OfferLetterFRM" action="{{ route('dyco.save_stamp_duty_letter') }}" method="post">
        @csrf
        <input type="hidden" id="applicationId" name="applicationId" value="{{$applicationId}}">
        <div style="margin-left: 130px">
        <textarea id="ckeditorText" name="ckeditorText" style="display:none;">
        <div style="" id="">


                <!-- Header starts here -->
                <div>
                    <div style="margin-top: 30px; text-align: right;">
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
                    <h3 style="text-decoration: underline; text-align: center;">Stamp Duty Letter</h3>
                        <p > </p>
                    <div style="margin-top: -15px;">
                        <p style="margin-bottom:0; line-height:0.25;">To,</p>
                        <span style="margin-bottom:0; line-height:0.25;">The Secretary,</span>
                        <p style="margin-bottom:0; line-height:0.25;">{{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</p>
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
                    <span>Execution of Sale Deed and Lease Deed in respect of {{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</span>
                </div>
                <!-- Subject ends here -->

                <!-- Letter Body starts here --> 
                <div style="line-height: 1.5;">
                    <p style="margin-bottom: 5px;">Sir,</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">You have requested to collect the engross copy of Supplymentary Lease Deed from this department for submitting the same before the superintendent of Stamps,Mumbai, for paying the necessary Stamp duty.After paying the required stamp duty, the said adjuducated/stamping documents may please be returned to this department for execution. </p>

                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;"> 
                    Kindly do this at the earliest.</p>

                    <p style="padding-right: 200px;margin-top: 25px;float:right">Yours Faithfully,</p>
                </div>

                <!-- Letter Body ends here -->

                <!-- Table 1 starts here -->
   
                        </tbody>

        

</textarea> 
        <input type="submit" id="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
</div>

    </form>
    </div>
</body>

</html>

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


