<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherRemarkInOlApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('ol_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_applications', 'other_remark')){
                $table->text('other_remark')->after('department_id')->nullable();                
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
        Schema::table('ol_applications', function (Blueprint $table) {
            if (Schema::hasColumn('ol_applications', 'other_remark')){
                $table->dropColumn('other_remark');
            }
        });
    }
}
