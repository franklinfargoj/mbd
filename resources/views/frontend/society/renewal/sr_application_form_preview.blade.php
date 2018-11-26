<div>
    <div >
        <div >
            <h3 >Application</h3>
            <div >

            </div>
        </div>
    </div>
    <div>
        <div id="printdiv">
            <form  action="{{ route('society_renewal.store') }}" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Subheader -->
                <div>
                    <div style="text-align: center;">
                        <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3>
                    </div>
                    <div>
                        <p>
                        <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">प्रति,</p>
                        <table style="margin-left: -5px; margin-top: 5px; margin-bottom: 5px;">
                            <tbody>
                            <tr>
                                <td style="font-size: 18px;">कार्यकारी अभियंता,</td>
                                <td style="font-size: 18px;">EE</td>
                                <td style="font-size: 18px;">विभाग,</td>
                            </tr>
                            </tbody>
                        </table>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">गृहनिर्माण भवन, वांद्रे (पुर्व),</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई - ४०००५१.</p>
                        </p>
                    </div>
                </div>
                <!-- END: Subheader -->
                <div >
                    <div style="">
                        <p style="font-size: 16px; line-height: 1.5;"><span style="display: block; font-weight: bold; font-size: 16px;">विषय :- </span> <span style="font-weight: bold;"> &nbsp; {{ $sc_application->applicationLayout[0]->layout_name }} &nbsp; </span> येथील <span style="font-weight: bold;"> &nbsp; {{ $sc_application->societyApplication->name }} &nbsp; </span> इमारतीचे अभिहस्तांतरण करणेबाबत गृहनिर्माण
                            संस्थेच्या स्वयंपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
                        <p style="font-size: 16px;" >महोदय,</p>
                        <p style="font-size: 16px;">उपुक्त विषयांकित इमारतीचे अभिहस्तांतरण करणेसाठी खालील माहिती व कागदपत्रे सादर करण्यात येत
                            आहे.</p>
                        <div >
                            <div style="font-size: 16px;">
                                <div style="margin-bottom: 10px;">
                                    <div style="width: 50%; float: left;">
                                        <label  for="">१. वसाहितीचे नाव:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->societyApplication->name }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <label  for="">२. इमारत क्र:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->societyApplication->building_no }} &nbsp; </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div>
                                    <div style="width: 50%; float: left;">
                                        <label  for="">३. योजनेचे नाव:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->sr_form_request->scheme_name }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <label  for="">४. प्रथम सदनिका वितरणाचा दिनांक:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sr_form_request->first_flat_issue_date)) }} &nbsp; </span>
                                    </div>
                                </div>
                            </div>
                            <div style="font-size: 16px; margin-bottom: 10px;">
                                <p style="margin-bottom: 10px;">६. एकूण सदनिका</p>
                                <div style="margin-bottom: 10px;">
                                    <div style="width: 50%; float: left;">
                                        <label  for="">A. निवासी:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->sr_form_request->residential_flat }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <label  for="">B. अनिवासी:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->sr_form_request->non_residential_flat }} &nbsp; </span>
                                    </div>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <div style="width: 50%; float: left;">
                                        <label  for="">C. एकूण:</label>
                                        <span style="font-weight: bold;"> &nbsp;{{ $sc_application->sr_form_request->total_flat }} &nbsp; </span>
                                    </div>
                                </div>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                            <div style="font-size: 16px;">
                                <p style="margin-bottom: 10px;">७. </p>
                                <div style="margin-bottom: 10px;">
                                    <div style="width: 50%; float: left;">
                                        <label  for="">A. संस्था नोंदणी क्र:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->societyApplication->registration_no }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <label  for="">B. संस्था नोंदणी दिनांक:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sr_form_request->society_registration_date)) }} &nbsp; </span>
                                    </div>
                                </div>
                            </div>
                            {{--<div >--}}
                                {{--<div "col-sm-6 application-fields">--}}
                                    {{--<label  for="">८. अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे):</label>--}}
                                    {{--<p><a href="{{ route('sc_download') }}"  target="_blank" rel="noopener">Download Template</a> </p>--}}
                                    {{----}}
                                    {{--<input  type="text" id=""--}}
                                               {{--name="" value="">--}}
                                    {{--</div>--}}
                                {{--<div "col-sm-6 application-fields">--}}
                                    {{-- <label  for="">Upload File:</label> --}}
                                    {{--<p>--}}
                                        {{--<input "custom-file-input" name="template" type="file"--}}
                                                   {{--id="test-upload" required>--}}
                                        {{--<label "custom-file-label" for="test-upload">Choose--}}
                                            {{--file ...</label>--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            <div style="font-size: 16px;">
                                <p style="margin-bottom: 10px;">९. सेवा हस्तांकरण झाल्याचा दिनांक:</p>
                                <div style="margin-bottom: 10px;">
                                    <div style="width: 50%; float: left; margin-bottom: 10px;">
                                        <label  for="">१. मालमत्ता कर:</label>
                                        <span style="font-weight: bold;"> &nbsp;{{ $sc_application->sr_form_request->property_tax }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left; margin-bottom: 10px;">
                                        <label  for="">२. पाणी बिल:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->sr_form_request->water_bill }} &nbsp; </span>
                                    </div>
                                    <div style="width: 50%; float: left; margin-bottom: 10px;">
                                        <label  for="">३. अकृषिक कर:</label>
                                        <span style="font-weight: bold;"> &nbsp; {{ $sc_application->sr_form_request->non_agricultural_tax }} &nbsp; </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                            {{--<div >--}}
                                {{--<div >--}}
                                    {{--<label  for="">१०. कार्यकारणी यादी</label>--}}
                                    {{--<input  type="text" id=""--}}
                                               {{--name="society_address" value="{{ $sc_application->societyApplication->address }}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            <div style="margin-bottom: 10px;">
                                <div style="font-size: 16px;">
                                    <p style="margin-bottom: 10px;">११. संस्थेचा अधिकृत पत्ता</p>
                                    <span style="font-weight: bold;"> &nbsp; {{ $sc_application->societyApplication->address }} &nbsp; </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <div style="font-size: 16px;">
                            <p style="font-size: 16px;" >आपला विश्वासू,</p>
                            <p style="font-size: 16px;" >
                                <span >अध्यक्ष <span style="font-weight: bold;"> &nbsp; test &nbsp;</span></span>
                            </p>
                            <p style="font-size: 16px;" >
                                <span >सचिव <span style="font-weight: bold;"> &nbsp; test &nbsp;</span></span>
                            </p>
                        </div>
                    </div>
                    <div >
                        <div >
                            <div >
                                <div >
                                    <div >
                                        {{--<button type="submit" >Submit & Next</button>--}}
                                        {{--<a href="" "btn btn-secondary">Cancel</a>--}}
                                        {{--<a href="" "btn btn-secondary">Cancel</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>