<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOfferLetterUploadedInOlApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_applications', 'is_offer_letter_uploaded')){
                $table->tinyInteger('is_offer_letter_uploaded')->after('is_approve_offer_letter')->default(0);                
            } 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_applications', function (Blueprint $table) {
            if (Schema::hasColumn('ol_applications', 'is_offer_letter_uploaded')){
                $table->dropColumn('is_offer_letter_uploaded');                
            }
        });
    }
}
