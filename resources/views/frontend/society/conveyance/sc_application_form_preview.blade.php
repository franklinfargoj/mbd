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
            <form  action="{{ route('society_conveyance.store') }}" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Subheader -->
                <div >
                    <div >
                        <h3 >अर्जाचा नमुना</h3>
                    </div>
                    <div >
                        <h6 >सह गृह संस्थेच्या लेटरहेडवर</h6>
                    </div>
                    <div >
                        <p>
                            <span >प्रति,</span>
                            <span >उपमुख्य अधिकारी/ पूर्व / पश्चिम,</span>
                            <span >मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
                            <span >गृहनिर्माण भवन, बांद्रा (पूर्व), मुंबई - ५१.</span>
                        </p>
                    </div>
                </div>
                <!-- END: Subheader -->
                <div >
                    <div >
                        <p><span >विषय :- </span> <input  type="text" id="" name="layout_name" value="{{ $sc_application->applicationLayout[0]->layout_name }}"> येथील <input  type="text" id="" name="society_name" value="{{ $sc_application->societyApplication->name }}"> इमारतीचे अभिहस्तांतरण करणेबाबत गृहनिर्माण
                            संस्थेच्या स्वयंपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
                        <p >महोदय,</p>
                        <p>उपुक्त विषयांकित इमारतीचे अभिहस्तांतरण करणेसाठी खालील माहिती व कागदपत्रे सादर करण्यात येत
                            आहे.</p>
                        <div >
                            <div >
                                <div >
                                    <label  for="">१. वसाहितीचे नाव:</label>
                                    <input type="text" id="" name="society_name"  value="{{ $sc_application->societyApplication->name }}">
                                </div>
                                <div >
                                    <label  for="">२. इमारत क्र:</label>
                                    <input  type="text" id="" name="society_no"
                                           value="{{ $sc_application->societyApplication->building_no }}" readonly>
                                </div>
                                <div >
                                    <label  for="">३. योजनेचे नाव:</label>
                                    <input  type="text" id="" name="scheme_name"
                                           value="{{ $sc_application->sc_form_request->scheme_name }}" readonly>
                                </div>
                                <div >
                                    <label  for="">४. प्रथम सदनिका वितरणाचा दिनांक:</label>
                                    <input  type="text" id="" name="first_flat_issue_date"
                                           value="{{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sc_form_request->first_flat_issue_date)) }}" readonly>
                                </div>
                            </div>
                            <div >
                                <label >६. एकूण सदनिका</label>
                                <div >
                                    <label  for="">A. निवासी:</label>
                                    <input  type="text" id="" name="residential_flat"
                                           value="{{ $sc_application->sc_form_request->residential_flat }}" readonly>
                                </div>
                                <div >
                                    <label  for="">B. अनिवासी:</label>
                                    <input  type="text" id="" name="non_residential_flat"
                                           value="{{ $sc_application->sc_form_request->non_residential_flat }}" readonly>
                                </div>
                                <div >
                                    <label  for="">C. एकूण:</label>
                                    <input  type="text" id="" name="total_flat"
                                           value="{{ $sc_application->sc_form_request->total_flat }}" readonly>
                                </div>
                            </div>
                            <div >
                                <label >७. </label>
                                <div >
                                    <label  for="">A. संस्था नोंदणी क्र:</label>
                                    <input  type="text" id=""
                                           name="society_registration_no" value="{{ $sc_application->societyApplication->registration_no }}" readonly>
                                </div>
                                <div >
                                    <label  for="">B. संस्था नोंदणी दिनांक:</label>
                                    <input  type="text" id=""
                                           name="society_registration_date" value="{{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sc_form_request->society_registration_date)) }}" readonly>
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
                            <div >
                                <label >९. सेवा हस्तांकरण झाल्याचा दिनांक:</label>
                                <div >
                                    <label  for="">१. मालमत्ता कर:</label>
                                    <input  type="text" id="" name="property_tax"
                                           value="{{ $sc_application->sc_form_request->property_tax }}" readonly>
                                </div>
                                <div >
                                    <label  for="">२. पाणी बिल:</label>
                                    <input  type="text" id="" name="water_bill"
                                           value="{{ $sc_application->sc_form_request->water_bill }}" readonly>
                                </div>
                                <div >
                                    <label  for="">३. अकृषिक कर:</label>
                                    <input  type="text" id="" name="non_agricultural_tax"
                                           value="{{ $sc_application->sc_form_request->non_agricultural_tax }}" readonly>
                                </div>
                            </div>
                            {{--<div >--}}
                                {{--<div >--}}
                                    {{--<label  for="">१०. कार्यकारणी यादी</label>--}}
                                    {{--<input  type="text" id=""--}}
                                               {{--name="society_address" value="{{ $sc_application->societyApplication->address }}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            <div >
                                <div >
                                    <label  for="">११. संस्थेचा अधिकृत पत्ता</label>
                                    <input  type="text" id="" name="society_address"
                                           value="{{ $sc_application->societyApplication->address }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div >
                        <div>
                            <p >आपला विश्वासू,</p>
                            <p>
                                <span >अध्यक्ष <input  type="text" id="" name="" value=""></span>
                                <span >सचिव <input  type="text" id="" name="" value=""></span>
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