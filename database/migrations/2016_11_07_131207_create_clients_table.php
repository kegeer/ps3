<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('age')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('waistline')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('disease')->default(false);
            $table->string('disease_history')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
