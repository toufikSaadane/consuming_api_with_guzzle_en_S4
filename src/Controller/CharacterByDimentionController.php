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
     * @var GuzzleServices
     */
    private $guzzleService;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(GuzzleServices $guzzleService, PaginatorInterface $paginator)
    {
        $this->guzzleService=$guzzleService;
        $this->paginator=$paginator;
    }

    /**
     * @return mixed
     * @required
     */
    public function getProperty()
    {
        return $this->resource;
    }

    /**
     *
     */
    private function getCaharacterData(): array
    {
        $data=$this->guzzleService->getGuzzleConnection($this->getProperty());
        $oneArrayWithAllResultsx=[];
        foreach ($data as $key=>$va) {
            foreach ($va as $k=>$v) {
                $oneArrayWithAllResultsx[]=$v;

            }
        }

        return $oneArrayWithAllResultsx;
    }

    /**
     * @Route("/", name="character_by_dimention")
     *
     *
     * @param Request $request
     * @return Response
     */
    public function getAllElements(Request $request)
    {
        $pagination=$this->paginator->paginate(
            $this->getCaharacterData(),
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('character_by_dimention/index.html.twig', [
            'pagination'=>$pagination
        ]);
    }

    /**
     * @Route("/singleCharacter/{id}", name="singleCharacter")
     */
    public function singleCharacter($id)
    {
        $singleCharacter = $this->getCaharacterData();

      return $this->render("character_by_dimention/singleCharacter.html.twig", [
         "singleCharacter" => $singleCharacter[$id-1]
      ]);
    }
}
