<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'app_home')]
    // public function index(): Response
    // {
    //     $form = $this->createForm(PizzaType::class, $pizza);
    //     return $this->render('home/index.html.twig', [
    //         'pizzaform' =>$form->createView(),
    //     ]);
    // }

    #[Route('/home' , name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pizza =new Pizza();
        
        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($pizza);
            $entityManager->flush();

            $this->addFlash('success', 'Pizza ajouter avec succès !!!');

            return $this->redirectToRoute('app_read');
        }

        return $this->render('home/index.html.twig', [
            'pizzaform' => $form->createView(),
            
        ]);
    }

   
}
