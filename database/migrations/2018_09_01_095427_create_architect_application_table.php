<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_application', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_number')->nullable();
            $table->date('application_date')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('candidate_email')->nullable();
            $table->string('candidate_mobile_no')->nullable();
            $table->enum('application_status',[1,2,3,4])->comment('1 = New Application ,2 = Scrutiny pending, 3 = shortlisted, 4 = final');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('architect_application');
    }
}
