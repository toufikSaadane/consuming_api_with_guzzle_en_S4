<?php


namespace App\services;



use GuzzleHttp\Client;

class GuzzleServices
{
    public function getGuzzleConnection($endpoint, $resource){

        $client = new Client(['base_uri' => $endpoint]);
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