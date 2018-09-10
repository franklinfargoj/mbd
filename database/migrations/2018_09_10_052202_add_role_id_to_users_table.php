<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('users', function ($table) {
            $table->integer('role_id')->after('password');
            $table->string('uploaded_note_path')->after('role_id');
            $table->date('service_start_date')->nullable()->after('uploaded_note_path');
            $table->date('service_end_date')->nullable()->after('service_start_date');
            $table->datetime('last_login_at')->nullable()->after('service_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('role_id');
            $table->dropColumn('uploaded_note_path');
            $table->dropColumn('service_start_date');
            $table->dropColumn('service_end_date');
            $table->dropColumn('last_login_at');
        });
    }
}
