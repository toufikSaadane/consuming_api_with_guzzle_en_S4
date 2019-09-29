<?php

namespace App\Controller;

use App\services\GuzzleServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CharacterByDimentionController extends AbstractController
{
    /**
     * @Route("/characters", name="character_by_dimention")
     */

    public function getAllElements(GuzzleServices $guzzleService){
        $endpoint = "https://rickandmortyapi.com/api/";
        $resource = 'character';
        $items = $guzzleService->getGuzzleConnection($endpoint, $resource);
        return $this->render('character_by_dimention/index.html.twig', [
            'body' => $items
        ]);
    }
}
