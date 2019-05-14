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
        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_option')){
                $table->tinyInteger('is_option')->after('is_compulsory')->default(0);                
            } 
            if (!Schema::hasColumn('ol_demarcation_question_master', 'group')){
                $table->integer('group')->after('is_option')->nullable();                
            } 
            if (!Schema::hasColumn('ol_demarcation_question_master', 'sort_by')){
                $table->integer('sort_by')->after('group')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('sort_by')->default(0);                
            }
            if (!Schema::hasColumn('ol_demarcation_question_master', 'hide')){
                $table->tinyInteger('hide')->after('is_deleted')->default(0);                
            }
            if (!Schema::hasColumn('ol_demarcation_question_master', 'class')){
                $table->string('class')->after('hide')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_select')){
                $table->tinyInteger('is_select')->after('class')->default(0);                
            }
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_table')){
                $table->tinyInteger('is_table')->after('is_select')->default(0);                
            } 
        }); 

        // demarcation answer table
        Schema::table('ol_demarcation_details', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_details', 'floor')){
                $table->string('floor')->after('remark')->nullable();                
            } 
            if (!Schema::hasColumn('ol_demarcation_details', 'number')){
                $table->string('number')->after('floor')->nullable();                
            } 
            if (!Schema::hasColumn('ol_demarcation_details', 'residential')){
                $table->string('residential')->after('number')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_details', 'non_residential')){
                $table->string('non_residential')->after('residential')->nullable();                
            }
            if (!Schema::hasColumn('ol_demarcation_details', 'encrochment')){
                $table->string('encrochment')->after('non_residential')->nullable();                
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
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_option')){
                $table->dropColumn('is_option');                
            } 
            if (Schema::hasColumn('ol_demarcation_question_master', 'group')){
                $table->dropColumn('group');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'sort_by')){
                $table->dropColumn('sort_by');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_deleted')){
                $table->dropColumn('is_deleted');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'hide')){
                $table->dropColumn('hide');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'class')){
                $table->dropColumn('class');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_select')){
                $table->dropColumn('is_select');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_table')){
                $table->dropColumn('is_table');                
            }
        });

        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_question_master', 'floor')){
                $table->dropColumn('floor');                
            } 
            if (Schema::hasColumn('ol_demarcation_question_master', 'number')){
                $table->dropColumn('number');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'residential')){
                $table->dropColumn('residential');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'non_residential')){
                $table->dropColumn('non_residential');                
            }
            if (Schema::hasColumn('ol_demarcation_question_master', 'encrochment')){
                $table->dropColumn('encrochment');                
            }
        });
    }
}
