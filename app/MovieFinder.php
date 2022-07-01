<?php

namespace whatwatch;

use whatwatch\RemoteRepository;

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