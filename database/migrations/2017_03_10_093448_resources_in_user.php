<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResourcesInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->unsignedInteger('food')->default(0);
            $table->unsignedInteger('wood')->default(0);
            $table->unsignedInteger('stone')->default(0);
            $table->unsignedInteger('gold')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('food');
            $table->dropColumn('wood');
            $table->dropColumn('stone');
            $table->dropColumn('gold');
        });
    }
}
