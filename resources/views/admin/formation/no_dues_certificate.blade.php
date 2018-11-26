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
        <form id="OfferLetterFRM" action="{{ route('formation.post_no_dues_certificate')}}" method="post">
            @csrf
            <input type="hidden" id="applicationId" name="applicationId" value="{{$sf_application->id}}">
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">
        @if($content != "")
            {{$content}}
        @else
        <div style="" id="">
            <div style="padding-left: 15px;">
                <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px;">Subject:</p>
                <div style="line-height: 2.0; padding-left: 20px;">
                <p style="font-size: 15px;">It is to certify that Building No. {{$sf_application->societyApplication->building_no}} consisting of <span style="font-weight: bold;">test</span> T/S under the <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Scheme at <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> In favour of <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
                    Co-op. Housing Society Ltd. Have paid all the dues in respect of above bldg./bldgs. Including the final sale price for the bldg. and premium of the land as
                    follow:</p>
                </div>
                <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                    5. Final Sale Price of the Bldg/bldgs.<br/>
                    (A) Cost of Construction<span style="padding-left: 30px;font-size: 15px;"></span><br/>
                    (B) Premium Land<span style="padding-left: 68px;font-size: 15px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                    <span>Total<span style="padding-left: 88px;font-size: 15px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></span>
                </p>
            </div>
            <div>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            6. Charges for Common Services are paid upto <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                            <span> The rate of Charges of Common Services payable by the said Society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Quarter.</span>
                    </p>
        
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            7. Lease Rent Paid Upto <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                            <span> The Rate of the Lease rent payable by the said society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Annum</span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            5. Whether Municipal Taxes <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> are paid upto date (In Case the Society is Paying the Municipal Taxes directly to the Municipal Corporation of
                            <span><span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> the same stated and accordingly.</span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            8. N.A .Assessment Paid Upto    <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                            <span> The Rate of N.A Assessment Payable by the said Society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Tenement/Per Month.</span>
                    </p>
        
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            5. Whether Municipal Taxes <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> are paid upto date (In Case the Society is Paying the Municipal Taxes directly to the Municipal Corporation of
                            <span><span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> the same stated and accordingly.</span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            <span> 6. Date of Allotment dt. <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            <span> 7. Date of Handling over of Pump House <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> underground tank to the society.</span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                        <span>9. Remarks if any <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><span style="font-weight: bold;"></span>
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                            It is confirmed that no litigation with the board involving the society or/ and it’s any member is pending. So also there are no court order/ Injunction restraining. The Board from conveying the above said building or any tenement and from leasing the land.
                            There is no objection whatsoever to convey the building and lease the land to the above said society.
                            Encl: Bonifide Tenements List.
                    </p>
                    <p style="line-height: 2.0; padding-right: 20px; font-size: 15px; ">
                        Estate Manager <br> <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Hsg. & Area Dev.  <br> Board, Mumbai
                    </p>
                    <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                    To,<br>
        
                    EM-II /Conveyance<br>
        
                    --------------  Board, Mumbai.400051
                    </p>
            </div>
        </div>
        @endif
        </textarea>
            <input type="submit" id="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
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
        allowedContent: true
    });
    $(document)
    // $("#OfferLetterFRM").submit(function(){
    //     $("#header_start").css("display","block !important");
    //     alert();
    // });

</script>
<script>
