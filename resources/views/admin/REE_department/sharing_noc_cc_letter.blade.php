<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="ie=edge" http-equiv="X-UA-Compatible">
      <title>NOC FOR CC</title>
   </head>
   <body>
      <div class="m_portlet">
         <form action="{{route('ree.save_draft_noc_cc')}}" id="OfferLetterFRM" method="post" name="OfferLetterFRM">
            @csrf <input id="applicationId" name="applicationId" type="hidden" value="{{$applicatonId}}"> 
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">               @if($content != "") {{$content}} @else
            <div id="" style="">
                <!-- Header starts here -->
                <div>
                    <div style="margin-top: 30px; text-align: right;">
                        <div style="float: left; width: 56%;"></div>
                        <div style="float: left; width: 44%;">
                            <div style="text-align: left;">
                                <span>NO.CO/MB/REE/NOC/F-368/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2016</span>
                            </div>
                            <div style="text-align: left;">
                                <span>Date:</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <h3 style="text-decoration: underline; text-align: center;">CONSENT LETTER FOR COMMENCEMENT CERTIFICATE.</h3>
                    <p></p>
                    <div style="margin-top: -15px;">
                        <p style="margin-bottom:0; line-height:0.25;">To,</p>
                        <p style="margin-bottom:0; line-height:0.25;">The Executive Engineer,</p>
                        <p style="margin-bottom:0; line-height:0.25;">Building Permission Cell,</p>
                        <p style="margin-bottom:0; line-height:0.25;">Planning Authority,</p>
                        <p style="margin-bottom:0; line-height:0.25;">MHADA Bandra (E),</p>
                        <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400051.</p>
                    </div>
                </div><!-- Header ends here -->
                <!-- Subject starts here -->
                <div style="padding-left: 50px; margin-top: 30px; line-height: 1.5;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000; text-align: center; padding: 5px;" valign="top">Sub:</td>
                                <td style="border: 1px solid #000; padding: 5px;" valign="top">Proposal for Consent Letter for Commencement Certificate for redevelopment of existing building No. <span style="font-weight: bold;">{{($model->eeApplicationSociety->building_no ? $model->eeApplicationSociety->building_no : '')}}</span> , known as <span style="font-weight: bold;">{{($model->eeApplicationSociety->name ? $model->eeApplicationSociety->name : '')}} ( {{($model->eeApplicationSociety->address ? $model->eeApplicationSociety->address : '')}} )</span> </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; text-align: center; padding: 5px;" valign="top">Ref:</td>
                                <td style="border: 1px solid #000; padding: 5px;" valign="top"><span style="display: block; margin-bottom: 4px;">1. This office NOC. <span style="font-weight: bold;">{{($model->request_form->noc_no ?$model->request_form->noc_no:'')}}</span>, Dated <span style="font-weight: bold;">{{($model->request_form->noc_date ? date('d-m-Y',strtotime($model->request_form->noc_date)) : '')}}</span></span> <span style="display: block;">2. MCGM IOD Number. <span style="font-weight: bold;">{{($model->request_form->mcgm_iod_number ?$model->request_form->mcgm_iod_number:'')}}</span>, Dated <span style="font-weight: bold;">{{($model->request_form->mcgm_iod_date ? date('d-m-Y',strtotime($model->request_form->mcgm_iod_date)) : '')}}</span><span style="display: block;">3. Tripartite agreement date. <span style="font-weight: bold;">{{($model->request_form->tripartite_agreement_date ? date('d-m-Y',strtotime($model->request_form->tripartite_agreement_date)) : '')}}.</span></span> <span style="display: block;">4. Society's letter dt. <span style="font-weight: bold;">{{($model->request_form->created_at ? date('d-m-Y',strtotime($model->request_form->created_at)) : '')}}.</span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!--  -->
                <!-- Subject ends here -->
                <p lang="en-GB" align="justify">
                    <strong>Sir, </strong>
                </p>
                <p lang="en-GB" align="justify">
                    The Applicant has complied all formalities for obtaining Consent letter for
                    grant of Commencement Certificate. There is no objection to issue
                    Commencement Certificate for the proposed work on plot bearing CTS No. 1070
                    (Pt.) at village-Mulund, Mumbai -400 081 from M.H.&amp; A.D. Board's side
                    regarding the proposal submitted by them on plot armaturing 1369.42 m2
                    (i.e. 1001.11 m2 as per lease deed + 368.31 m2 additional land in form of
                    Tit Bit) as per demarcation plan.
                </p>
                <p lang="en-GB" align="justify">
                    Now, by this letter Commencement Certificate may be permitted as per the
                    plan approved by your office under No. CE/5282/BPES/AT, dated 18.02.2016.
                </p>
                <p lang="en-GB" align="justify">
                    One Set of plan approved by M.C.G.M. duly certified by the Architect should
                be submitted to this office, where in MHADA share of    <strong>460.38 m2</strong> (Including fungible) &amp; proportionate car
                    parking &amp; amenities shall be provided for MHADA share tenements.
                </p>
                <p lang="en-GB">
                    Occupation Certificate should not be granted unless consent letter duly
                    signed by Chief Officer /Mumbai Board is submitted to your department.
                </p>
                <p lang="en-GB">
                    <strong>(Draft approved by CO/MB) </strong>
                </p>
                <center>
                    <table width="100%" cellpadding="7" cellspacing="0">
                        <colgroup>
                            <col width="100%"/>
                        </colgroup>
                        <tbody>
                            <tr valign="top">
                                <td align="right" width="100%">
                                    <p lang="en-US" align="right">
                                        <strong>Sd/-</strong>
                                    </p>
                                    <p lang="en-US" align="right">
                                        <strong>For Chief Officer,</strong>
                                    </p>
                                    <p lang="en-US" align="right">
                                        <strong>M. H. &amp; A. D. Board</strong>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
                <p lang="en-GB" align="justify">
                    <strong>Copy to Applicant :</strong>
                    <span>The Secretary,{{$model->eeApplicationSociety->name}}</span><span>,{{$model->eeApplicationSociety->address}}</span>

                </p>
                <p lang="en-GB" align="justify">
                    <strong>Copy to Developers :</strong>
                    <span>{{$model->request_form->developer_name}}</span>

                </p>
                <p lang="en-GB">
                    <strong>Copy to Architect: </strong>
                    <span>{{$model->eeApplicationSociety->name_of_architect}}</span><span>,{{$model->eeApplicationSociety->architect_address}}</span>
                </p>
                <p lang="en-US" align="justify">
                    <strong>
                        Copy forwarded for information and necessary action in the matter to: -
                    </strong>
                </p>
                <ol>
                    <li>
                        <p lang="en-US" align="justify">
                            Executive Engineer, Mulund Division
                        </p>
                    </li>
                </ol>
                <ol type="i">
                    <li>
                        <p lang="en-US" align="justify">
                            He is directed to take necessary action as per demarcation &amp; as
                            per prevailing policy of MHADA.
                        </p>
                    </li>
                    <li>
                        <p lang="en-US" align="justify">
                            He is directed to recover all the dues from the society concerned
                            to Estate Department &amp; intimate the same to this office.
                        </p>
                    </li>
                    <li>
                        <p lang="en-US" align="justify">
                            He is directed to recover any dues, land revenue, audit remarks
                            concerned to Land Department if any pending with the society &amp;
                            intimate the same to this office.
                        </p>
                    </li>
                </ol>
                <ol start="2">
                    <li>
                        <p lang="en-US" align="justify">
                            Chief Accounts Office/M.B.
                        </p>
                    </li>
                </ol>
                <p lang="en-US" align="justify">
                    He is directed to recover the amount of offer letter on time &amp; furnish
                    certified copy to this office. As well as check above calculation of offer
                    letter thoroughly. If any changes/irregularities found in the said offer
                    letter intimate to this office accordingly.
                </p>
                <ol start="3">
                    <li>
                        <p lang="en-GB" align="justify">
                            Copy to Mr. Jadhav / Sr. Clerk for MIS record.
                        </p>
                    </li>
                </ol>
                <p lang="en-US" align="right">
                    <strong> Sd/-</strong>
                </p>
                <p lang="en-US" align="right">
                    <strong>For Chief Officer,</strong>
                </p>
                <p lang="en-GB" align="right">
                    <strong>M. H. &amp; A. D. Board</strong>
                </p>
                @endif
                </textarea>
                <input id="submit" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;" type="submit" value="save">
            </div>
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