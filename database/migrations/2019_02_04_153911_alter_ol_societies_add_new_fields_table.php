<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOlSocietiesAddNewFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            $table->string('society_wing_no')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('chairman_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            $table->dropColumn(['society_wing_no', 'secretary_name', 'chairman_name']);
        });
    }
}
