<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
       $user = new User();
      
       $formr = $this->createForm(RegisterType::class, $user);
       $formr->handleRequest($request);
       if($entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])){
        $this->addFlash('error', 'Cet email est déjà utilisé. Veuillez en choisir un autre.');
        return $this->redirectToRoute('app_register');
       }
       if($formr->isSubmitted() && $formr->isValid()){
            $user->setPassword( 
            $passwordEncoder->hashPassword($user,$formr->get('password')->getData())
            );
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Vous etes inscrit !');
               
            return $this->redirectToRoute('app_read');
       }
       
       
      

        return $this->render('security/register.html.twig', [
            'inscription' => $formr->createView(),
        ]);
        
    }
}
