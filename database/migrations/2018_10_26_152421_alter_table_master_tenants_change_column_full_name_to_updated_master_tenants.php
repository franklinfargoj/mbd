<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMasterTenantsChangeColumnFullNameToUpdatedMasterTenants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_tenants', function (Blueprint $table) {
            $table->renameColumn('full_name', 'first_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_tenants', function (Blueprint $table) {
            $table->renameColumn('first_name', 'full_name');
        });
    }
}
