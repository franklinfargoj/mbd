<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentInOlDemarcationQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::table('ol_demarcation_question_master', function (Blueprint $table){
            if (!Schema::hasColumn('ol_demarcation_question_master', 'parent')){
                $table->integer('parent')->after('id')->nullable();                
            } 
            if (!Schema::hasColumn('ol_demarcation_question_master', 'has_many')){
                $table->tinyInteger('has_many')->after('is_compulsory')->default(0);                
            } 
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_number')){
                $table->tinyInteger('is_number')->after('has_many')->default(0);                
            }            
        });

        Schema::table('ol_demarcation_land_area', function (Blueprint $table){
            if (!Schema::hasColumn('ol_demarcation_land_area', 'total_area')){
                $table->string('total_area')->after('another_area')->nullable();                
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
        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_question_master', 'parent')){
                 $table->dropColumn('parent');               
            }            
            if (Schema::hasColumn('ol_demarcation_question_master', 'has_many')){
                 $table->dropColumn('has_many');               
            }            
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_number')){
                 $table->dropColumn('is_number');               
            }             
        });         

        Schema::table('ol_demarcation_land_area', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_land_area', 'total_area')){
                 $table->dropColumn('total_area');               
            }                       
        }); 
    }
}
