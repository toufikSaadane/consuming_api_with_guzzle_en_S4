<?php


namespace App\services;



use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleServices
{
    private $endpoint;

    public function __construct($endpoint)
    {
        $this->endpoint=$endpoint;
    }

    public function getGuzzleConnection($resource){

        $client = new Client(['base_uri' => $this->endpoint]);
        try {
            $pagenum = 1;
            do {
                $response = $client->get($resource, [
                    'query' => [
                        'page' => $pagenum++
                    ]
                ]);
                if ($response->getStatusCode() === 200) {
                    $result = json_decode($response->getBody(), TRUE);
                    if (!empty($result['results'])) {
                        $items[] = $result['results'];
                    }
                }
            } while (!empty($result['info']['next']));

        } catch (GuzzleException $e) {

            throw Exception($e);
        }

        return $items;
    }

}