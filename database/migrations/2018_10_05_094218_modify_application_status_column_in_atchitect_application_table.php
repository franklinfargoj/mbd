<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyApplicationStatusColumnInAtchitectApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application', function (Blueprint $table) {
            $table->dropColumn('application_status');
        });
        Schema::table('architect_application', function (Blueprint $table) {
            $table->integer('application_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application', function (Blueprint $table) {
            $table->enum('application_status',[1,2,3,4])->comment('1 = New Application ,2 = Scrutiny pending, 3 = shortlisted, 4 = final');
        });
        Schema::table('architect_application', function (Blueprint $table) {
            $table->dropColumn('application_status');
        });
    }
}
