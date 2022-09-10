<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

use App\Services\OmdbRepository;
use App\Services\GetMovies;

use App\Services\MovieFinder;

require_once '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$logger = new Logger('omdb');
$logger->pushHandler(new StreamHandler('file.log'));

$movies= new OmdbRepository($logger, new Client(['base_uri' => 'http://www.omdbapi.com', 'http_errors' => false]), $_ENV['APIKEY']);

$finder = new MovieFinder($movies);
$movie = $finder->find('tt3896198');

echo '<pre>' . print_r($movie->toArray(), true) . '</pre>';
