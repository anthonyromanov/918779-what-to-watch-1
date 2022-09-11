<?php

namespace App\Services;

interface RemoteRepositoryInterface
{
    public function getMovie(string $movieId): array;
}
