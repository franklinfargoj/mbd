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
