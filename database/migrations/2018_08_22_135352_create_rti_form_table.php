<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtiFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rti_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frontend_user_id');
            $table->string('applicant_name');
            $table->text('applicant_addr');
            $table->string('info_subject');
            $table->date('info_period_from');
            $table->date('info_period_to');
            $table->text('info_descr');
            $table->boolean('info_post_or_person');
            $table->enum('info_post_type',[0,1,2,3])->comment('0 = not applicable, 1 = Ordinary,2 = Registered, 3 = Speed');
            $table->boolean('applicant_below_poverty_line')->comment('0 = no, 1 = yes');
            $table->string('poverty_line_proof');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rti_form');
    }
}
