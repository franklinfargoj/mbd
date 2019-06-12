<?php

use Illuminate\Database\Seeder;
use App\NocSocietyDocumentsMaster;
use App\OlApplicationMaster;
use App\LanguageMaster;
 
class NocSocietyDocumentsMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        NocSocietyDocumentsMaster::truncate();
        $data = NocSocietyDocumentsMaster::where(['application_id'=>'4'])->get();
        $language = LanguageMaster::where(['language'=>'English'])->value('id');
        // dd($language);
        if(count($data) == 0){
        	$doc_mas_entry= [
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Offer letter",
                    'is_optional' => 0,
                    'group' => 1,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Receipts of offsite infrastructure charges paid to planning authority MHADA",
                    'is_optional' => 0,
                    'group' => 2,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Receipts of premium charges paid to Mumbai board",
                    'is_optional' => 0,
                    'group' => 3,
                    'is_other' => 0
                ],
                // [
                //     'application_id'   => 4,
                //     'language_id'   => $language,
                //     'name' => "Receipts of premium charges 2",
                //     'is_optional' => 0
                // ], 
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Receipt of water charges",
                    'is_optional' => 0,
                    'group' => 4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Indemnity bond / Undertaking",
                    'is_optional' => 0,
                    'group' => 5,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Undertaking first time duty (form 7)",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>1,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Indemnity bond for legal proceding (form 5)",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>2,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Undertaking of acceptance of offer letter",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>3,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Undertaking of registration of labor",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "No due cerificate",
                    'is_optional' => 0,
                    'group' => 7,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Society Resolution",
                    'is_optional' => 0,
                    'group' => 8,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 4,
                    'language_id'   => $language,
                    'name' => "Other",
                    'is_optional' => 1,
                    'group' => 9,
                    'is_other' => 1
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
                    'name' => "Offer letter",
                    'is_optional' => 0,
                    'group' => 1,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Society Resolution",
                    'is_optional' => 1,
                    'group' => 2,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to Mumbai board",
                    'is_optional' => 0,
                    'group' => 3,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to planning authority",
                    'is_optional' => 0,
                    'group' => 4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Water charges receipt",
                    'is_optional' => 0,
                    'group' => 5,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Undertaking form 5",
                    'is_optional' => 0,
                    'group' => 6,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Undertaking for acceptance of offer letter",
                    'is_optional' => 0,
                    'group' => 7,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 8,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1,
                    'group' => 8,
                    'is_other' => 1
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
                    'language_id'   => $language,
                    'name' => "Offer letter",
                    'is_optional' => 0,
                    'group' => 1,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Receipts of offsite infrastructure charges paid to planning authority MHADA",
                    'is_optional' => 0,
                    'group' => 2,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Receipts of premium charges paid to Mumbai board",
                    'is_optional' => 0,
                    'group' => 3,
                    'is_other' => 0
                ],
                // [
                //     'application_id'   => 15,
                //     'language_id'   => $language,
                //     'name' => "Receipts of premium charges 2",
                //     'is_optional' => 0
                // ], 
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Receipt of water charges",
                    'is_optional' => 0,
                    'group' => 4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Indemnity bond / Undertaking",
                    'is_optional' => 0,
                    'group' => 5,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Undertaking first time duty (form 7)",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>1,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Indemnity bond for legal proceding (form 5)",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>2,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Undertaking of acceptance of offer letter",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>3,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Undertaking of registration of labor",
                    'is_optional' => 0,
                    'group' => 6,
                    'sort_by' =>4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "No due cerificate",
                    'is_optional' => 0,
                    'group' => 7,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Society Resolution",
                    'is_optional' => 0,
                    'group' => 8,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 15,
                    'language_id'   => $language,
                    'name' => "Other",
                    'is_optional' => 1,
                    'group' => 9,
                    'is_other' => 1
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
                    'name' => "Offer letter",
                    'is_optional' => 0,
                    'group' => 1,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Society Resolution",
                    'is_optional' => 1,
                    'group' => 2,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to Mumbai board",
                    'is_optional' => 0,
                    'group' => 3,
                    'is_other' => 0
                ], 
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Receipts of offsite infrastructure charges paid to planning authority",
                    'is_optional' => 0,
                    'group' => 4,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Water charges receipt",
                    'is_optional' => 0,
                    'group' => 5,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Undertaking form 5",
                    'is_optional' => 0,
                    'group' => 6,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Undertaking for acceptance of offer letter",
                    'is_optional' => 0,
                    'group' => 7,
                    'is_other' => 0
                ],
                [
                    'application_id'   => 19,
                    'language_id'   => 1,
                    'name' => "Other",
                    'is_optional' => 1,
                    'group' => 8,
                    'is_other' => 1
                ],
             ];

             foreach ($doc_mas_entry3 as $each_doc) {
                $society_documents = NocSocietyDocumentsMaster::create($each_doc);
            }
        }
    }
}
