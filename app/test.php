<?php

use whatwatch\OmdbRepository;
use whatwatch\GetMovies;

require_once '../vendor/autoload.php';

$moviesRepository = new OmdbRepository('tt3896198');
$getMoviesDb = new GetMovies();
$movie = $getMoviesDb->getMoviesList($moviesRepository);

echo "<pre>";
print_r($movie);
echo "</pre>";
