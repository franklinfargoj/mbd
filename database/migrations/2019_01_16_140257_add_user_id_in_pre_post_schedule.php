<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdInPrePostSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_post_schedule', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_post_schedule', 'user_id')){
                $table->integer('user_id')->after('hearing_id')->nullable();                
            }            
        });        

        Schema::table('pre_post_schedule', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_post_schedule', 'time')){
                $table->string('time')->after('date')->nullable();                
            }            
        });        

        Schema::table('hearing_schedule', function (Blueprint $table) {
            if (!Schema::hasColumn('hearing_schedule', 'user_id')){
                $table->integer('user_id')->after('hearing_id')->nullable();                
            }            
        });        

        Schema::table('upload_case_judgement', function (Blueprint $table) {
            if (!Schema::hasColumn('upload_case_judgement', 'user_id')){
                $table->integer('user_id')->after('hearing_id')->nullable();                
            }            
        });        

        Schema::table('send_notice_to_appellant', function (Blueprint $table) {
            if (!Schema::hasColumn('send_notice_to_appellant', 'user_id')){
                $table->integer('user_id')->after('hearing_id')->nullable();                
            }            
        });        

        Schema::table('forward_case', function (Blueprint $table) {
            if (!Schema::hasColumn('forward_case', 'user_id')){
                $table->integer('user_id')->after('hearing_id')->nullable();                
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
        Schema::table('pre_post_schedule', function (Blueprint $table) {
            if (Schema::hasColumn('pre_post_schedule', 'user_id')){
                 $table->dropColumn('user_id');               
            }             
        });         

        Schema::table('pre_post_schedule', function (Blueprint $table) {
            if (Schema::hasColumn('pre_post_schedule', 'time')){
                 $table->dropColumn('time');               
            }             
        });        

        Schema::table('hearing_schedule', function (Blueprint $table) {
            if (Schema::hasColumn('hearing_schedule', 'user_id')){
                 $table->dropColumn('user_id');               
            }             
        });        

        Schema::table('upload_case_judgement', function (Blueprint $table) {
            if (Schema::hasColumn('upload_case_judgement', 'user_id')){
                 $table->dropColumn('user_id');               
            }             
        });        

        Schema::table('send_notice_to_appellant', function (Blueprint $table) {
            if (Schema::hasColumn('send_notice_to_appellant', 'user_id')){
                 $table->dropColumn('user_id');               
            }             
        });        

        Schema::table('forward_case', function (Blueprint $table) {
            if (Schema::hasColumn('forward_case', 'user_id')){
                 $table->dropColumn('user_id');               
            }             
        });
    } 
}
