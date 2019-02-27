<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplicationIdInNocModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_society_document_status', function (Blueprint $table){
            if (!Schema::hasColumn('noc_society_document_status', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
            }          
        });

        Schema::table('noc_cc_society_document_status', function (Blueprint $table){
            if (!Schema::hasColumn('noc_cc_society_document_status', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
            }          
        });

        Schema::table('noc_cc_society_document_comment', function (Blueprint $table){
            if (!Schema::hasColumn('noc_cc_society_document_comment', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
            }          
        });

        Schema::table('noc_society_document_comment', function (Blueprint $table){
            if (!Schema::hasColumn('noc_society_document_comment', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
            }          
        });

        Schema::table('oc_society_document_status', function (Blueprint $table){
            if (!Schema::hasColumn('oc_society_document_status', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
            }          
        });

        Schema::table('oc_society_document_comment', function (Blueprint $table){
            if (!Schema::hasColumn('oc_society_document_comment', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
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
        Schema::table('noc_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('noc_society_document_status', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });

        Schema::table('noc_cc_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('noc_cc_society_document_status', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });

        Schema::table('noc_cc_society_document_comment', function (Blueprint $table) {
            if (Schema::hasColumn('noc_cc_society_document_comment', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });

        Schema::table('noc_society_document_comment', function (Blueprint $table) {
            if (Schema::hasColumn('noc_society_document_comment', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });

        Schema::table('oc_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('oc_society_document_status', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });

        Schema::table('oc_society_document_comment', function (Blueprint $table) {
            if (Schema::hasColumn('oc_society_document_comment', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });
    }
}
