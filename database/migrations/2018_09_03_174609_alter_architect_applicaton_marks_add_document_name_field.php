<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArchitectApplicatonMarksAddDocumentNameField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application_marks', function (Blueprint $table) {
            $table->string('document_name')->after('architect_application_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application_marks', function (Blueprint $table) {
            $table->dropColumns(['document_name']);
        });
    }
}
