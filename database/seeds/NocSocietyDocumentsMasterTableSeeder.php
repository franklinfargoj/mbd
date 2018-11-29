<?php

use Illuminate\Database\Seeder;
use App\NocSocietyDocumentsMaster;
use App\OlApplicationMaster;

class NocSocietyDocumentsMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = NocSocietyDocumentsMaster::where(['application_id'=>'4'])->get();

        if(count($data) == 0){
        	$doc_mas_entry= [
                [
                    'application_id'   => 4,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => 1,
                    'name' => "Society Resolution"
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to BMC"
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => 1,
                    'name' => "Indemnity bond / Undertaking"
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry as $each_doc) {
                $society_documents = NocSocietyDocumentsMaster::create($each_doc);
            }
        }

        $data1 = NocSocietyDocumentsMaster::where(['application_id'=>'8'])->get();

        if(count($data1) == 0){
        	$doc_mas_entry1= [
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Society Resolution"
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to BMC"
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Indemnity bond / Undertaking"
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry1 as $each_doc) {
                $society_documents = NocSocietyDocumentsMaster::create($each_doc);
            }
        }

        $data2 = NocSocietyDocumentsMaster::where(['application_id'=>'15'])->get();

        if(count($data2) == 0){
        	$doc_mas_entry2= [
                [
                    'application_id'   => 15,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => 1,
                    'name' => "Society Resolution"
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to BMC"
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => 1,
                    'name' => "Indemnity bond / Undertaking"
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry2 as $each_doc) {
                $society_documents = NocSocietyDocumentsMaster::create($each_doc);
            }
        }

        $data3 = NocSocietyDocumentsMaster::where(['application_id'=>'19'])->get();

        if(count($data3) == 0){
        	$doc_mas_entry3= [
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Offer letter"
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Society Resolution"
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to BMC"
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Indemnity bond / Undertaking"
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1
                ],
             ];

             foreach ($doc_mas_entry3 as $each_doc) {
                $society_documents = NocSocietyDocumentsMaster::create($each_doc);
            }
        }
    }
}
