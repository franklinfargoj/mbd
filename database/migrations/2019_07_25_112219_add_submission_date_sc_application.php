<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubmissionDateScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application', 'submission_date')){
                $table->dateTime('submission_date')->after('from_user_id')->nullable();
            } 
        });

        Schema::table('sc_agreement_comments', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_agreement_comments', 'status_id')){
                $table->Integer('status_id')->after('agreement_type_id')->nullable();
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
        Schema::table('sc_agreement_comments', function (Blueprint $table) {
            if (Schema::hasColumn('sc_agreement_comments', 'submission_date')){
                $table->dropColumn('submission_date');
            }
        });

        Schema::table('sc_agreement_comments', function (Blueprint $table) {
            if (Schema::hasColumn('sc_agreement_comments', 'status_id')){
                $table->dropColumn('status_id');
            }
        });
    }
}
