<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNocDateToNocBuildupArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_buildup_area', function (Blueprint $table){
            if (!Schema::hasColumn('noc_buildup_area', 'noc_date')){
                $table->string('noc_date')->after('total_existing_permitted_area')->nullable();                
            }
            if (!Schema::hasColumn('noc_buildup_area', 'noc_vide_lease')){
                $table->string('noc_vide_lease')->after('noc_date')->nullable();                
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
        Schema::table('noc_buildup_area', function (Blueprint $table){
            if (Schema::hasColumn('noc_buildup_area', 'noc_date')){
                $table->dropColumn('noc_date');                
            }
            if (Schema::hasColumn('noc_buildup_area', 'noc_vide_lease')){
                $table->dropColumn('noc_vide_lease');                
            }       
        });
    }
}
