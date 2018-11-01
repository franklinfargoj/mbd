<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksAndMarksToEoaApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->decimal('application_marks',5,2)->default(0)->nullable();
            $table->string('application_remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->dropColumn('application_marks');
            $table->dropColumn('application_remark');
        });
    }
}
