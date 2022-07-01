<?php

namespace whatwatch;

interface RemoteRepository
{
    public function getMovie(string $movieId): array;
}
