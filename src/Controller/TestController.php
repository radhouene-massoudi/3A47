<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Http\RememberMe\ResponseListener;

#[Route('/st', name: 'ioiijioj')]
class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/produit/{id}', name: 'yyyy')]
    public function msg($id): Response
    {
        echo $id;
        return $this->render('test/msg.html.twig', [
            'idProduit' => $id,
            'nom'=>'ali',
            'klass'=>'3A47'
        ]);
    }

    #[Route('/response', name: 'yyy')]
    public function response(): Response
    {
        return new JsonResponse('fqdflsdlfsdlfdslfds');
    }
}

