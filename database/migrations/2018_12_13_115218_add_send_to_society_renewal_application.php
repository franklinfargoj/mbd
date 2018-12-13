<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendToSocietyRenewalApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('renewal_application', function (Blueprint $table) {
                       
            if (!Schema::hasColumn('renewal_application', 'sent_to_society')){
                $table->integer('sent_to_society')->default('0');               
            }

            if (!Schema::hasColumn('renewal_application', 'stamp_by_dycdo')){
                $table->integer('stamp_by_dycdo')->default('0');               
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
        Schema::table('renewal_application', function (Blueprint $table) {
            $table->dropColumn('sent_to_society');
            $table->dropColumn('stamp_by_dycdo');
        });
    }
}
