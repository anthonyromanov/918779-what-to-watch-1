<?php

namespace App\Services;

use App\Services\RemoteRepositoryInterface;

final class MovieFinder
{

    public function __construct(RemoteRepository $movies)
    {
        $this->movies = $movies;
    }

     public function find(string $imdbId): Movie
     {
         return Movie::fromArray($this->movies->getMovie($imdbId));
     }
}
