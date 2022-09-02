<?php

namespace App\Services;

use App\Services\RemoteRepository;

final class MovieFinder
{

    public function __construct(RemoteRepository $movies) {
        $this->movies = $movies;
    }

     public function find(string $movieId): Movie
     {
         return Movie::fromArray($this->movies->getMovie($movieId));
     }
}