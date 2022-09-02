<?php

namespace App\Services;

interface RemoteRepository
{
    public function getMovie(string $movieId): array;
}
