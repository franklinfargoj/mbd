<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidationInOlSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_documents_master', 'validation')){
                $table->string('validation',30)->after('is_optional')->nullable();
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
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_society_documents_master', 'validation')){
                $table->dropColumn('validation');
            }
        });
    }
}
