<?php

namespace App\Controller;

use App\services\GuzzleServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CharacterByDimentionController extends AbstractController
{
    /**
     * @Route("/characterbydimention", name="character_by_dimention")
     */

    public function getAllElements(GuzzleServices $guzzleService){
        $endpoint = "https://rickandmortyapi.com/api/";
        $resource = 'location';
        $items = $guzzleService->getGuzzleConnection($endpoint, $resource);
        dd($items);die();
        return $this->render('charactersByDimension/index.html.twig', [
            'body' => $items
        ]);
    }
}
