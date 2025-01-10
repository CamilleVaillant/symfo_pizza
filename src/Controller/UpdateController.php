<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{
    #[Route('/update/{id}', name: 'app_update')]
    public function modify(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
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
