<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_stars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('film_id')
                ->unsigned();
            $table->bigInteger('star_id')
                ->unsigned();
            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->foreign('star_id')
                ->references('id')
                ->on('stars')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_actors');
    }
};
