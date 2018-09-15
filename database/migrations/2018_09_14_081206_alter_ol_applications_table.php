<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOlApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_applications', function (Blueprint $table) {
            $table->string('demarkation_verification_comment')->nullable()->change();
            $table->string('encrochment_verification_comment')->nullable()->change();
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
            $table->dropColumn(['demarkation_verification_comment', 'encrochment_verification_comment']);
        });
    }
}
