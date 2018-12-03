<?php

use Illuminate\Database\Seeder;
use App\NocCCSocietyDocumentsMaster;
use App\OlApplicationMaster;

class NocCCSocietyDocumentsMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = NocCCSocietyDocumentsMaster::where(['application_id'=>'10'])->get();

        if(count($data) == 0){
        	$doc_mas_entry= [
                [
                    'application_id'   => 10,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 10,
                    'language_id'   => 1,
                    'name' => "Registered triparty Agreement"
                ],
                [
                    'application_id'   => 10,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry as $each_doc) {
                $society_documents = NocCCSocietyDocumentsMaster::create($each_doc);
            }
        }

        $data1 = NocCCSocietyDocumentsMaster::where(['application_id'=>'21'])->get();

        if(count($data1) == 0){
        	$doc_mas_entry1= [
                [
                    'application_id'   => 21,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 21,
                    'language_id'   => 1,
                    'name' => "Registered triparty Agreement"
                ],
                [
                    'application_id'   => 21,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry1 as $each_doc) {
                $society_documents = NocCCSocietyDocumentsMaster::create($each_doc);
            }
        }
    }
}
