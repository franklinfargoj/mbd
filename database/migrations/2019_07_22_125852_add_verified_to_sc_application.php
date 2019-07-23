<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifiedToScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application', 'verified')){
                $table->tinyInteger('verified')->after('sent_to_society')->default(0);
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
        Schema::table('sc_application', function (Blueprint $table) {
            if (Schema::hasColumn('sc_application', 'verified')){
                $table->dropColumn('verified');
            }
        });
    }
}
