<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOlSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            $table->string('username')->nullable()->change();
            $table->string('architect_telephone_no')->nullable()->change();
            $table->string('optional_email')->nullable();

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
            $table->string('username');
            $table->string('architect_telephone_no');
        });
    }
}
