<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTransBillAndassociatio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->string('bill_number')->nullable();
        });

        Schema::table('building_tenant_bill_association', function (Blueprint $table) {
            $table->string('bill_number')->nullable()->after('bill_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_bill_generate', function (Blueprint $table) {
            $table->dropColumn(['bill_number']);
        });
        Schema::table('building_tenant_bill_association', function (Blueprint $table) {
            $table->dropColumn(['bill_number']);
        });
    }

}
