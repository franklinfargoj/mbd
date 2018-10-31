<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOlSocieties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            $table->integer('layout_id')->after('user_id')->nullable();
            $table->integer('colony_id')->after('layout_id')->nullable();
            $table->string('society_bill_level')->after('colony_id')->nullable();
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
            $table->dropColumn('layout_id');
            $table->dropColumn('colony_id');
            $table->dropColumn('society_bill_level');
        });
    }
}
