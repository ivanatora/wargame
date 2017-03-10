<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceDrops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_drops', function(Blueprint $table){
            $table->increments('id');
            $table->decimal('lat', 9, 6); //242.214712
            $table->decimal('lng', 9, 6); //242.214712
            $table->enum('type', ['wood', 'food', 'stone', 'gold']);
            $table->unsignedTinyInteger('amount'); // 0 - 255

            $table->index('lat');
            $table->index('lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_drops');
    }
}
