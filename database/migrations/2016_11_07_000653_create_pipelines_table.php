<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePipelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipelines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roadmap_id')->unsigned();
            $table->tinyInteger('step');
            $table->integer('procedure_id')->unsigned();
            $table->integer('protocol_id')->unsigned();
            $table->float('time');
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
        Schema::dropIfExists('pipelines');
    }
}
