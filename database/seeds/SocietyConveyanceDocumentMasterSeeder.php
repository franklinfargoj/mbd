<?php

use Illuminate\Database\Seeder;
use App\SocietyConveyanceDocumentMaster;

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

        $sc_documents = [
            [
            'document_name' => 'अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे)',
            'application_type_id' => '1',
            'language_id' => '2'
            ],
            [
                'document_name' => 'संस्था नोंदणी प्रमाणपत्राची प्रत',
                'application_type_id' => '1',
                'language_id' => '2'
            ],
            [
                'document_name' => 'कार्यकारणी यादी',
                'application_type_id' => '1',
                'language_id' => '2'
            ],
            [
                'document_name' => 'पावती',
                'application_type_id' => '1',
                'language_id' => '2'
            ],
        ];

        if(count($society) == 0){
            SocietyConveyanceDocumentMaster::insert($sc_documents);
        }else{
            foreach($sc_documents as $sc_documents_key => $sc_documents_val){
                $sc_document = SocietyConveyanceDocumentMaster::where('document_name', $sc_documents_val['document_name'])->first();
                if($sc_document){
                    continue;
                }else{
                    SocietyConveyanceDocumentMaster::insert($sc_documents_val);
                }
            }
        }
    }
}
