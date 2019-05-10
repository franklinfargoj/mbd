<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToLmSocietyDetailCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('lm_society_detail', 'chairman_email')){
                $table->string('chairman_email')->after('chairman')->nullable();
            }
            if (!Schema::hasColumn('lm_society_detail', 'secretary_email')){
                $table->string('secretary_email')->after('secretary')->nullable();
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
        Schema::table('lm_society_detail', function (Blueprint $table) {
            if (Schema::hasColumn('lm_society_detail', 'chairman_email')){
                $table->dropColumn('chairman_email');
            }
            if (Schema::hasColumn('lm_society_detail', 'secretary_email')){
                $table->dropColumn('secretary_email');
            }
        });
    }
}
