<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTime(),
            'text' => $this->faker->paragraph(),
            'film_id' => Film::factory(),
            'rating' => random_int(1, 10),
            'comment_id' => 0,
            'user_id' => User::factory(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
