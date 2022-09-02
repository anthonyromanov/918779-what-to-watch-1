<?php

namespace App\Services;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

class OmdbRepository implements RemoteRepository
{

    private ClientInterface $client;
    private LoggerInterface $logger;

    private string $apikey;      

    public function __construct(LoggerInterface $logger, ClientInterface $client, string $apikey)
    {
        
        $this->apikey = $apikey;
        $this->client = $client;
        $this->logger = $logger;

    }

    public function getMovie(string $movieId): array
    {
        $this->logger->info('Trying to search movie by id "{movieId}"', ['movieId' => $movieId]);
        
        $data = [
            'i' => $movieId,
            'apikey' => $this->apikey
        ];

        try {
            $response = $this->client->request('GET', '?' . http_build_query($data));
        } catch (\Throwable $e) {
            $this->logger->critical('Error "{error}" occurred while trying to search an movie', ['error' => $e->getMessage()]);
        }       

         return json_decode($response->getBody()->getContents(), true);
    } 
}
