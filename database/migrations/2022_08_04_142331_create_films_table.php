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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 128);
            $table->string('background_image', 500);
            $table->char('background_color', 7);
            $table->text('description');
            $table->decimal('rating', 2, 1)->index('rating');
            $table->smallInteger('run_time');
            $table->year('released');
            $table->tinyInteger('status')->nullable();
            $table->index(['released', 'status']);
            $table->string('imdb_id', 25)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
