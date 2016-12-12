<?php


namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Response;

class QueryStore
{
    /** @var Client */
    private $client;

    private $queries = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $query
     * @return Promise
     */
    public function store($query)
    {
        $promise = new Promise(function() {
            $this->resolve();
        });

        $identifier = uniqid();

        $this->queries[$identifier] = [
            "query" => $query,
            "promise" => $promise
        ];

        return $promise;
    }

    private function resolve()
    {
        $promises = [];

        foreach($this->queries as $key => $storedQuery) {
            $promises[$key] = $this->client->requestAsync('GET', $storedQuery['query']);
        }

        $responses = \GuzzleHttp\Promise\settle($promises)->wait();

        foreach($responses as $key => $response) {
            $state = $response['state'];

            /** @var $response Response */
            $promise = $this->queries[$key]['promise'];

            if($state === 'fulfilled') {
                $data = json_decode($response['value']->getBody()->getContents(), true);
                $promise->resolve($data);
            }
            else {
                $promise->reject($response['reason']);
            }

            unset($this->queries[$key]);
        }
    }
}