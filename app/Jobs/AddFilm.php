<?php

namespace App\Jobs;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use App\Enums\FilmStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AddFilm implements ShouldQueue
{

    protected $imdbId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MovieFinder $movies): void
    {

        $movie = $movies->find($this->imdbId);

        if (!$movie) {
            return;
        }

        $genres = $movie['Genre'];
        $directors = $movie['Director'];
        $stars = $movie['Actors'];
        $images = $movie['Poster'];

        $genresId = [];
        $directorsId = [];
        $starsId = [];
        $imageId = [];

        foreach ($genres as $genre) {
            $genresId[] = Genre::firstOrCreate(['title' => $genre])->id;
        }

        foreach ($directors as $director) {
            $directorsId[] = Director::firstOrCreate(['name' => $director])->id;
        }

        foreach ($stars as $star) {
            $starsId[] = Star::firstOrCreate(['name' => $star])->id;
        }

        foreach ($images as $image) {
            $imageId[] = Star::firstOrCreate(['poster_image' => $image])->id;
        }

        DB::transaction(function () use ($genresId, $directorsId, $starsId, $imageId)
        {

            $film = Film::create([
                'name' => $movie['Title'],
                'description' => $movie['Plot'],
                'run_time' => intval($movie['Runtime']),
                'released' => date("Y", strtotime($movie['Released'])),
                'imdb_id' => $movie['imdbID'],
                'status' => FilmStatus::PENDING,
            ]);

            $film->genres()->attach($genresId);
            $film->directors()->attach($directorsId);
            $film->stars()->attach($starsId);
            $film->image()->attach($imageId);

        });
    }
}
