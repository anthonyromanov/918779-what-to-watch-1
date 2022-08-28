<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Enums\FilmStatus;

class FilmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Checking the calculation of the rating value, the user rating of the movie.
     *
     * @return void
     */
    public function testGetFilmRating()
    {
        $film = Film::factory()->create();

        Comment::factory()->for($film)->create(['rating' => 6]);

        $this->assertEquals(6, $film->getRating());
    }

        /**
     * Checking the calculation of the zero rating value, the user rating of the movie.
     *
     * @return void
     */
    public function testGetZeroFilmRating()
    {
        $film = Film::factory()->create();

        Comment::factory()->for($film)->create(['rating' => 0]);

        $this->assertEquals(0, $film->getRating());
    }

    /**
     * Checks the status of the film.
     *
     * @return void
     */
    public function testStatusFilm()
    {
        $film = Film::factory()->filmOnModerate()->create();
        $this->assertTrue($film->isModerate());

        $film = Film::factory()->filmIsReady()->create();
        $this->assertTrue($film->isReady());
    }
}
