<?php

namespace App\Services;

final class Movie
{
     public function __construct(public string $title, public string $year, public array $rawData)
     {}

     public static function fromArray(array $payload): Movie
     {
          return new Movie($payload['Title'], $payload['Year'], $payload);
     }

     public function toArray(): array
     {
          return $this->rawData;
     }
}
