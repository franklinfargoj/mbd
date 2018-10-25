<?php

use Illuminate\Database\Seeder;
use App\OlSocietyDocumentsMaster;
class isOptionalDocumentMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentId = ['8','13','15','29','31','35','44','49','51','55','68','70','74'];

        $documentMaster = OlSocietyDocumentsMaster::whereIn('id',$documentId)->update(['is_optional' => '1']);
    }
}
