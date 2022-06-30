<?php

use whatwatch\UserLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

use whatwatch\OmdbRepository;
use whatwatch\GetMovies;

use whatwatch\MovieFinder;

require_once '../vendor/autoload.php';

$logger = new Logger('omdb');
$logger->pushHandler(new StreamHandler('file.log'));

$movies= new OmdbRepository($logger, new Client(['base_uri' => 'http://www.omdbapi.com', 'http_errors' => false]), '579fed43');

$finder = new MovieFinder($movies);
$movie = $finder->find('tt3896198');

echo '<pre>' . print_r($movie->toArray(), true) . '</pre>';
