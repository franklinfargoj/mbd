<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilenameColumnToForwardCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upload_case_judgement', function (Blueprint $table) {
            $table->string('judgement_case_filename')->after('upload_judgement_case')->nullable();
        });

        Schema::table('send_notice_to_appellant', function (Blueprint $table) {
            $table->string('upload_notice_filename')->after('upload_notice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upload_case_judgement', function (Blueprint $table) {
            $table->dropColumn('judgement_case_filename');
        });

        Schema::table('send_notice_to_appellant', function (Blueprint $table) {
            $table->dropColumn('upload_notice_filename');
        });
    }
}
