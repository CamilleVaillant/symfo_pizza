<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadController extends AbstractController
{
    #[Route('/', name: 'app_read')]
    public function index( PizzaRepository $repository): Response
    {
        $pizza = $repository->findAll();
        
        return $this->render('read/index.html.twig', [
            'pizzas' => $pizza,
        ]);
    }
}
