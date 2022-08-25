<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\FilmStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;
    protected $attributes = [
        'status' => FilmStatus::class,
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'poster_image' => $this->faker->image(),
            'preview_image' => $this->faker->image(),
            'background_image' => $this->faker->image(),
            'background_color' => $this->faker->hexColor(),
            'video_link' => $this->faker->url(),
            'preview_video_link' => $this->faker->url(),
            'description' => $this->faker->paragraph(),
            'rating' => $this->faker->randomFloat(1, 1, 10),
            'run_time' => $this->faker->randomNumber(3, false),
            'released' => $this->faker->year(),
            'status' => FilmStatus::PENDING,
            'imdb_id' => $this->faker->word(),
        ];
    }

    public function filmOnModerate()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => FilmStatus::MODERATE,
            ];
        });
    }

    public function filmIsReady()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => FilmStatus::FILM_READY,
            ];
        });
    }
}
