<?php

namespace App\Controller;

use App\services\GuzzleServices;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    public function getAllElements(GuzzleServices $guzzleService,
                                   PaginatorInterface $paginator,
                                   Request $request){
        $pagination = $paginator->paginate(
            $guzzleService->getGuzzleConnection($this->getProperty()), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );
        return $this->render('character_by_dimention/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
