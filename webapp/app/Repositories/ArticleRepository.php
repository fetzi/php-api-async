<?php


namespace App\Repositories;


use App\QueryStore;
use GuzzleHttp\Client;

class ArticleRepository
{
    /** @var Client */
    private $client;

    /** @var QueryStore */
    private $queryStore;

    public function __construct(Client $client, QueryStore $queryStore)
    {
        $this->client = $client;
        $this->queryStore = $queryStore;
    }


    public function get()
    {
        $response = $this->client->request('GET', 'http://localhost:8081/blog?s=' . uniqid());

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return \GuzzleHttp\Promise\Promise
     */
    public function getAsync()
    {
        return $this->queryStore->store('http://localhost:8081/blog?s=' . uniqid());
    }
}