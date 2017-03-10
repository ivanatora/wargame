<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 255);
            $table->unsignedInteger('order')->default(0);
            $table->text('description');
            $table->string('image_src', 255);
            $table->unsignedInteger('cost_food')->default(0);
            $table->unsignedInteger('cost_wood')->default(0);
            $table->unsignedInteger('cost_stone')->default(0);
            $table->unsignedInteger('cost_gold')->default(0);
            $table->unsignedInteger('construction_time')->comment('seconds')->default(0);
            $table->unsignedInteger('initial_hp')->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings_types');
    }
}
