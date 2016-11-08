<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id');
            $table->integer('client_id');
            $table->string('ori_num')->nullable();
            $table->string('py_num')->nullable();
            $table->float('sample_weight')->nullable();
            $table->dateTime('sample_date')->nullable();
            $table->dateTime('test_date')->nullable();
            $table->boolean('is_reported')->default(false);
            $table->dateTime('report_date')->nullable();
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
        Schema::dropIfExists('samples');
    }
}
