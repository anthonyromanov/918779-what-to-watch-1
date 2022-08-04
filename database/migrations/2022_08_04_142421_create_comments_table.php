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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('text')
                ->nullable();
            $table->tinyInteger('rating');
            $table->integer('comment_id');
            $table->bigInteger('film_id')
                ->unsigned();
            $table->bigInteger('author_id')
                ->unsigned();
            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('comments');
    }
};
