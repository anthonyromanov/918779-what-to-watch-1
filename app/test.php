<?php

use whatwatch\UserLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

use whatwatch\OmdbRepository;
use whatwatch\GetMovies;

require_once '../vendor/autoload.php';

$logger = new Logger('omdb');
$logger->pushHandler(new StreamHandler('file.log'));

$client = new OmdbRepository($logger, new Client(['base_uri' => 'http://www.omdbapi.com', 'http_errors' => false]), '579fed43');

$movie = $client->getMovie('tt3896198');
    
    echo "<pre>";
    print_r($movie);
    echo "</pre>";
