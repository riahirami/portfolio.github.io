<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/admin/editerUtilisateur/{id}", name="editerUtilisateur")
     */
    public function editUtilisateur(Request $request, $id)
    {
        $u1 = new Utilisateur();
        $entityManager = $this->getDoctrine()->getManager();

        $u1 = $entityManager->getRepository(Utilisateur::class)->find($id);
        $form = $this->createForm(UtilisateurType::class, $u1);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->flush();

            return $this->redirectToRoute('listeutilisateur');
        }
        return $this->render("admin/editerUtilisateur.html.twig", [
            "usr" => $u1,
            'form' => $form->createView()

        ]);
    }



    /**
     * @Route("/admin/supprimerUtilisateur/{id}", name="supprimerUtilisateur")
     */
    public function Supprimer(Request $request, $id)
    {
        $us1 = new Utilisateur();
        $entityManager = $this->getDoctrine()->getManager();

        $us1 = $entityManager->getRepository(Utilisateur::class)->find($id);
        $entityManager->remove($us1);


        $entityManager->flush();

        return $this->redirectToRoute('listeutilisateur');
    }
}
