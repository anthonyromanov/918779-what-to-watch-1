<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(5)
            ->has(Film::factory()->has(Comment::factory()))
            ->create();
    }
}
