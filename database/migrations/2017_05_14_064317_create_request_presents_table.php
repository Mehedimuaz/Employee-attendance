<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestPresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_presents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable();
            $table->date('request_date');
            $table->smallInteger('request_present');
            $table->smallInteger('accepted')->nullable();
            $table->smallInteger('confirm_present')->nullable();
            $table->double('salary')->nullable();
            $table->boolean('paid')->nullable();
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
        Schema::dropIfExists('request_presents');
    }
}
