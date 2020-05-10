<?php

namespace App\Controller;

use App\services\GuzzleServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterByDimentionController extends AbstractController
{
    public $resource;

    /**
     * @return mixed
     * @required
     */
    public function getProperty(){
        return $this->resource;
    }

    /**
     * @Route("/", name="character_by_dimention")
     * @param GuzzleServices $guzzleService
     * @return Response
     */

    public function getAllElements(GuzzleServices $guzzleService){
//        $endpoint = $this->endpoint;
        //$resource = 'character';
        $items = $guzzleService->getGuzzleConnection($this->getProperty());
        return $this->render('character_by_dimention/index.html.twig', [
            'body' => $items
        ]);
    }
}
