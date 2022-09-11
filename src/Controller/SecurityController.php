<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $U1 = new Utilisateur();
        $form = $this->createForm(RegistrationType::class, $U1);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $U1->setPassword($passwordEncoder->encodePassword(
                $U1,
                $U1->getPassword()
            ));

            $em->persist($U1);

            $em->flush();
        }

        return $this->render('portfolio/registration.html.twig', ['form' => $form->createView()]);
        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/connexion",name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'portfolio/login.html.twig',
            ['lastUsername' => $lastUsername, 'error' => $error]
        );
        return $this->redirectToRoute('listeprojet');
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('security_login');
    }


    /**
     * @Route("admin/Listeutilisateur", name="listeutilisateur")
     */
    public function ListeUtilisateur(Request $request): Response
    {

        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('admin/listeutilisateur.html.twig', [
            "liste" => $user,
            "form_title" => "Liste des utilisateur"
        ]);
    }
}
