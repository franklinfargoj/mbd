<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupIdInNocSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_society_documents_master', 'group')){
                $table->integer('group')->after('is_optional')->nullable();                
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
        Schema::table('noc_society_documents_master', function (Blueprint $table) {
            if (Schema::hasColumn('noc_society_documents_master', 'group')){
                $table->dropColumn('group');                
            }
        });
    }
}
