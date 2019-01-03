<div id="printdiv">
    <div style="font-size: 18px;">
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
                                <td style="border-bottom: 1px solid #000; font-size: 18px;">EE</td>
                                <td style="font-size: 18px;">विभाग,</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">गृहनिर्माण भवन, वांद्रे (पुर्व),</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">मुंबई - ४०००५१.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">
                <p style="text-indent: 80px;"><span style="display: block; font-weight: bold;">विषय :- </span>इमारत क्र. <span style="width: 50px; border-bottom: 1px solid #000;">{{ $society_details->building_no }}</span>, <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span> सहकारी गृहनिर्माण संस्थेच्या @if($id == '2' || $id == '6')स्वय@endifपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
                <p style="font-weight: bold;">महोदय,</p>
                <p style="text-indent: 80px;">आम्ही <span style="width: 150px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span> सहकारी गृहनिर्माण संस्थेचे पदाधिकारी ( इमारत क्र. <span style="width: 50px; border-bottom: 1px solid #000;">{{ $society_details->building_no }}</span> पत्ता - <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->address }}</span>) आपणांस विनंती करतो की, आम्ही रहात असलेल्या सदरहू इमारतीचा @if($id == '2' || $id == '6')स्वय@endifपुनर्विकास विकास नियंत्रण नियमावली ३३ (५) अंतर्गत @if($id == '6' || $id == '17') गृहसाठा हिस्सेदारी @endif @if($id == '2' || $id == '13') अधिमुल्य आधारित @endif तत्वावर करु इच्छितो. आमच्या गृहनिर्माण संस्थेने दिनांक <span style="width: 100px; border-bottom: 1px solid #000;">{{ date('d-m-Y', strtotime($ol_application->request_form->date_of_meeting)) }}</span> रोजी @if($id == '2' || $id == '6')स्वय@endifपुनर्विकासासंदर्भात सर्वसाधारण सभेचा ठराव क्र. <span style="width: 200px; border-bottom: 1px solid #000;">{{ $ol_application->request_form->resolution_no }}</span> अन्वये निर्णय घेतला आहे, त्याची प्रत सोबत जोडली आहे.</p>
                <p style="text-indent: 80px;">आम्ही सहकारी गृहनिर्माण संस्थेच्या @if($id == '2' || $id == '6')स्वय@endifपुनर्विकासाच्या कामांसाठी वि.नि.नि ३३ (५) मधील तरतूदींच्या अधिन राहून याबाबतचे सविस्तर आराखडे / नकाशे व @if($id == '2' || $id == '6')स्वय@endifपुनर्विकासाच्या कामावर देखरेख करण्यासाठी  <span style="width: 100px; border-bottom: 1px solid #000;">{{ $ol_application->request_form->architect_name }}</span> या वास्तुशास्त्रज्ञाची नियुक्ती केली आहे.@if($id == '13' || $id == '17')आमच्या संस्थेच्या इमारतीच्या पुनर्विकासाचे काम करणेकरीता <span style="width: 200px; border-bottom: 1px solid #000;">{{ $ol_application->request_form->developer_name }}</span> या विकासकाची निवड केली आहे, त्याचा सर्वसाधणार सभेच्या ठराव अन्वये निर्णय घेतला आहे व त्याची प्रत सोबत जोडली आहे.@endif</p>
                <p style="text-indent: 80px;">यानुसार आपणांस विनंती करण्यात येते की, अभिन्यासातील अनुज्ञेय प्रोराटा क्षेत्रफळाचे वितरण संस्थेस करावे व संस्थेस वितरण करण्यात येणाऱ्या अतिरिक्त बांधकाम क्षेत्रफळाकरीता भरणा करावे लागणारे अधिमुल्य म्हाडाच्या धोरणानुसार ४ समान हप्त्यात देण्यात यावे.</p>
                <p style="text-indent: 80px;">सदर प्रस्तावावर उचित कार्यवाही करुन देकारपत्र जारी करण्याची कार्यवाही करण्यात यावी, ही विनंती.</p>
            </div>
            <div style="margin-top: 30px;">
                <div style="float: right; text-align: right;">
                    <p style="margin-top: 0; margin-bottom: 60px;">आपला विश्वासू</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">अध्यक्ष / सचिव / खजिनदार</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>
                </div>
            </div>
        </div>
    </div>
</div>