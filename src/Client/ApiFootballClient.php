<?php

namespace App\Client;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiFootballClient
{
    private HttpClientInterface $apiFootballClient;

    private const BASE_URI = 'https://api-football-v1.p.rapidapi.com/v3';

    public function __construct(HttpClientInterface $apiFootballClient)
    {
        $this->apiFootballClient = $apiFootballClient;
    }

    public function request(string $url, array $params = []): array
    {
        try {
            $response = $this->apiFootballClient->request(Request::METHOD_GET, self::BASE_URI . $url, [
                'query' => $params
            ]);
        } catch (TransportExceptionInterface $e) {

        }

        return $response->toArray();
    }
}
