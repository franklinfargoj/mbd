<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildsInRenewalSecondApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('renewal_application', function (Blueprint $table) {
            if (!Schema::hasColumn('renewal_application', 'change_in_use')){
                $table->string('change_in_use')->nullable();                
            }            
            if (!Schema::hasColumn('renewal_application', 'change_in_structure')){
                $table->string('change_in_structure')->nullable();                
            }            
            if (!Schema::hasColumn('renewal_application', 'encroachment')){
                $table->string('encroachment')->nullable();                
            }
            // $table->string('change_in_structure')->after('change_in_use')->nullable();
            // $table->string('encroachment')->after('change_in_structure')->nullable();
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
            $table->dropColumn('change_in_use');
            $table->dropColumn('change_in_structure');
            $table->dropColumn('encroachment');
        });
    }
}
