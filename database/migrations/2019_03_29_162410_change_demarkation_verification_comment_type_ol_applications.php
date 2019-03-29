<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDemarkationVerificationCommentTypeOlApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_applications', function (Blueprint $table) {
            $table->text('demarkation_verification_comment')->nullable()->change();
            $table->text('encrochment_verification_comment')->nullable()->change();
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
            $table->varchar('demarkation_verification_comment')->change();
            $table->varchar('encrochment_verification_comment')->change();
        });
    }
}
