<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/birds", name="api_birds_get", methods={"GET"})
     */
    public function index(): Response
    {
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();
        
        return $this->json([$birds]);
    }
}
