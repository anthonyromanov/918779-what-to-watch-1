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
            $table->foreignId('film_id')->unsigned()->constrained('films');
            $table->foreignId('star_id')->unsigned()->constrained('stars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_stars');
    }
};
