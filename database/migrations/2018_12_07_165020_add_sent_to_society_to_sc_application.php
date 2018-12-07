<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentToSocietyToScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            
            if (!Schema::hasColumn('sc_application', 'sent_to_society')){  
                $table->tinyInteger('sent_to_society')->after('phase')->default('0');             
            }            
           
            if (!Schema::hasColumn('sc_application', 'from_user_id')){
                $table->integer('from_user_id')->after('sent_to_society')->nullable();               
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
            $table->dropColumn('sent_to_society');
            $table->dropColumn('from_user_id');
        });
    }
}
