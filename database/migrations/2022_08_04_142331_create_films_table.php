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
            $table->string('name', 128)
                ->nullable();
            $table->string('poster_image', 500);
            $table->string('preview_image', 500);
            $table->string('background_image', 500);
            $table->char('background_color', 7);
            $table->string('video_link', 500);
            $table->string('preview_video_link', 500);
            $table->text('description');
            $table->decimal('rating', 2, 1);
            $table->smallInteger('run_time');
            $table->year('released');
            $table->tinyInteger('status')
                ->nullable();
            $table->string('imdb_id', 25)
                ->nullable();
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
