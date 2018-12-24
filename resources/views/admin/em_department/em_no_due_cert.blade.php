<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="ie=edge" http-equiv="X-UA-Compatible">
      <title>No Dues Certificate</title>
   </head>
   <body>
      <div class="m_portlet">
         <form action="{{route('em.save_no_dues_cert_oc')}}" id="NoDueCert" method="post" name="NoDueCert">
            @csrf <input id="applicationId" name="applicationId" type="hidden" value="{{$applicatonId}}"> 
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">               @if($content != "") {{$content}} @else
            <div id="" style="">
                <div id="u32" class="ax_paragraph">
            <div id="u33" class="text">
            <p>Subject:</p>
            </div>
            </div>
            <div id="u34" class="ax_paragraph">
                <div id="u35" class="text">
                    <p>It is to certify that Building No. ____________ consisting of _____________ T/S under the _____________ Scheme at __________ In favour of ___________&nbsp;&nbsp;</p>
                    <p>Co-op. Housing Society Ltd. Have paid all the dues in respect of above bldg./bldgs. Including the final sale price for the bldg. and premium of the land as</p>
                    <p>follow:</p>
                    <p>5. Final Sale Price of the Bldg/bldgs.</p>
                    <p>(A) Cost of Construction&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ________________</p>
                    <p>(B) Premium Land&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;_______________&nbsp;</p>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; Total&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;_______________</p>
                    <p>&nbsp;</p>
                    <p>6. Charges for Common Services are paid upto&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ___________</p>
                    <p>The rate of Charges of Common Services payable by the said Society is Rs.&nbsp; &nbsp; &nbsp;&nbsp; _________&nbsp; Per Quarter.</p>
                    <p>7. Lease Rent Paid Upto&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ___________</p>
                    <p>The Rate of the Lease rent payable by the said society is Rs&nbsp; &nbsp; &nbsp; ._______ Per Annum</p>
                    <p>8. N.A .Assessment Paid Upto&nbsp; &nbsp;&nbsp; __________</p>
                    <p>The Rate of N.A Assessment Payable by the said Society is Rs.____________ Per Tenement/Per Month.</p>
                    <p>5. Whether Municipal Taxes ____________ are paid upto date (In Case the Society is Paying the Municipal Taxes directly to the Municipal Corporation of</p>
                    <p>__________ the same stated and accordingly.</p>
                    <p>&nbsp;</p>
                    <p>6. Date of Allotment dt.&nbsp; &nbsp; &nbsp; _______________</p>
                    <p>7. Date of Handling over of Pump House ___________and underground tank to the society.</p>
                    <p>9. Remarks if any __________________________________________________________________________________________________________________________________________________________________________</p>
                    <p>It is confirmed that no litigation with the board involving the society or/ and it&rsquo;s any member is pending. So also there are no court order/ Injunction restraining. The Board from conveying the above said building or any tenement and from leasing the land.</p>
                    <p>There is no objection whatsoever to convey the building and lease the land to the above said society.</p>
                    <p>Encl: Bonifide Tenements List.</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;Estate Manager name</p>
                    <p>&nbsp;&nbsp; ___________ Hsg. &amp; Area Dev.&nbsp; Board, Mumbai</p>
                    <p>&nbsp;</p>
                    <p>To,</p>
                    <p>EM-II /Conveyance</p>
                    <p>--------------&nbsp; Board, Mumbai.400051</p>
                </div>
            </div>
        </div>
        @endif
        </textarea>
            <input id="submit" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;" type="submit" value="save">
         </form>
      </div>
   </body>
</html>
<script src="{{asset('/js/jquery-3.3.1.min.js')}}"></script> 
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script> 
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