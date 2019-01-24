<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHearingScheduleIdAndPrePostIdToUploadCaseJudgementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upload_case_judgement', function (Blueprint $table) {
            $table->integer('scheduled_hearing_id')->nullable()->after('judgement_case_filename');
            $table->integer('pre_post_hearing_id')->nullable()->after('scheduled_hearing_id');

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
            $table->dropColumn('scheduled_hearing_id');
            $table->dropColumn('pre_post_hearing_id');

        });
    }
}
