<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScApplicationFormRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::table('sc_application_form_request', function (Blueprint $table){
            $table->renameColumn('water_bil', 'water_bill');
            $table->renameColumn('no_agricultural_tax', 'non_agricultural_tax');
            $table->integer('society_id')->nullable()->change();
            $table->string('template_file')->nullable();
        });

        Schema::table('sc_application', function (Blueprint $table){
            $table->renameColumn('board_id', 'layout_id')->change();
        });        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table){
            $table->dropColumn('template_file');  
            $table->renameColumn('water_bill', 'water_bil');  
            $table->renameColumn('non_agricultural_tax', 'no_agricultural_tax');        
        });

        Schema::table('sc_application', function (Blueprint $table){
            $table->renameColumn('layout_id', 'board_id')->change();
        });         
    }
}
 