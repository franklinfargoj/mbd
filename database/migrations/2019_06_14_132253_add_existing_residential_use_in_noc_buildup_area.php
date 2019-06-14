<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExistingResidentialUseInNocBuildupArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_buildup_area', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_buildup_area', 'existing_residential_use')){
                $table->string('existing_residential_use')->after('noc_vide_lease')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'existing_commercial_use')){
                $table->string('existing_commercial_use')->after('existing_residential_use')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'existing_bua')){
                $table->string('existing_bua')->after('existing_commercial_use')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'additional_area')){
                $table->string('additional_area')->after('existing_bua')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'additional_residential_bua')){
                $table->string('additional_residential_bua')->after('additional_area')->nullable();
            }
            if (!Schema::hasColumn('noc_buildup_area', 'additional_commercial_bua')){
                $table->string('additional_commercial_bua')->after('additional_residential_bua')->nullable();
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
            if (Schema::hasColumn('noc_buildup_area', 'existing_residential_use')){
                $table->dropColumn('existing_residential_use');
            }
            if (Schema::hasColumn('noc_buildup_area', 'existing_commercial_use')){
                $table->dropColumn('existing_commercial_use');
            }
            if (Schema::hasColumn('noc_buildup_area', 'existing_bua')){
                $table->dropColumn('existing_bua');
            }
            if (Schema::hasColumn('noc_buildup_area', 'additional_area')){
                $table->dropColumn('additional_area');
            }
            if (Schema::hasColumn('noc_buildup_area', 'additional_residential_bua')){
                $table->dropColumn('additional_residential_bua');
            }
            if (Schema::hasColumn('noc_buildup_area', 'additional_commercial_bua')){
                $table->dropColumn('additional_commercial_bua');
            }
        });
    }
}
