<?php

namespace whatwatch;

use GuzzleHttp\Client;

class OmdbRepository implements RemoteRepository
{
    private string $apiKey = '579fed43';
    private string $movieId;

    public function __construct(string $movieId)
    {
        $this->movieId = $movieId;
    }


    public function getMovies(): array
    {
        $client = new Client(['base_uri' => 'http://www.omdbapi.com/']);
        $response = $client->request('GET', '?i=' . $this->movieId . '&apikey=' . $this->apiKey);

        return json_decode($response->getBody()->getContents(), true);
    }
}
