<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add", name="cart_add", methods={"POST"})
     * 
     * @return Response La réponse à retourner
     */
    public function add(Request $request, SessionInterface $session): Response
    {
        $id = $request->request->get('id');

        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        if ($bird === null) {
            throw $this->createNotFoundException('Bird not found.');
        }

        $cart = $session->get('cart', []);

        if ( !array_key_exists($id, $cart) ) {
            $birdAndQuantity = [
                'bird' => $bird,
                'quantity' => 1,
            ];

            $cart[$id] = $birdAndQuantity;
        }
        else {
            $cart[$id]['quantity'] += 1;
        }

        $session->set('cart', $cart);

        $this->addFlash('success', 'Bird added to cart.');
        $this->addFlash('info', 'Vive les messages Flash.');
        $this->addFlash('info', 'Et vive Symfo !');

        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/cart", name="cart_show", methods={"GET"})
     */
    public function show(SessionInterface $session)
    {
        $cart = $session->get('cart');

        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clear(SessionInterface $session)
    {
        $session->remove('cart');

        $this->addFlash('success', 'Cart emptied.');

        return $this->redirectToRoute('cart_show');
    }
}
