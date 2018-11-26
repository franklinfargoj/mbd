<?php

use Illuminate\Database\Seeder;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\conveyance\scApplicationType;
use App\LanguageMaster;

class SocietyConveyanceDocumentMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $society = SocietyConveyanceDocumentMaster::all();
        $conveyanceId = scApplicationType::where('application_type','=','Conveyance')->value('id');
        $renewalId = scApplicationType::where('application_type','=','Renewal')->value('id');
        $formation = scApplicationType::where('application_type','=','Formation')->value('id');
        $mLanguage = LanguageMaster::where('language','=','marathi')->value('id');
        $eLanguage = LanguageMaster::where('language','=','English')->value('id');
     
        $sc_documents = [
            [
            'document_name'       => 'अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे)',
            'application_type_id' => $conveyanceId,
            'society_flag'        => '1',
            'language_id'         => $mLanguage
            ],
            [
                'document_name'       => 'संस्था नोंदणी प्रमाणपत्राची प्रत',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'       => 'कार्यकारणी यादी',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'       => 'पावती',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $mLanguage
            ],            
            [
                'document_name'       => 'Sale Deed Agreement',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'Lease Deed Agreement',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],                       
            [
                'document_name'       => 'stamp_conveyance_application',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'pay_stamp_duty_letter',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'sc_resolution',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'sc_undertaking',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'bonafide_list',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],                     
            [
                'document_name'       => 'em_covering_letter',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],             
            [
                'document_name'       => 'text_no_dues_certificate',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'drafted_no_dues_certificate',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'uploaded_no_dues_certificate',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'DYCDO_note',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],             
            [
                'document_name'       => 'noc_conveyance',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'       => 'architect_conveyance_map',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ], 
            [
                'document_name'       => 'Renewal Lease Deed Agreement',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'संस्थेचा अर्ज',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'old_lease_agreement',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'list_of_members_from_society',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'resolutions_of_society_for_renewal_of_lease_deed',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => "society's_approved_plan_from_concern_authority",
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'receipts_of_payment_of_lease_rent_or_other_dues',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'others',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'stamp_renewal_application',
                'application_type_id' => $renewalId,
                'society_flag'        => '1',
                'language_id'         => $eLanguage
            ],
            //-------------- society formation docs ---------------------------------------
            [
                'document_name'       => 'स्टेटमेंट सी पर्‍त १',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'       => 'फॉर्म [ ए ]',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'       => 'स्टेटमेंट ए, बी पर्‍त',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'       => '६६ फॉर्म एक्स - १',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' =>'सोसायटीच्या दहा पर्‍वर्तकाचे पर्‍तिज्ञापञ [ एफिडेव्हिड ]',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' => 'बाॅयलाॅन पर्‍ती',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' =>'रिझर्व्ह बँक चलनाची मूळ',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' =>'संस्थेच्या पाञ सभासदांची यादी',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' =>'ना हरकत पर्‍माणपतर्‍',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name' =>'इमारतीचा नकाशा',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'संस्थेच्या कामकाजाची योजना',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'संस्थेच्या जमाखर्चाचा तक्ता',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'बँक बॅलन्स पर्‍माणपतर्‍ मूळ पर्‍त',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'नाव आरक्षण पञाचाी छायांकित पर्‍त',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'मुख्य पर्‍वर्तकाचे अभिवचन [ सभासद झालेल्या गाळेधारकांच्या बाबतीत ]',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'मुख्य पर्‍वर्तकाचा विनंती अर्ज',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],            
            [
                'document_name'=>'conveyance_text_stamp_duty_letter',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'=>'conveyance_stamp_duty_letter',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'conveyance_draft_stamp_duty_letter',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'renewal_text_stamp_duty_letter',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'renewal_stamp_duty_letter',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'renewal_draft_stamp_duty_letter',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'=>'संस्थेचा ठराव',
                'application_type_id' => $formation,
                'society_flag'        => '0',
                'language_id'         => $mLanguage
            ],
            [
                'document_name'=>'conveynace_draft_NOC',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'conveynace_text_NOC',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'conveynace_uploaded_NOC',
                'application_type_id' => $conveyanceId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'renewal_draft_NOC',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],           
            [
                'document_name'=>'renewal_text_NOC',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],            
            [
                'document_name'=>'renewal_uploaded_NOC',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_bonafide_list',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_em_covering_letter',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_text_no_dues_certificate',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_drafted_no_dues_certificate',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_uploaded_no_dues_certificate',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
            [
                'document_name'       => 'renewal_Lease Deed Agreement',
                'application_type_id' => $renewalId,
                'society_flag'        => '0',
                'language_id'         => $eLanguage
            ],
        ];

        if(count($society) == 0){
            SocietyConveyanceDocumentMaster::insert($sc_documents);
        }else{
            foreach($sc_documents as $sc_documents_key => $sc_documents_val){
                $sc_document = SocietyConveyanceDocumentMaster::where('document_name', $sc_documents_val['document_name'])->first();
                if(!$sc_document){
                    SocietyConveyanceDocumentMaster::insert($sc_documents_val);
                }
            }
        }
    }
}
