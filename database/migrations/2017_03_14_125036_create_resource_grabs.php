<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceGrabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_grabs', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('type', ['wood', 'food', 'stone', 'gold']);
            $table->unsignedTinyInteger('amount'); // 0 - 255
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_grabs');
    }
}
