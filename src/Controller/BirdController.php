<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BirdController extends AbstractController
{
    /**
     * Page d'accueil
     * 
     * @Route("/", name="home", methods={"GET"})
     */
    public function home()
    {
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();

        return $this->render('bird/home.html.twig', [
            'birds' => $birds,
        ]);
    }

    /**
     * Page d'un oiseau
     * 
     * @Route("/bird/{id}", name="bird_show", requirements={"id"="\d+"}, methods={"GET"})
     * 
     * Autre syntaxe possible pour les requirements <\d+> directement dans le chemin
     * @Route("/bird/{id<\d+>}", name="bird_show", methods={"GET"})
     */
    public function show($id)
    {
        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        if ($bird === null) {
            throw $this->createNotFoundException('Bird not found.');
        }
        
        return $this->render('bird/show.html.twig', [
            'bird' => $bird,
            'id' => $id,
        ]);
    }

    /**
     * @Route("/theme/dark", name="dark_theme", methods={"GET"})
     */
    public function darkTheme(SessionInterface $session, Request $request)
    {
        if ($session->get('theme') == null) {

            $session->set('theme', 'dark');

            $this->addFlash('info', 'Bouh ! Il fait tout noir.');
        } else {
            $session->remove('theme');
            $this->addFlash('info', 'Et la lumière fût !');
        }

        return $this->redirect($request->headers->get('referer'));
    }
}