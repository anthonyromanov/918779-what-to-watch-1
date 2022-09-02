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
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name', 128);
            $table->string('background_image', 500)->nullable();
            $table->char('background_color', 7)->default('#000000');
            $table->text('description')->nullable();
            $table->decimal('rating', 2, 1)->index('rating');
            $table->smallInteger('run_time')->nullable();
            $table->year('released')->nullable();
            $table->set('status', ['pending', 'on moderation, ready'])->nullable();
            $table->index(['released', 'status']);
            $table->string('imdb_id', 25)->unique()->nullable();
            $table->string('video_link', 500)->constrained('videos');
            $table->string('preview_video', 500)->constrained('videos');
            $table->string('poster_image', 500)->constrained('images');
            $table->string('preview_image', 500)->constrained('images');
            $table->softDeletes('deleted_at');

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
