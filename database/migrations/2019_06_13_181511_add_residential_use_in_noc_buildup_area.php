<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResidentialUseInNocBuildupArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_buildup_area', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_buildup_area', 'residential_use')){
                $table->string('residential_use')->after('total_permissable_bua')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'commercial_use')){
                $table->string('commercial_use')->after('residential_use')->nullable();
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
        Schema::table('noc_buildup_area', function (Blueprint $table) {
            if (Schema::hasColumn('noc_buildup_area', 'residential_use')){
                $table->dropColumn('residential_use');
            }
            if (Schema::hasColumn('noc_buildup_area', 'commercial_use')){
                $table->dropColumn('commercial_use');
            }
        });
    }
}
