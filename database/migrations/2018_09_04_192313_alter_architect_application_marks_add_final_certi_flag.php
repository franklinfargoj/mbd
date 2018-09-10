<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArchitectApplicationMarksAddFinalCertiFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application_marks', function (Blueprint $table) {
            $table->enum('final_certificate',[0,1])->after('remark')->default(0);
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
            $table->dropColumns(['final_certificate']);
        });
    }
}
