<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildsInRenewalApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('renewal_application', function (Blueprint $table) {
            $table->tinyInteger('is_sanctioned_oc')->after('application_status')->nullable();
            $table->string('sanctioned_comments')->after('is_sanctioned_oc')->nullable();
            $table->tinyInteger('is_additional_fsi')->after('sanctioned_comments')->nullable();
            $table->string('additional_fsi_comments')->after('is_additional_fsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('renewal_application', function (Blueprint $table) {
            $table->dropColumn('is_sanctioned_oc');
            $table->dropColumn('sanctioned_comments');
            $table->dropColumn('is_additional_fsi');
            $table->dropColumn('additional_fsi_comments');
        });
    }
}
