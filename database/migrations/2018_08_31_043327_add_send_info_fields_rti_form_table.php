<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendInfoFieldsRtiFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->string('filename');
            $table->string('filepath');
            $table->string('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->dropColumns(['filename','filepath','comment']);
        });
    }
}
