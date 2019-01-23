<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="ie=edge" http-equiv="X-UA-Compatible">
      <title>Consent for OC</title>
   </head>
   <body>
      <div class="m_portlet">
         <form action="{{route('ree.save_draft_consent_oc')}}" id="OfferLetterFRM" method="post" name="OfferLetterFRM">
            @csrf <input id="applicationId" name="applicationId" type="hidden" value="{{$applicatonId}}"> 
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">               @if($content != "") {{$content}} @else
            <div id="" style="font-size: 16px">
                <p><strong>मसुदा मान्यतेकरीता सादर</strong>
                    <br /> जा।क्र।/नि।का।अभि।/मुं।मुं।/नाहप्र/नस्ती क्र। - ९१९ व ५५७ / /१८,<br /> दिनांक: 
                    <br /> 
                    <br />
                    <strong>नियोजन प्राधिकरण / म्हाडा मार्फत भागशः भोगवटा प्रमाणपत्र प्राप्त करण्याकरिता संमती पत्र</strong>
                </p>
                <p><br />प्रति,<br />कार्यकारी अभियंता,<br />इमारत परवानगी कक्ष,बृहन्मुंबई क्षेत्र,<br />म्हाडा,वाद्रे (पु।),<br />मुंबई-४००० ०५१।<br />
                </p>
                <p style="margin-top: 10px">
                <strong >विषय</strong> टिळकनगर,चेंबूर या वसाहतीतील इ।क्र।४८,टिळकनगर इंद्रायणी सहकारी गृहनिर्माण संस्था मर्या, न।भू।क। ३५ (पै), टिळक नगर, म्हाडा का&ugrave;लनी, मुंबई-४०००८९ या संस्थेच्या इमारतीला भागशः भोगवटा प्रमाणपत्र जारी करण्याकरीता सम्मती पत्र।</p>
                <p style="margin-top: 10px"><strong >संदर्भ</strong> १. मुंबई मडळाचे ना हरकत प्रमाणपत्र क्र।सीओ/एमबी/आर्च/एनओसी/एफ-९१९ /७२००/ २००७,दि।१४।०८।२००७।<br /><span style="margin-left: 28px;">&nbsp;</span>२. मुंबई मडळाचे ना हरकत प्रमाणपत्र क्र। सीओ/एमबी/आर्च/एनओसी/एफ-९१९ /४८८२/ २००९,दि।१४।१०।२००९&ucirc;&ucirc;<br /><span style="margin-left: 28px;">&nbsp;</span>३. मुंबई मडळाचे ना हरकत प्रमाणपत्र क्र।सीओ/एमबी/आर्च/एनओसी/एफ-९१९ /५२३२ / २०१०,दि।२९।०६।२०१०।<br /><span style="margin-left: 28px;">&nbsp;</span>४. संस्थेचे पत्र दिनांक ०२।०२।२०१८ व दि।२४।०९।२०१८ रोजीचे पत्र। <br /></p>
                <p style="margin-top: 10px">महोदय,<br /> संस्थेची दि।०२।०२।२०१८ रोजीच्या पत्रान्वये विषयांकित इमारतीचे बांधकाम पूर्ण झाल्याचे कळविले असून सदर पत्रान्वये विषयांकित इमारतीला भोगवटा प्रमाणपत्र मिळण्याकरिता मंडळाकडुन संमती पत्र मिळण्याबाबत प्रस्ताव सादर केला आहे।<br /> मुंबई मंडळाने संदर्भ क्र।१ ते ३ अन्वये संस्थेच्या पुनर्विकासाकरीता वि।नि।नि।३३ (५) अन्वये मंडळाने १५३३।०३ चौ।मी। (१४३३।६२ चौ।मी। भाडेपट्टा करारनाम्यानुसार + ९९।४१ चौ।मी। अतिरीक्त भूखंड) भूखंडावर २।५ च।क्षे।नि। अन्वये ३८३२।५७ चौ।मी।+ १४९०।७६ चौ।मी। प्रोराटा क्षेत्रफळ (प्रति गाळा ४१।४१ चौ।मी। X३६ गाळे) असे एकूण ५,३२३।३३ चौ।मी। [१०६९।९२ चौ।मी। अस्तित्वातील + ४२५३।४१ चौ।मी। (३९५२।९९ चौ।मी। निवासी+३००।४२ चौ।मी। वाणिज्य वापर) अतिरिक्त बांधकाम क्षेत्रफळ ] बांधकाम क्षेत्रफळाकरिता पत्र क्र। सीओ/एमबी/आर्च/एनओसी/एफ-९१९/५२३५/२०१०,दि।२९।०६।२०१० ना हरकत प्रमाणपत्र जारी करण्यात आले आहे।</p>
                <p>&nbsp;</p>
                <!-- CE/६१४१/BPES/र्M (र् not acceptable in html. so replace र् to html code because of mpdf) -->
                <p>बृहन्मुंबई महानगर पालिकेने पत्र क्र। CE/६१४१/BPES/&#8377;M, दि।१५।१०।२०१७ अन्वये संस्थेच्या इमारतीच्या बांधकामाचे आराखडा मंजूरीकरीता आय।ओ।डी। पत्र जारी केले आहे। तद्नंतर पत्र क्र। CE/६१४१/BPES/&#8377;M, दि।३०।०८।२०१६ अन्वये तळ मजला (स्टिल्ट) + पाका&euml;ग + १ ते १४ मजल्यांपर्यंत सुधारित नकाशास मंजूरी दिली आहे। मंजूर नकाशानुसार १,५३३।०३ चौ।मी। भूखंड क्षेत्रफळावर २।५ च।क्षे।नि। अन्वये ३८३२।५८ चौ।मी। + १४९०।६० चौ।मी। प्रोराटा क्षेत्रफळ क्षेत्रफळ असे एकूण ५३२३।३३ चौ।मी। (५०७९।०३ चौ।मी। निवासी+ २४४।३० चौ।मी। वाणिज्य वापर) बांधकाम क्षेत्रफळास मंजूरी दिली आहे। तसेच १,७७६।३६ चौ।मी। फंजिबल बांधकाम क्षेत्रफळाकरीता मंजुरी दिली आहे। सदर नकाशानुसार ३६ पुनर्वसन सदनिका व ८० विक्री सदनिका व १६ दुकाने अशा एकूण १३२ सदनिकांकरीता मंजूरी देण्यात आली आहे। <br /> संस्थेस वितरीत केलेल्या ९९।४१ चौ।मी। फुटकळ भूखंडाकरीता संस्थेने मंडळासोबत पुरवणी भाडेपटटा करारनामा अमलात आणलेला नाही। त्यामुळे पुनर्रचित इमारतीमधील १३ व्या मजल्यावरील ४ विक्री सदनिकांचे २७५।०५ चौ।मी। व १४ व्या मजल्यावरील २ विक्री सदनिकांचे १४०।८४ चौ।मी। असे एकूण ४१५।८९ चौ।मी। बांधकाम क्षेत्रफळ (विंग ए मधील ) वगळून तळ मजला (स्टिल्ट) + पाका&euml;ग + १ ते १२ मजल्यांपर्यंत ए - विंग करीता व तळ मजला (स्टिल्ट) + पाका&euml;ग + १ ते १४ मजल्यांपर्यंत विंग बी करीता असे एकूण ६४३९।८६ चौ।मी। फंजिबलसह (बृहन्मुंबई म।न।पा।ने दि।३०।०८।२०१६ रोजी दिलेल्या मंजुरीनुसार व एकूण ७१४८।५५ चौ।मी फंजिबल बांधकाम क्षेत्रफळापैकी) बांधकाम क्षेत्रफळाकरीता (अस्तित्वातील ३६ सदनिका + ७४ विक्री सदनिका) अशा एकूण ११० सदनिकांकरीता व १६ गाळे वाणिज्य वापराकरिता, संस्थेच्या इमारतीस भागशः भोगवटा प्रमाणपत्राकरीता समत्तीपत्र जारी करण्याबाबत समत्ती पत्र देण्यात येत आहे।<br /> पुनर्विकसित इमारतीच्या बांधकामास भागशः भोगवटा प्रमाणपत्र खालील अटी व शर्तीच्या अधिन राहून समत्तीपत्र देण्यात येत आहे। <br /></p>
                <p style="margin-top: 5px;">१। सदर समत्तीपत्र बृहन्मुंबई महानगर पालिकेने पत्र क्र CE/६१४१/BPES/&#8377;M, दि।३०।०८।२०१६ अन्वये मंजूर केलेल्या आराखड्यांच्या व कार्यकारी अभियंता / कुर्ला विभाग / मुं।मं। यांनी सादर केलेल्या अहवालानुसार देण्यात येत आहे। कार्यकारी अभियंता, इमारत परवानगी कक्ष,बृहन्मुंबई क्षेत्र,म्हाडा यांनी अंतिमतः मंजूरी दिलेल्या भागशः भोगवटा प्रमाणपत्रसह मंजूर नकाशाची एक प्रत निवासी कार्यकारी अभियंता / मुंबई मंडळ यांचेकडे अग्रेषित करावी।<br />२। संस्थेस / विकासकास संस्थेच्या जून्या इमारतीमधील सर्व सभासदांना नव्याने पुनर्विकसित केलेल्या इमारतीत प्रस्तावित वितरणानुसार पुर्नवसन करणे बंधनकारक राहील।<br />३। कार्यकारी अभियंता, इमारत परवानगी कक्ष,बृहन्मुंबई क्षेत्र,म्हाडा यांचेकडून भागशः भोगवटा प्रमाणपत्र प्राप्त झाल्याशिवाय पुनर्विकसित इमारतीमधील पुर्नवसन तसेच विक्री घटकांतील सदनिकांचा ताबा देण्यात येऊ नये।<br /></p>
                <p>४। भविष्यात अभिन्यास सुधारणा किंवा रस्तारुंदीकरणासाठी जागेची गरज पडल्यास सदर जागा मनपा / म्हाडा यांना स्वखर्चाने हस्तांतरीत करणे संस्थेस बंधनकारक राहील।<br />५। वास्तुशास्त्रज्ञ, अभिन्यास मंजुरी कक्ष,बृहन्मुंबई क्षेत्र,म्हाडा यांनी मंजूर केलेल्या सुधारीत अभिन्यासातील नमुद सर्व अटी आणि श्ार्ती संस्थेस बंधनकारक राहतील।</p>
                <p>६। भविष्यात संस्थेमार्फत तथा संस्थेच्या वास्तुशास्त्रज्ञांमार्फत सादर केलेली कागदपत्रे / माहिती चूकीची अथवा खोटी व दिशाभूल करणारी आढळून आल्यास, तसेच देकारपत्र व ना हरकत प्रमाणपत्रातल्या अटी व शर्तीचा भंग संस्थेकडून झाल्यास, सदर समत्तीपत्र रद्बादल ठरेल आणि त्या अनुषंगाने उदभवणा-या परिणामांची संपूर्ण जबाबदारी संस्थेची असेल। <br />७। संस्थेस वितरीत केलेल्या फूटकळ भूखंडाकरीता पुरवणी भाडेपट्टा करारनामा पुर्ण भोगवटा प्रमाणपत्राची मागणी करण्यापूर्वी करणे बंधनकारक राहिल।<br />८। सदर संमतीपत्र कोणतीही पुर्वसूचना न देता रद्यबातल करण्याचे अधिकार मुख्य अधिकारी / मुंबई मंडळ यांना राखून ठेवण्यात येत आहेत।<br /></p>
                <p>(मा। मुख्य अधिकारी/मुं।मं।यांच्या मान्यतेने)<br /></p>
                <p>
                    <table>
                        <tr>
                            <td width="400px">
                               (समीर सैय्यद)<br />कनिष्ठ अभियंता,<br />(प्रभारी) 
                            </td>
                            <td width="25%">(बाळासाहेब मुंडे)<br />उपअभियंता<br /></td>
                            <td width="25%">(शिल्पा आर।भागवते)<br />सहा।वास्तुशास्त्रज्ञ<br /></td>
                            <td width="25%">सही/-<br />(भूषण र। देसाई)<br />निवासी कार्यकारी अभियंता,<br />मुंबई मंडळ</td>
                        </tr>
                    </table>
                </p>
                <p>प्रत-<br />१) सचिव / अध्यक्ष, इ।क्र।४८,टिळक नगर इंद्रायणी सहकारी गृहनिर्माण संस्था मर्या, न।भू।क। ३५ (पै), टिळक नगर, म्हाडा का&ugrave;लनी, मुंबई-४०००८९ यांना माहितीसाठी।<br />२) संस्थेचे अधिकृत सर्वेक्षक मे। एलोरा प्रोजेक्ट कन्सल्टंट प्रा।लि।।, निनाद को।आ&ugrave;।हौ।सो।, रुम नं। ३१७/३२१, खेरनगर सर्व्हिस रोड, वांद्रे (पश्चिम), मुंबई-४०००५१ यांना माहितीसाठी।<br />३) वास्तुशास्त्रज्ञ, अभिन्यास कक्ष / मुं।मं। यांना माहितीसाठी<br />४) कार्यकारी अभियंता / कुर्ला विभाग / मुं।मं। यांना माहितीसाठी आणि योग्य त्या कार्यवाहीसाठी।<br />५) उपमुख्य अधिकारी / पुर्व विभाग / मुं।मं। यांना निदेर्शित करण्यात येते की, संस्थेसोबत सिमांकन नकाशानुसार व प्रचलित धोरणानुसार फुटकळ भूखंडाकरीता पुरवणी भाडेपट्टा करारनामा करण्याबाबत कार्यवाही करण्यात यावी।<br />६) मिळकत व्यवस्थापक / चेंबूर विभाग / मुं।मं। यांना संस्थेची कोणतिही थकबाकी नसल्याची खात्री करावी। तसेच संस्थेकडून कोणतिही देय रक्कम असल्यास त्याबाबत वसूलीची कार्यवाही करण्यात यावी व तसा अहवाल या कार्यालयास सादर करावा।<br />७) वरिष्ठ लिपिक / नि।का।अ।/ मुं।मं। यांना एम।आय।एस।नोदणीकरिता।</p>
                <p>&nbsp;</p>
                <p>
                    <table>
                        <tr>
                            <td width="400px">
                               (समीर सैय्यद)<br />कनिष्ठ अभियंता,<br />(प्रभारी) 
                            </td>
                            <td width="25%">(बाळासाहेब मुंडे)<br />उपअभियंता<br /></td>
                            <td width="25%">(शिल्पा आर।भागवते)<br />सहा।वास्तुशास्त्रज्ञ<br /></td>
                            <td width="25%">सही/-<br />(भूषण र। देसाई)<br />निवासी कार्यकारी अभियंता,<br />मुंबई मंडळ</td>
                        </tr>
                    </table>
                </p>
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