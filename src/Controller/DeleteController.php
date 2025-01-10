<?php

namespace App\Controller;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
       //On verifie si le token Csrf provient bien du formulaire de suppression correspondant a l'ID
       if($this->isCsrfTokenValid("SUP" . $pizza->getId(),$request->get('_token'))){
            $entityManager->remove($pizza); //marquage de la pizza pour la sup
            $entityManager->flush(); //lancement de la requette
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_read");
       }
    }
}
